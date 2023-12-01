<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTuteurRequest;
use App\Http\Requests\UpdateTuteurRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\EtatCivil;
use App\Repositories\TuteurRepository;
use Illuminate\Http\Request;
use Flash;

/**
 * @author codeCampers, Boukhar Soufiane
 */

class TuteurController extends AppBaseController
{
    /** @var TuteurRepository $tuteurRepository*/
    private $tuteurRepository;

    public function __construct(TuteurRepository $tuteurRepo)
    {
        $this->tuteurRepository = $tuteurRepo;
    }

    /**
     * Display a listing of the Tuteur.
     */
    public function index(Request $request)
    {

        $query = $request->input('query');
        $tuteurs = $this->tuteurRepository->paginate($query);
        if ($request->ajax()) {
            return view('tuteurs.table')
                ->with('tuteurs', $tuteurs);
        }

        return view('tuteurs.index')
            ->with('tuteurs', $tuteurs);
    }

    /**
     * Show the form for creating a new Tuteur.
     */
    public function create()
    {
        $etat_civil = EtatCivil::all();
        return view('tuteurs.create', compact("etat_civil"));
    }

    /**
     * Store a newly created Tuteur in storage.
     */
    public function store(CreateTuteurRequest $request)
    {


        $input = $request->all();

        $tuteur = $this->tuteurRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tuteurs.singular')]));


        if ($request->parentForm) {
            return redirect("/patientForm?parentRadio=$tuteur->id");
        } else {

            return redirect(route('tuteurs.index'));
        }
    }

    /**
     * Display the specified Tuteur.
     */
    public function show($id)
    {
        $tuteur = $this->tuteurRepository->find($id);

        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));

            return redirect(route('tuteurs.index'));
        }

        return view('tuteurs.show')->with('tuteur', $tuteur);
    }

    /**
     * Show the form for editing the specified Tuteur.
     */
    public function edit($id)
    {
        $tuteur = $this->tuteurRepository->find($id);

        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));

            return redirect(route('tuteurs.index'));
        }

        return view('tuteurs.edit')->with('tuteur', $tuteur);
    }

    /**
     * Update the specified Tuteur in storage.
     */
    public function update($id, UpdateTuteurRequest $request)
    {
        $tuteur = $this->tuteurRepository->find($id);

        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));

            return redirect(route('tuteurs.index'));
        }

        $tuteur = $this->tuteurRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tuteurs.singular')]));

        return redirect(route('tuteurs.index'));
    }

    /**
     * Remove the specified Tuteur from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tuteur = $this->tuteurRepository->find($id);

        if (empty($tuteur)) {
            Flash::error(__('models/tuteurs.singular') . ' ' . __('messages.not_found'));

            return redirect(route('tuteurs.index'));
        }

        $this->tuteurRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tuteurs.singular')]));

        return redirect(route('tuteurs.index'));
    }
}
