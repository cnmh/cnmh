<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="menu-items-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Icon</th>
                <th>URL</th>
                <th>Visible</th>
                <th>Menu Group</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menuItems as $menuItem)
                <tr>
                    <td>{{ $menuItem->nom }}</td>
                    <td>{{ $menuItem->description }}</td>
                    <td>{!! $menuItem->icon !!}</td>
                    <td>{{ $menuItem->url }}</td>
                    <td>{{ $menuItem->visible ? 'Yes' : 'No' }}</td>
                    <td>{{ $menuItem->menu_group?->nom }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['menu-items.destroy', $menuItem->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('menu-items.show', [$menuItem->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('menu-items.edit', [$menuItem->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $menuItems])
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
