<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="orientation-externes-table">
            <thead>
            <tr>
                <th>Dossier Patient Id</th>
                <th>Service Id</th>
                <th>Objet</th>
                <th>Description</th>
                <th>Date Orientation</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orientationExternes as $orientationExterne)
                <tr>
                    <td>{{ $orientationExterne->dossier_patient_id }}</td>
                    <td>{{ $orientationExterne->service_id }}</td>
                    <td>{{ $orientationExterne->objet }}</td>
                    <td>{{ $orientationExterne->description }}</td>
                    <td>{{ $orientationExterne->date_orientation }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['orientationExternes.destroy', $orientationExterne->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('orientation-externes.show', [$orientationExterne->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('orientation-externes.edit', [$orientationExterne->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $orientationExternes])
        </div>
        <div class="float-left">
            @can('export-OrientationExterne')
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-download"></i> Exporter
                                </button>
                                @endcan
                                @can('import-OrientationExterne')
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-file-import"></i> Importer
                                </button>
                                @endcan
        </div>
    </div>
</div>
