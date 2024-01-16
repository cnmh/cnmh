<?php

namespace App\Http\Controllers\Parametres;

use App\Exports\ExportCouvertureMedical;
use App\Http\Requests\CreateCouvertureMedicalRequest;
use App\Http\Requests\UpdateCouvertureMedicalRequest;
use App\Http\Controllers\AppBaseController;
use App\Imports\ImportCouvertureMedical;
use App\Repositories\CouvertureMedicalRepository;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @author CodeCampers, Boukhar Soufiane
*/

class CouvertureMedicalController extends AppBaseController
{
    /** @var CouvertureMedicalRepository $couvertureMedicalRepository*/
    private $couvertureMedicalRepository;

    public function __construct(CouvertureMedicalRepository $couvertureMedicalRepo)
    {
        $this->couvertureMedicalRepository = $couvertureMedicalRepo;
    }

    /**
     * Display a listing of the CouvertureMedical.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $couvertureMedicals = $this->couvertureMedicalRepository->paginate($query);

        if ($request->ajax()) {
            return view('couverture_medicals.table')
                ->with('couvertureMedicals', $couvertureMedicals);
        }

        return view('couverture_medicals.index')
            ->with('couvertureMedicals', $couvertureMedicals);
    }

    /**
     * Show the form for creating a new CouvertureMedical.
     */
    public function create()
    {
        return view('couverture_medicals.create');
    }

    /**
     * Store a newly created CouvertureMedical in storage.
     */
    public function store(CreateCouvertureMedicalRequest $request)
    {

        $input = $request->all();

        $couvertureMedical = $this->couvertureMedicalRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/couvertureMedicals.singular')]));

        return redirect(route('couvertureMedicals.index'));
    }

    /**
     * Display the specified CouvertureMedical.
     */
    public function show($id)
    {
        $couvertureMedical = $this->couvertureMedicalRepository->find($id);

        if (empty($couvertureMedical)) {
            Flash::error(__('models/couvertureMedicals.singular').' '.__('messages.not_found'));

            return redirect(route('couvertureMedicals.index'));
        }

        return view('couverture_medicals.show')->with('couvertureMedical', $couvertureMedical);
    }

    /**
     * Show the form for editing the specified CouvertureMedical.
     */
    public function edit($id)
    {
        $couvertureMedical = $this->couvertureMedicalRepository->find($id);

        if (empty($couvertureMedical)) {
            Flash::error(__('models/couvertureMedicals.singular').' '.__('messages.not_found'));

            return redirect(route('couvertureMedicals.index'));
        }

        return view('couverture_medicals.edit')->with('couvertureMedical', $couvertureMedical);
    }

    /**
     * Update the specified CouvertureMedical in storage.
     */
    public function update($id, UpdateCouvertureMedicalRequest $request)
    {
        $couvertureMedical = $this->couvertureMedicalRepository->find($id);

        if (empty($couvertureMedical)) {
            Flash::error(__('models/couvertureMedicals.singular').' '.__('messages.not_found'));

            return redirect(route('couvertureMedicals.index'));
        }

        $couvertureMedical = $this->couvertureMedicalRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/couvertureMedicals.singular')]));

        return redirect(route('couvertureMedicals.index'));
    }

    /**
     * Remove the specified CouvertureMedical from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $couvertureMedical = $this->couvertureMedicalRepository->find($id);

        if (empty($couvertureMedical)) {
            Flash::error(__('models/couvertureMedicals.singular').' '.__('messages.not_found'));

            return redirect(route('couvertureMedicals.index'));
        }

        $this->couvertureMedicalRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/couvertureMedicals.singular')]));

        return redirect(route('couvertureMedicals.index'));
    }

    public function export(){
        return Excel::download(new ExportCouvertureMedical, 'Couvertures-médicales.xlsx');
    }
    public function import(Request $request){
        Excel::import(new ImportCouvertureMedical, $request->file('file')->store('files'));
        return redirect()->back();
    }
}
