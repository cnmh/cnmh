<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="menu-groups-table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Icon</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menuGroups as $menuGroup)
                <tr>
                    <td>{{ $menuGroup->nom }}</td>
                    <td>{{ $menuGroup->description }}</td>
                    <td>{!! $menuGroup->icon !!}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['menu-groups.destroy', $menuGroup->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('menu-groups.show', [$menuGroup->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('menu-groups.edit', [$menuGroup->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $menuGroups])
        </div>
        <div class="float-left">
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-download"></i> Exporter
                                </button>
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-file-import"></i> Importer
                                </button>
        </div>
    </div>
</div>
