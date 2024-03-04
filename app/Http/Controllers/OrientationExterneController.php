<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrientationExterneRequest;
use App\Http\Requests\UpdateOrientationExterneRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OrientationExterneRepository;
use Illuminate\Http\Request;
use Flash;

class OrientationExterneController extends AppBaseController
{
    /** @var OrientationExterneRepository $orientationExterneRepository*/
    private $orientationExterneRepository;

    public function __construct(OrientationExterneRepository $orientationExterneRepo)
    {
        $this->orientationExterneRepository = $orientationExterneRepo;
    }

    /**
     * Display a listing of the OrientationExterne.
     */
    public function index(Request $request)
    {
        
        $query = $request->input('query');
        $orientationExternes = $this->orientationExterneRepository->paginate($query);
       
        if ($request->ajax()) {
            return view('orientation_externes.table')
                ->with('orientationExternes', $orientationExternes);
        }

        return view('orientation_externes.index')
            ->with('orientationExternes', $orientationExternes);
    }

    /**
     * Show the form for creating a new OrientationExterne.
     */
    public function create()
    {
        return view('orientation_externes.create');
    }

    /**
     * Store a newly created OrientationExterne in storage.
     */
    public function store(CreateOrientationExterneRequest $request)
    {
        $input = $request->all();

        $orientationExterne = $this->orientationExterneRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/orientationExternes.singular')]));

        return redirect(route('orientation-externes.index'));
    }

    /**
     * Display the specified OrientationExterne.
     */
    public function show($id)
    {
        $orientationExterne = $this->orientationExterneRepository->find($id);

        if (empty($orientationExterne)) {
            Flash::error(__('models/orientationExternes.singular').' '.__('messages.not_found'));

            return redirect(route('orientation-externes.index'));
        }

        return view('orientation_externes.show')->with('orientationExterne', $orientationExterne);
    }

    /**
     * Show the form for editing the specified OrientationExterne.
     */
    public function edit($id)
    {
        $orientationExterne = $this->orientationExterneRepository->find($id);

        if (empty($orientationExterne)) {
            Flash::error(__('models/orientationExternes.singular').' '.__('messages.not_found'));

            return redirect(route('orientation-externes.index'));
        }

        return view('orientation_externes.edit')->with('orientationExterne', $orientationExterne);
    }

    /**
     * Update the specified OrientationExterne in storage.
     */
    public function update($id, UpdateOrientationExterneRequest $request)
    {
        $orientationExterne = $this->orientationExterneRepository->find($id);

        if (empty($orientationExterne)) {
            Flash::error(__('models/orientationExternes.singular').' '.__('messages.not_found'));

            return redirect(route('orientation-externes.index'));
        }

        $orientationExterne = $this->orientationExterneRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/orientationExternes.singular')]));

        return redirect(route('orientation-externes.index'));
    }

    /**
     * Remove the specified OrientationExterne from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $orientationExterne = $this->orientationExterneRepository->find($id);

        if (empty($orientationExterne)) {
            Flash::error(__('models/orientationExternes.singular').' '.__('messages.not_found'));

            return redirect(route('orientation-externes.index'));
        }

        $this->orientationExterneRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/orientationExternes.singular')]));

        return redirect(route('orientation-externes.index'));
    }
}
