<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="couverture-medicals-table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($couvertureMedicals as $couvertureMedical)
                <tr>
                    <td>{{ $couvertureMedical->nom }}</td>
                    <td>{!! $couvertureMedical->description !!}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['couvertureMedicals.destroy', $couvertureMedical->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('couvertureMedicals.show', [$couvertureMedical->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('couvertureMedicals.edit', [$couvertureMedical->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $couvertureMedicals])
        </div>
        <div class="float-left">
                                <a href="{{ route('couvertureMedicals.export') }}" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-download"></i> Exporter
                                </a>
                                <button  class="btn btn-default swalDefaultQuestion" data-toggle="modal" data-target="#importModel">
                                    <i class="fas fa-file-import"></i> Importer
                                </button>
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
                <form action="{{ route('couvertureMedicals.import') }}" method="post" enctype="multipart/form-data">
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
