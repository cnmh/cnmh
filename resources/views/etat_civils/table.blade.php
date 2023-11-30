{{-- <div class="card-header">
    <div class="col-sm-12 p-3">
        <div class="d-flex justify-content-between">
            <select   class="form-select  btn-default dropdown-toggle ml-2 filter" aria-label="Default select example">
                <option selected>Parents</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="{{ route('etatCivils.create') }}">
                    @lang('crud.add_new') @lang('models/etatCivils.singular')
                </a>
            </div>
            <a href="{{ route('etatCivils.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
            </a>
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input type="search" class="form-control form-control-lg" placeholder="Tapez vos mots-clés ici">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}


<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="etat-civils-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etatCivils as $etatCivil)
                    <tr>
                        <td>{!! $etatCivil->nom !!}</td>
                        <td>{!! $etatCivil->description !!}</td>
                        <td style="width: 120px">
                            {!! Form::open(['route' => ['etatCivils.destroy', $etatCivil->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                @can('show-EtatCivilController')
                                <a href="{{ route('etatCivils.show', [$etatCivil->id]) }}"
                                    class='btn btn-default btn-sm'>
                                    <i class="far fa-eye"></i>
                                </a>
                                @endcan
                                @can('edit-EtatCivilController')
                                <a href="{{ route('etatCivils.edit', [$etatCivil->id]) }}"
                                    class='btn btn-default btn-sm'>
                                    <i class="far fa-edit"></i>
                                </a>
                                @endcan
                                @can('destroy-EtatCivilController')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Est vous sure de supprimer ce champ?')",
                                ]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $etatCivils])
        </div>
        <div class="float-left">
        @can('export-EtatCivilController')
            <a href="{{ route('etatCivils.export') }}" class="btn btn-default swalDefaultQuestion">
                <i class="fas fa-download"></i> Exporter
            </a>
            @endcan
            @can('import-EtatCivilController')
            <button class="btn btn-default swalDefaultQuestion" data-toggle="modal" data-target="#importModel">
                <i class="fas fa-file-import"></i> Importer
            </button>
            @endcan
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="importModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Choisir un fichier excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('etatCivils.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end Model --}}

