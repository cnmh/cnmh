

<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="employes-table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>prénom</th>

                <th>Téléphone</th>

                <th>E-mail</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employes as $employe)
                <tr>
                    <td>{{ $employe->nom }}</td>
                    <td>{{ $employe->prenom }}</td>
                    <td>{{ $employe->telephone }}</td>
                    <td>{{ $employe->email }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['employes.destroy', $employe->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show-EmployeController')
                            <a href="{{ route('employes.show', [$employe->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('edit-EmployeController')
                            <a href="{{ route('employes.edit', [$employe->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                            @endcan
                            @can('destroy-EmployeController')
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
            @include('adminlte-templates::common.paginate', ['records' => $employes])
        </div>
        <div class="float-left">
            @can('export-EmployeController')
            <a href="{{ route('employes.export') }}" class="btn btn-default swalDefaultQuestion">
                <i class="fas fa-download"></i> Exporter
            </a>
            @endcan
            @can('import-EmployeController')
            <button  class="btn btn-default swalDefaultQuestion" data-toggle="modal" data-target="#importModelEmploye">
                <i class="fas fa-file-import"></i> Importer
            </button>
            @endcan
        </div>
    </div>
</div>
<!-- Modal Import -->
<div class="modal fade" id="importModelEmploye" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form action="{{ route('employes.import') }}" method="post" enctype="multipart/form-data">
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
{{-- end Model --}}
