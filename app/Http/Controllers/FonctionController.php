<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFonctionRequest;
use App\Http\Requests\UpdateFonctionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FonctionRepository;
use Illuminate\Http\Request;
use Flash;

class FonctionController extends AppBaseController
{
    /** @var FonctionRepository $fonctionRepository*/
    private $fonctionRepository;

    public function __construct(FonctionRepository $fonctionRepo)
    {
        $this->fonctionRepository = $fonctionRepo;
    }

    /**
     * Display a listing of the Fonction.
     */
    public function index(Request $request)
    {
        
        $query = $request->input('query');
        $fonctions = $this->fonctionRepository->paginate($query);
       
        if ($request->ajax()) {
            return view('fonctions.table')
                ->with('fonctions', $fonctions);
        }

        return view('fonctions.index')
            ->with('fonctions', $fonctions);
    }

    /**
     * Show the form for creating a new Fonction.
     */
    public function create()
    {
        return view('fonctions.create');
    }

    /**
     * Store a newly created Fonction in storage.
     */
    public function store(CreateFonctionRequest $request)
    {
        $input = $request->all();

        $fonction = $this->fonctionRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/fonctions.singular')]));

        return redirect(route('fonctions.index'));
    }

    /**
     * Display the specified Fonction.
     */
    public function show($id)
    {
        $fonction = $this->fonctionRepository->find($id);

        if (empty($fonction)) {
            Flash::error(__('models/fonctions.singular').' '.__('messages.not_found'));

            return redirect(route('fonctions.index'));
        }

        return view('fonctions.show')->with('fonction', $fonction);
    }

    /**
     * Show the form for editing the specified Fonction.
     */
    public function edit($id)
    {
        $fonction = $this->fonctionRepository->find($id);

        if (empty($fonction)) {
            Flash::error(__('models/fonctions.singular').' '.__('messages.not_found'));

            return redirect(route('fonctions.index'));
        }

        return view('fonctions.edit')->with('fonction', $fonction);
    }

    /**
     * Update the specified Fonction in storage.
     */
    public function update($id, UpdateFonctionRequest $request)
    {
        $fonction = $this->fonctionRepository->find($id);

        if (empty($fonction)) {
            Flash::error(__('models/fonctions.singular').' '.__('messages.not_found'));

            return redirect(route('fonctions.index'));
        }

        $fonction = $this->fonctionRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/fonctions.singular')]));

        return redirect(route('fonctions.index'));
    }

    /**
     * Remove the specified Fonction from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $fonction = $this->fonctionRepository->find($id);

        if (empty($fonction)) {
            Flash::error(__('models/fonctions.singular').' '.__('messages.not_found'));

            return redirect(route('fonctions.index'));
        }

        $this->fonctionRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/fonctions.singular')]));

        return redirect(route('fonctions.index'));
    }
}
