<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped" id="rendez-vouses-table">
            <thead>
            <tr>

                <th>N° de dossier</th>
                <th>Date du rendez-vous</th>
                <th>État</th>
                <th>Remarques</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($rendezVouses as $rendezVous)
                <tr>
                    <td>{{ $rendezVous->numero_dossier }}</td>
                    <td>{{ $rendezVous->date_rendez_vous }}</td>
                    <td><span class="badge bg-info">{{  $rendezVous->etat  }}</span></td>
                    <td>{!! $rendezVous->remarques !!}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['rendez-vous.destroy', $rendezVous->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rendez-vous.show', [$rendezVous->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-eye"></i>
                            </a>
                            {{-- <a href="{{ route('rendez-vous.edit', [$rendezVous->id]) }}"
                               class='btn btn-default btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
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
            @include('adminlte-templates::common.paginate', ['records' => $rendezVouses])
        </div>
        <div class="float-left">
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-download"></i> @lang('crud.export')
                                </button>
                                <button type="button" class="btn btn-default swalDefaultQuestion">
                                    <i class="fas fa-file-import"></i> @lang('crud.import')
                                </button>
        </div>
    </div>
</div>
