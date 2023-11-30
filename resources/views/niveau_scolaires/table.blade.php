
<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width: 20%">@lang('models/niveauScolaires.fields.nom')</th>
                <th style="width: 70%">@lang('models/niveauScolaires.fields.description')</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody >
            @foreach($niveauScolaires as $niveauScolaire)
                <tr>
                    <td>{{ $niveauScolaire->nom }}</td>
                    <td>{!! $niveauScolaire->description !!}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['niveauScolaires.destroy', $niveauScolaire->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show-NiveauScolaireController')
                            <a href="{{ route('niveauScolaires.show', [$niveauScolaire->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('edit-NiveauScolaireController')
                            <a href="{{ route('niveauScolaires.edit', [$niveauScolaire->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                            @endcan
                            @can('destroy-NiveauScolaireController')
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $niveauScolaires])
        </div>
        <div class="float-left">
            @can('export-NiveauScolaireController')
            <a href="{{ route('niveauScolaires.export') }}" class="btn btn-default swalDefaultQuestion">
                <i class="fas fa-download"></i> Exporter
            </a>
            @endcan
            @can('import-NiveauScolaireController')
            <button  class="btn btn-default swalDefaultQuestion" data-toggle="modal" data-target="#importModel">
                <i class="fas fa-file-import"></i> Importer
            </button>
            @endcan
            
        </div>
    </div>
</div>


<!-- Modal Export Import -->
<div class="modal fade" id="importModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Importer </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('niveauScolaires.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end Modal --}}
