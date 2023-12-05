<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="users-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{--
                            <a href="{{ route('users.show', [$user->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a> 
                            --}}
                            @can('update-User')

                            <a href="{{ route('manage.role.permission', [$user->id]) }}" class='btn btn-default btn-sm d-flex'>
                                <i class="far fa-edit mr-2 mt-1"></i>
                                Parametre
                            </a>
                            @endcan
                            {{-- 
                            <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-default btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                            --}}
                            @can('destroy-User')

                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $users])
        </div>
        <div class="float-left d-flex">
            @can('export-User')

            <form action="{{ route('users.export') }}" method="post">
                @csrf 
                <button type="submit" class="btn btn-default swalDefaultQuestion">
                    <i class="fas fa-download"></i> Exporter
                </button>
            </form>
                
            @endcan
            @can('import-User')
                <button  class="btn btn-default swalDefaultQuestion ml-3" data-toggle="modal" data-target="#importModel">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Importer </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">
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