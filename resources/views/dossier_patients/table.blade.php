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
                @if($dossierPatients->isEmpty())
                <tr>
                    <td class="text-center">Aucune dossier trouvée</td>
                </tr>
                @else
                @foreach($dossierPatients as $dossierPatient)
                <tr>
                    <td>{{ $dossierPatient->numero_dossier }}</td>
                    <td>{{ $dossierPatient->patient->nom }}</td>
                    {{-- <td>{{ $dossierPatient->couvertureMedical->nom }}</td> --}}
                    <td><span class="badge bg-success">{{ $dossierPatient->etat }}</span></td>
                    {{-- <td>{{ $dossierPatient->date_enregsitrement }}</td> --}}

                    <td style="width: 120px">
                        {!! Form::open(['route' => ['dossier-patients.destroy', $dossierPatient->numero_dossier], 'method' =>
                        'delete']) !!}

                        <div class='btn-group'>
                            
                            <a href="{{ route('dossier-patients.show', [$dossierPatient->numero_dossier]) }}"
                                class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                           
                            @can('edit-DossierPatient')
                            <a href="{{ route('dossier-patients.edit', [$dossierPatient->numero_dossier]) }}"
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
                @endif
                
            </tbody>
        </table>
    </div>


</div>

<div class="card-footer clearfix">
    {{--<div class="float-left">
        @can('export-DossierPatient')
        <a class="btn btn-default swalDefaultQuestion" href="{{ route('dossier-patients.export') }}"><i
                class="fas fa-download"></i>@lang('crud.export')</a>
        @endcan
        
        @can('import-DossierPatient')
        <button class="btn btn-default swalDefaultQuestion" data-toggle="modal" data-target="#importModel">
                <i class="fas fa-file-import"></i> @lang('crud.import')
        </button>
        @endcan
       
    </div> --}}
    <div class="float-right">
        @include('adminlte-templates::common.paginate', ['records' => $dossierPatients])
    </div>
</div>



<!-- Modal Import -->
<div class="modal fade" id="importModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('crud.print') </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dossier-patients.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('crud.cancel')</button>
                        <button class="btn btn-success">@lang('crud.import')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>