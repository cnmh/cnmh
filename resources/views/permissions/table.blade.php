<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="permissions-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Guard Name</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('permissions.show', [$permission->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('permissions.edit', [$permission->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $permissions])
        </div>
        <div class="float-left">
            <a href="{{ route('permissions.export') }}" class="btn btn-default swalDefaultQuestion">
                <i class="fas fa-download"></i> Exporter
            </a>
            <button  class="btn btn-default swalDefaultQuestion" data-toggle="modal" data-target="#importModelPermission">
                <i class="fas fa-file-import"></i> Importer
            </button>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="importModelPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form action="{{ route('permissions.import') }}" method="post" enctype="multipart/form-data">
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
