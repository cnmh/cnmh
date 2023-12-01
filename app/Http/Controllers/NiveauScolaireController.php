<?php

namespace App\Http\Controllers;

use App\Exports\NiveauScolaireExport;
use App\Http\Requests\CreateNiveauScolaireRequest;
use App\Http\Requests\UpdateNiveauScolaireRequest;
use App\Http\Controllers\AppBaseController;
use App\Imports\NiveauScolaireImport;
use App\Repositories\NiveauScolaireRepository;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @author CodeCampers, Boukhar Soufiane
 */

class NiveauScolaireController extends AppBaseController
{
    /** @var NiveauScolaireRepository $niveauScolaireRepository*/
    private $niveauScolaireRepository;

    public function __construct(NiveauScolaireRepository $niveauScolaireRepo)
    {
        $this->niveauScolaireRepository = $niveauScolaireRepo;
    }

    /**
     * Display a listing of the NiveauScolaire.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $niveauScolaires = $this->niveauScolaireRepository->paginate($query);
      
       

        if ($request->ajax()) {
            return view('niveau_scolaires.table')
                ->with('niveauScolaires', $niveauScolaires);
        }

        
        return view('niveau_scolaires.index')
            ->with('niveauScolaires', $niveauScolaires);
    }

    /**
     * Show the form for creating a new NiveauScolaire.
     */
    public function create()
    {
        return view('niveau_scolaires.create');
    }

    /**
     * Store a newly created NiveauScolaire in storage.
     */
    public function store(CreateNiveauScolaireRequest $request)
    {

        $input = $request->all();

        $niveauScolaire = $this->niveauScolaireRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/niveauScolaires.singular')]));

        return redirect(route('niveauScolaires.index'));
    }

    /**
     * Display the specified NiveauScolaire.
     */
    public function show($id)
    {
        $niveauScolaire = $this->niveauScolaireRepository->find($id);

        if (empty($niveauScolaire)) {
            Flash::error(__('models/niveauScolaires.singular').' '.__('messages.not_found'));

            return redirect(route('niveauScolaires.index'));
        }

        return view('niveau_scolaires.show')->with('niveauScolaire', $niveauScolaire);
    }

    /**
     * Show the form for editing the specified NiveauScolaire.
     */
    public function edit($id)
    {

        $niveauScolaire = $this->niveauScolaireRepository->find($id);

        if (empty($niveauScolaire)) {
            Flash::error(__('models/niveauScolaires.singular').' '.__('messages.not_found'));

            return redirect(route('niveauScolaires.index'));
        }

        return view('niveau_scolaires.edit')->with('niveauScolaire', $niveauScolaire);
    }

    /**
     * Update the specified NiveauScolaire in storage.
     */
    public function update($id, UpdateNiveauScolaireRequest $request)
    {

        $niveauScolaire = $this->niveauScolaireRepository->find($id);

        if (empty($niveauScolaire)) {
            Flash::error(__('models/niveauScolaires.singular').' '.__('messages.not_found'));

            return redirect(route('niveauScolaires.index'));
        }

        $niveauScolaire = $this->niveauScolaireRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/niveauScolaires.singular')]));

        return redirect(route('niveauScolaires.index'));
    }

    /**
     * Remove the specified NiveauScolaire from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {

        $niveauScolaire = $this->niveauScolaireRepository->find($id);

        if (empty($niveauScolaire)) {
            Flash::error(__('models/niveauScolaires.singular').' '.__('messages.not_found'));

            return redirect(route('niveauScolaires.index'));
        }

        $this->niveauScolaireRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/niveauScolaires.singular')]));

        return redirect(route('niveauScolaires.index'));
    }
    public function export(){
        return Excel::download(new NiveauScolaireExport, 'NiveauScolaires.xlsx');
    }
    public function import(Request $request){

        Excel::import(new NiveauScolaireImport , $request->file('file')->store('files'));
        return redirect()->back();
    }
}
