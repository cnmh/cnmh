<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="services-table">
            <thead>
                <tr>
                    <th>@lang('models/services.fields.name')</th>
                    <th>@lang('models/services.fields.description')</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->nom }}</td>
                        <td>{!! $service->description !!}</td>
                        <td style="width: 120px">
                            {!! Form::open(['route' => ['services.destroy', $service->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('services.show', [$service->id]) }}" class='btn btn-default btn-sm'>
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{ route('services.edit', [$service->id]) }}" class='btn btn-default btn-sm'>
                                    <i class="far fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')",
                                ]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $services])
        </div>
        <div class="float-left">
            <a href="{{ route('services.export') }}" class="btn btn-default swalDefaultQuestion">
                <i class="fas fa-download"></i> @lang('crud.export')
            </a>
            <button class="btn btn-default swalDefaultQuestion" data-toggle="modal" data-target="#importModel">
                <i class="fas fa-file-import"></i> @lang('crud.import')
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
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('crud.print') </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('services.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('crud.cancel')</button>
                        <button class="btn btn-success">@lang('crud.import')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
