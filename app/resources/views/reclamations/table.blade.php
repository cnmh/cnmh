<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="reclamations-table">
            <thead>
            <tr>
              
                <th>Objet</th>
                <th>Reclamation</th>
                <th>Date Reclamation</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reclamations as $reclamation)
                <tr>
                    {{-- <td>{{ $reclamation->patients_id }}</td> --}}
                    <td style="max-width: 180px;">{{ $reclamation->objet }}</td>
                    <td style="max-width: 180px;">{{ $reclamation->reclamation }}</td>
                    <td style="max-width: 30px;">{{ $reclamation->date_reclamation }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['reclamations.destroy', $reclamation->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('reclamations.show', [$reclamation->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('reclamations.edit', [$reclamation->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $reclamations])
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
