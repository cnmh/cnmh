<?php

namespace App\Http\Controllers;

use App\Exports\ExportTypehandicap;
use App\Http\Requests\CreateTypeHandicapRequest;
use App\Http\Requests\UpdateTypeHandicapRequest;
use App\Http\Controllers\AppBaseController;
use App\Imports\importTypehandicap;
use App\Repositories\TypeHandicapRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Flash;
use Illuminate\Support\Facades\Gate;


/**
 * Class TypeHandicapController
 *
 * This class is responsible for handling TypeHandicap-related operations in your web application.
 * @package App\Http\Controllers
 * @author CodeCampers,boukhar Soufiane
 */

 
class TypeHandicapController extends AppBaseController
{
    /** @var TypeHandicapRepository $typeHandicapRepository */
    private $typeHandicapRepository;

    public function __construct(TypeHandicapRepository $typeHandicapRepo)
    {
        $this->typeHandicapRepository = $typeHandicapRepo;
    }

    /**
     * Display a listing of the TypeHandicap.
     *
     * @param Request $request
     * @return View
    */

    public function index(Request $request)
    {
        $query = $request->input('query');
        $typeHandicaps = $this->typeHandicapRepository->paginate($query);
        if ($request->ajax()) {
            return view('type_handicaps.table')
                ->with('typeHandicaps', $typeHandicaps);
        }
        return view('type_handicaps.index')
            ->with('typeHandicaps', $typeHandicaps);
    }

    /**
     * Show the form for creating a new TypeHandicap.
     *
     * @return View
    */

    public function create()
    {

        return view('type_handicaps.create');
    }

    /**
     * Store a newly created TypeHandicap in storage.
     *
     * @param CreateTypeHandicapRequest $request
     * @return RedirectResponse
    */

    public function store(CreateTypeHandicapRequest $request)
    {

        $input = $request->all();

        $typeHandicap = $this->typeHandicapRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/typeHandicaps.singular')]));

        return redirect(route('typeHandicaps.index'));
    }

    /**
     * Show the form for editing the specified TypeHandicap.
     *
     * @param $id
     * @return View
    */

    public function edit($id)
    {

        $typeHandicap = $this->typeHandicapRepository->find($id);

        if (empty($typeHandicap)) {
            Flash::error(__('models/typeHandicaps.singular').' '.__('messages.not_found'));

            return redirect(route('typeHandicaps.index'));
        }

        return view('type_handicaps.edit')->with('typeHandicap', $typeHandicap);
    }

    /**
     * Update the specified TypeHandicap in storage.
     *
     * @param $id
     * @param UpdateTypeHandicapRequest $request
     * @return RedirectResponse
    */

    public function update($id, UpdateTypeHandicapRequest $request)
    {

        $typeHandicap = $this->typeHandicapRepository->find($id);

        if (empty($typeHandicap)) {
            Flash::error(__('models/typeHandicaps.singular').' '.__('messages.not_found'));

            return redirect(route('typeHandicaps.index'));
        }

        $typeHandicap = $this->typeHandicapRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/typeHandicaps.singular')]));

        return redirect(route('typeHandicaps.index'));
    }

    /**
     * Remove the specified TypeHandicap from storage.
     *
     * @param $id
     * @return RedirectResponse
     * @throws \Exception
    */

    public function destroy($id)
    {
        
        $typeHandicap = $this->typeHandicapRepository->find($id);

        if (empty($typeHandicap)) {
            Flash::error(__('models/typeHandicaps.singular').' '.__('messages.not_found'));
            return redirect(route('typeHandicaps.index'));
        }

       
        $this->typeHandicapRepository->delete($id);
        Flash::success(__('messages.deleted', ['model' => __('models/typeHandicaps.singular')]));
        return redirect(route('typeHandicaps.index'));
       
    }


    /**
     * Show the specified TypeHandicap from storage.
     * @param Request $request
     * @return View
    */
    
    public function show($id){
        $typeHandicap = $this->typeHandicapRepository->find($id);

        if(empty($typeHandicap)){
            Flash::error(__('models/typeHandicaps.singular').' '.__('messages.not_found'));
            return redirect(route('typeHandicaps.index'));
        }
        return view('type_handicaps.show')->with('typeHandicap',$typeHandicap);
    }

    /**
     * Export the TypeHandicap data to an Excel file.
     *
     * @return BinaryFileResponse
    */

    public function export()
    {
        return Excel::download(new ExportTypehandicap, 'type handicap.xlsx');
    }

    /**
     * Import TypeHandicap data from an Excel file.
     *
     * @param Request $request
     * @return RedirectResponse
    */

    public function import(Request $request)
    {
        Excel::import(new importTypehandicap, $request->file('file')->store('files'));
        return redirect()->back();
    }
}
