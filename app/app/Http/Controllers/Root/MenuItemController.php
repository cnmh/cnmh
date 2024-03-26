<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\MenuGroup;
use App\Repositories\MenuItemRepository;
use Illuminate\Http\Request;
use Flash;

class MenuItemController extends AppBaseController
{
    /** @var MenuItemRepository $menuItemRepository*/
    private $menuItemRepository;

    public function __construct(MenuItemRepository $menuItemRepo)
    {
        $this->menuItemRepository = $menuItemRepo;
    }

    /**
     * Display a listing of the MenuItem.
     */
    public function index(Request $request)
    {

        $query = $request->input('query');
        $menuItems = $this->menuItemRepository->paginate($query);

        if ($request->ajax()) {
            return view('root.menu_items.table')
                ->with('menuItems', $menuItems);
        }

        return view('root.menu_items.index')
            ->with('menuItems', $menuItems);
    }

    /**
     * Show the form for creating a new MenuItem.
     */
    public function create()
    {
        $menuGroups = MenuGroup::all();
        return view('root.menu_items.create', [
            'menuGroups' => $menuGroups
        ]);
    }

    /**
     * Store a newly created MenuItem in storage.
     */
    public function store(CreateMenuItemRequest $request)
    {
        $input = $request->all();

        $menuItem = $this->menuItemRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/menuItems.singular')]));

        return redirect(route('menu-items.index'));
    }

    /**
     * Display the specified MenuItem.
     */
    public function show($id)
    {
        $menuItem = $this->menuItemRepository->find($id);

        if (empty($menuItem)) {
            Flash::error(__('models/menuItems.singular').' '.__('messages.not_found'));

            return redirect(route('menu-items.index'));
        }

        return view('root.menu_items.show')->with('menuItem', $menuItem);
    }

    /**
     * Show the form for editing the specified MenuItem.
     */
    public function edit($id)
    {
        $menuItem = $this->menuItemRepository->find($id);

        if (empty($menuItem)) {
            Flash::error(__('models/menuItems.singular').' '.__('messages.not_found'));

            return redirect(route('menu-items.index'));
        }

        $menuGroups = MenuGroup::all();
        return view('root.menu_items.edit')->with('menuItem', $menuItem)->with('menuGroups', $menuGroups);
    }

    /**
     * Update the specified MenuItem in storage.
     */
    public function update($id, UpdateMenuItemRequest $request)
    {
        $menuItem = $this->menuItemRepository->find($id);

        if (empty($menuItem)) {
            Flash::error(__('models/menuItems.singular').' '.__('messages.not_found'));

            return redirect(route('menu-items.index'));
        }

        // dd($request->all());
        $menuItem = $this->menuItemRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/menuItems.singular')]));

        return redirect(route('menu-items.index'));
    }

    /**
     * Remove the specified MenuItem from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $menuItem = $this->menuItemRepository->find($id);

        if (empty($menuItem)) {
            Flash::error(__('models/menuItems.singular').' '.__('messages.not_found'));

            return redirect(route('menu-items.index'));
        }

        $this->menuItemRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/menuItems.singular')]));

        return redirect(route('menu-items.index'));
    }
}
