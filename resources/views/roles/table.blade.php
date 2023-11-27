<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="roles-table">
            <thead>
            <tr>
                <th>Nom</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('roles.show', [$role->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('roles.edit', [$role->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $roles])
        </div>
        <div class="float-left">
            <a href="{{ route('roles.export') }}" class="btn btn-default swalDefaultQuestion">
                <i class="fas fa-download"></i> Exporter
            </a>
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-file-import"></i> Importer
                                </button>
        </div>
    </div>
</div>
