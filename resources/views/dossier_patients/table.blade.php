<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="dossier-patients-table">
            <thead>
                <tr>
                    <th>N° dossier</th>
                    <th>Bénéficiaire</th>
                    {{-- <th>Couverture Medical</th> --}}
                    <th>État de processus</th>
                    {{-- <th>Date Enregsitrement</th> --}}
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dossierPatients as $dossierPatient)
                <tr>
                    <td>{{ $dossierPatient->numero_dossier }}</td>
                    <td>{{ $dossierPatient->patient->nom }}</td>
                    {{-- <td>{{ $dossierPatient->couvertureMedical->nom }}</td> --}}
                    <td><span class="badge bg-success">{{ $dossierPatient->etat }}</span></td>
                    {{-- <td>{{ $dossierPatient->date_enregsitrement }}</td> --}}

                    <td style="width: 120px">
                        {!! Form::open(['route' => ['dossier-patients.destroy', $dossierPatient->id], 'method' =>
                        'delete']) !!} 

                        <div class='btn-group'>
                            @can('show-DossierPatient')
                            <a href="{{ route('dossier-patients.show', [$dossierPatient->id]) }}"
                                class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('edit-DossierPatient')
                            <a href="{{ route('dossier-patients.edit', [$dossierPatient->id]) }}"
                                class='btn btn-default btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                            @endcan
                            @can('destroy-DossierPatient')
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn
                            btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} 
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $dossierPatients])
        </div>
        <div class="float-left">
            @can('export-DossierPatientController')
            <a class="btn btn-default swalDefaultQuestion" href="{{ route('dossier-patients.export') }}"><i class="fas fa-download"></i>@lang('crud.export')</a>
            @endcan
            @can('import-DossierPatientController')
            <button type="button" class="btn btn-default swalDefaultQuestion">
                <i class="fas fa-file-import"></i> @lang('crud.import')
            </button>
            @endcan
        </div>
    </div>
</div>
