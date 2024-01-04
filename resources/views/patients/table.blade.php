<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="patients-table">
            <thead>
            <tr>

                <th>Image</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Telephone</th>
                <th>Cin</th>
                <th>Email</th>
                <th>Adresse</th>

                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($patients as $patient)
            <tr>

                <td>
                    <img width="99" height="99"
                        src="{{ $patient->image }}">
                </td>
                    <td>{{ $patient->nom }}</td>
                    <td>{{ $patient->prenom }}</td>
                    <td>{{ $patient->telephone }}</td>
                    <td>{{ $patient->cin }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->adresse }}</td>

                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['patients.destroy', $patient->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('patients.show', [$patient->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('patients.edit', [$patient->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $patients])
        </div>
        <div class="float-left">
            @can('export-Patient')
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-download"></i> Exporter
                                </button>
                                @endcan
                                @can('import-Patient')
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-file-import"></i> Importer
                                </button>
                                @endcan
        </div>
    </div>
</div>
