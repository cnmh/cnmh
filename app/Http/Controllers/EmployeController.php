<?php

namespace App\Http\Controllers;

use App\Exports\ExportEmployes;
use App\Http\Requests\CreateEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Http\Controllers\AppBaseController;
use App\Imports\ImportEmployes;
use App\Models\Fonction;
use App\Repositories\EmployeRepository;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @author codeCampers, Boukhar Soufiane
 */

class EmployeController extends AppBaseController
{
    /** @var EmployeRepository $employeRepository*/
    private $employeRepository;

    public function __construct(EmployeRepository $employeRepo)
    {
        $this->employeRepository = $employeRepo;
    }

    /**
     * Display a listing of the Employe.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $employes = $this->employeRepository->paginate($query);

        if ($request->ajax()) {
            return view('employes.table')
                ->with('employes', $employes);
        }

        return view('employes.index')
            ->with('employes', $employes);
    }

        /**
         * Show the form for creating a new Employe.
         */
        public function create()
        {

            $fonction = Fonction::all();
            return view('employes.create',compact("fonction"));
     }

    /**
     * Store a newly created Employe in storage.
     */
    public function store(CreateEmployeRequest $request)
    {


        $input = $request->all();

        $employe = $this->employeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/employes.singular')]));

        return redirect(route('employes.index'));
    }

    /**
     * Display the specified Employe.
     */
    public function show($id)
    {
        $employe = $this->employeRepository->find($id);
        $fonction = $employe->fonction;

        if (empty($employe)) {
            Flash::error(__('models/employes.singular') . ' ' . __('messages.not_found'));

            return redirect(route('employes.index'));
        }

        return view('employes.show')
        ->with('employe', $employe)
        ->with("fonction", $fonction);;
    }

    /**
     * Show the form for editing the specified Employe.
     */
    public function edit($id)
    {


        $employe = $this->employeRepository->find($id);
        $fonction = $employe->fonction;
        if (empty($employe)) {
            Flash::error(__('models/employes.singular') . ' ' . __('messages.not_found'));

            return redirect(route('employes.index'));
        }

        return view('employes.edit')
        ->with("employe", $employe)
        ->with("fonction", $fonction);
    }

    /**
     * Update the specified Employe in storage.
     */
    public function update($id, UpdateEmployeRequest $request)
    {


        $employe = $this->employeRepository->find($id);

        if (empty($employe)) {
            Flash::error(__('models/employes.singular') . ' ' . __('messages.not_found'));

            return redirect(route('employes.index'));
        }

        $employe = $this->employeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/employes.singular')]));

        return redirect(route('employes.index'));
    }

    /**
     * Remove the specified Employe from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {


        $employe = $this->employeRepository->find($id);

        if (empty($employe)) {
            Flash::error(__('models/employes.singular') . ' ' . __('messages.not_found'));

            return redirect(route('employes.index'));
        }

        $this->employeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/employes.singular')]));

        return redirect(route('employes.index'));
    }
    public function export(){
        return Excel::download(new ExportEmployes , 'Employe.xlsx');
    }
    public function import(Request $request){
        

        Excel::import(new ImportEmployes, $request->file('file')->store('files'));
        return redirect()->back();
    }
}
