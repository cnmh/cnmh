<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMenuGroupRequest;
use App\Http\Requests\UpdateMenuGroupRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MenuGroupRepository;
use Illuminate\Http\Request;
use Flash;

class MenuGroupController extends AppBaseController
{
    /** @var MenuGroupRepository $menuGroupRepository*/
    private $menuGroupRepository;

    public function __construct(MenuGroupRepository $menuGroupRepo)
    {
        $this->menuGroupRepository = $menuGroupRepo;
    }

    /**
     * Display a listing of the MenuGroup.
     */
    public function index(Request $request)
    {
        
        $query = $request->input('query');
        $menuGroups = $this->menuGroupRepository->paginate($query);
       
        if ($request->ajax()) {
            return view('root.menu_groups.table')
                ->with('menuGroups', $menuGroups);
        }

        return view('root.menu_groups.index')
            ->with('menuGroups', $menuGroups);
    }

    /**
     * Show the form for creating a new MenuGroup.
     */
    public function create()
    {
        return view('root.menu_groups.create');
    }

    /**
     * Store a newly created MenuGroup in storage.
     */
    public function store(CreateMenuGroupRequest $request)
    {
        $input = $request->all();

        $menuGroup = $this->menuGroupRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/menu_groups.singular')]));

        return redirect(route('menu-groups.index'));
    }

    /**
     * Display the specified MenuGroup.
     */
    public function show($id)
    {
        $menuGroup = $this->menuGroupRepository->find($id);

        if (empty($menuGroup)) {
            Flash::error(__('models/menu_groups.singular').' '.__('messages.not_found'));

            return redirect(route('menu-groups.index'));
        }

        return view('root.menu_groups.show')->with('menuGroup', $menuGroup);
    }

    /**
     * Show the form for editing the specified MenuGroup.
     */
    public function edit($id)
    {
        $menuGroup = $this->menuGroupRepository->find($id);

        if (empty($menuGroup)) {
            Flash::error(__('models/menu_groups.singular').' '.__('messages.not_found'));

            return redirect(route('menu-groups.index'));
        }

        return view('root.menu_groups.edit')->with('menuGroup', $menuGroup);
    }

    /**
     * Update the specified MenuGroup in storage.
     */
    public function update($id, UpdateMenuGroupRequest $request)
    {
        $menuGroup = $this->menuGroupRepository->find($id);

        if (empty($menuGroup)) {
            Flash::error(__('models/menu_groups.singular').' '.__('messages.not_found'));

            return redirect(route('menu-groups.index'));
        }

        $menuGroup = $this->menuGroupRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/menu_groups.singular')]));

        return redirect(route('menu-groups.index'));
    }

    /**
     * Remove the specified MenuGroup from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $menuGroup = $this->menuGroupRepository->find($id);

        if (empty($menuGroup)) {
            Flash::error(__('models/menu_groups.singular').' '.__('messages.not_found'));

            return redirect(route('menu-groups.index'));
        }

        $this->menuGroupRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/menu_groups.singular')]));

        return redirect(route('menu-groups.index'));
    }
}
