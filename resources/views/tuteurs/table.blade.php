<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="tuteurs-table">
            <thead>
            <tr>

                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>CIN</th>

                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tuteurs as $tuteur)
                <tr>

                    <td>{{ $tuteur->nom }}</td>
                    <td>{{ $tuteur->prenom }}</td>
                    <td>{{ $tuteur->sexe }}</td>
                    <td>{{ $tuteur->telephone }}</td>
                    <td>{{ $tuteur->email }}</td>
                    <td>{{ $tuteur->adresse }}</td>
                    <td>{{ $tuteur->cin }}</td>

                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['tuteurs.destroy', $tuteur->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('tuteurs.show', [$tuteur->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('tuteurs.edit', [$tuteur->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $tuteurs])
        </div>
        <div class="float-left">
            @can('export-Tuteur')
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-download"></i> Exporter
                                </button>
                                @endcan
                                @can('import-Tuteur')
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-file-import"></i> Importer
                                </button>
                                @endcan
        </div>
    </div>
</div>
