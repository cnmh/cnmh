<?php

namespace App\Http\Controllers;

use App\Exports\ServiceExport;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Imports\ServiceImport;
use Maatwebsite\Excel\Facades\Excel;

// use Flash;

/**
 * @author codeCampers, Boukhar Soufiane
 */


class ServiceController extends AppBaseController
{
    /** @var ServiceRepository $serviceRepository*/
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * Display a listing of the Service.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
    */

    public function index(Request $request)
    {

            $query = $request->input('query');
            $services = $this->serviceRepository->paginate($query);

            if ($request->ajax()) {
                return view('services.table')
                    ->with('services', $services);
            }

            return view('services.index')
                ->with('services', $services);
    }

    /**
     * Show the form for creating a new Service.
     *
     * @return \Illuminate\View\View
    */

    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created Service in storage.
     *
     * @param  \App\Http\Requests\CreateServiceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
    */
    
    public function store(CreateServiceRequest $request)
    {
        $input = $request->all();

        $service = $this->serviceRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/services.singular')]));

        return redirect(route('services.index'));
    }

    /**
     * Display the specified Service.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
    */

    public function show($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        return view('services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified Service.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
    */

    public function edit($id)
    {

        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        return view('services.edit')->with('service', $service);
    }

    /**
     * Update the specified Service in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
    */

    public function update($id, UpdateServiceRequest $request)
    {

        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        $service = $this->serviceRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/services.singular')]));

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified Service from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {

        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        $this->serviceRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/services.singular')]));

        return redirect(route('services.index'));
    }

    /**
     * Export services to an Excel file.
     *
     * @return \Illuminate\Http\DownloadResponse
    */

    public function export(){
        return Excel::download(new ServiceExport, 'prestation.xlsx');
    }

    /**
     * Import services from an Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
    */

    public function import(Request $request){


        Excel::import(new ServiceImport, $request->file('file')->store('files'));
        return redirect()->back();
    }
}