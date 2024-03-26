<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReclamationRequest;
use App\Http\Requests\UpdateReclamationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ReclamationRepository;
use Illuminate\Http\Request;
use Flash;

class ReclamationController extends AppBaseController
{
    /** @var ReclamationRepository $reclamationRepository*/
    private $reclamationRepository;

    public function __construct(ReclamationRepository $reclamationRepo)
    {
        $this->reclamationRepository = $reclamationRepo;
    }

    /**
     * Display a listing of the Reclamation.
     */
    public function index(Request $request)
    {
        
        $query = $request->input('query');
        $reclamations = $this->reclamationRepository->paginate($query);
       
        if ($request->ajax()) {
            return view('reclamations.table')
                ->with('reclamations', $reclamations);
        }

        return view('reclamations.index')
            ->with('reclamations', $reclamations);
    }

    /**
     * Show the form for creating a new Reclamation.
     */
    public function create()
    {
        return view('reclamations.create');
    }

    /**
     * Store a newly created Reclamation in storage.
     */
    public function store(CreateReclamationRequest $request)
    {
        $input = $request->all();

        $reclamation = $this->reclamationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/reclamations.singular')]));

        return redirect(route('reclamations.index'));
    }

    /**
     * Display the specified Reclamation.
     */
    public function show($id)
    {
        $reclamation = $this->reclamationRepository->find($id);

        if (empty($reclamation)) {
            Flash::error(__('models/reclamations.singular').' '.__('messages.not_found'));

            return redirect(route('reclamations.index'));
        }

        return view('reclamations.show')->with('reclamation', $reclamation);
    }

    /**
     * Show the form for editing the specified Reclamation.
     */
    public function edit($id)
    {
        $reclamation = $this->reclamationRepository->find($id);

        if (empty($reclamation)) {
            Flash::error(__('models/reclamations.singular').' '.__('messages.not_found'));

            return redirect(route('reclamations.index'));
        }

        return view('reclamations.edit')->with('reclamation', $reclamation);
    }

    /**
     * Update the specified Reclamation in storage.
     */
    public function update($id, UpdateReclamationRequest $request)
    {
        $reclamation = $this->reclamationRepository->find($id);

        if (empty($reclamation)) {
            Flash::error(__('models/reclamations.singular').' '.__('messages.not_found'));

            return redirect(route('reclamations.index'));
        }

        $reclamation = $this->reclamationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/reclamations.singular')]));

        return redirect(route('reclamations.index'));
    }

    /**
     * Remove the specified Reclamation from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $reclamation = $this->reclamationRepository->find($id);

        if (empty($reclamation)) {
            Flash::error(__('models/reclamations.singular').' '.__('messages.not_found'));

            return redirect(route('reclamations.index'));
        }

        $this->reclamationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/reclamations.singular')]));

        return redirect(route('reclamations.index'));
    }
}
