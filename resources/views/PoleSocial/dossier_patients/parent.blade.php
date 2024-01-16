@extends('layouts.app')

@section('content')
    <section class="content-header">


        <div class="container-fluid">

        </div>
    </section>


    <section class="content">
        <div class="container-fluid ">
            @include('flash::message')

            <div class="clearfix"></div>


            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@lang('models/dossierPatients.plural')</h1>
                        </div>
                      
                    </div>
                </div>
            </section>
            <div class="row">

                <div class="col-md-12">

                    <div class="card card-default">



                        @include('PoleSocial.dossier_patients.stepper')
                        <div class="card-header">

                            <div class="col-sm-12 d-flex justify-content-between">
                                <div class="col-sm-6">
                                    <a class="btn btn-primary " href="{{ route('FormAjoute.tuteurs') }}?=parentForm">

                                        @lang('crud.add_new') {{strtolower(__('models/tuteurs.singular'))}}
                                    </a>
                                </div>

                                <!-- SEARCH FORM -->
                                <form class="form-inline ml-3">
                                    <div class="input-group input-group-sm">
                                        <input type="search" id="searchTuteur" class="form-control form-control-lg" placeholder="@lang('crud.search')">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-lg btn-default">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                @php
                                    $url = parse_url($_SERVER['REQUEST_URI']);
                                    // var_dump($url['query']);
                                @endphp
                                <form action="{{ route('Select.tuteurs') }}" method="GET">

                                    <table class="table table-striped" id="tuteurs-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>@lang('models/tuteurs.fields.nom')</th>
                                                <th>@lang('models/tuteurs.fields.prenom')</th>
                                                <th>@lang('models/tuteurs.fields.telephone')</th>
                                                <th>@lang('models/tuteurs.fields.email')</th>
                                                <th>@lang('models/tuteurs.fields.adresse')</th>
                                                <th> @lang('models/tuteurs.fields.etat_civil_id')</th>

                                                {{-- <th>Cin</th>
                                            <th>Remarques</th> --}}
                                                <th colspan="3">@lang('crud.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tuteurTable">
                                            @foreach ($tuteurs as $tuteur)
                                                <tr>
                                                    <td>
                                                        <input type="radio" name="tuteurID" value="{{ $tuteur->id }}" {{ $tuteur->id == request('tuteur_id') ? 'checked' : '' }}>
                                                    </td>

                                                    <td>{{ $tuteur->nom }}</td>
                                                    <td>{{ $tuteur->prenom }}</td>
                                                    <td>{{ $tuteur->telephone }}</td>
                                                    <td>{{ $tuteur->email }}</td>
                                                    <td>{{ $tuteur->adresse }}</td>
                                                    <td>{{ $tuteur->etatCivil->nom }}</td>
                                                    {{-- <td>{{ $tuteur->cin }}</td>
                                                <td>{{ $tuteur->remarques }}</td> --}}
                                                <td style="width: 120px">
                                                    <div class='btn-group'>
                                                        @can('show-Tuteur')
                                                        <a href="{{ route('tuteurs.show', [$tuteur->id]) }}" class='btn btn-default btn-sm'>
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                        @endcan

                                                        @can('edit-Tuteur')
                                                            <a href="{{ route('tuteurs.edit', [$tuteur->id]) }}" class='btn btn-default btn-sm'>
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                        @endcan

                                                        {{--@can('destroy-Tuteur')
                                                        <form action="{{ route('tuteurs.destroy', [$tuteur->id]) }}" method="post">
                                                            @csrf 
                                                            @method('POST')
                                                            <button type="submit" class='btn btn-danger btn-xs' onclick="return confirm('Are you sure?')">
                                                            <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                            
                                                        @endcan --}}

                                                        @can('destroy-Tuteur')
                                                            <a href="#" class="btn btn-danger btn-xs" onclick="deleteTuteur({{ $tuteur->id }})">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        @endcan


                                                    </div>
                                                </td>

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>


                            </div>
                            <div class="ml-4 mb-3">
                                <a href="{{ route('dossier-patients.index')}}"  class="btn btn-secondary">@lang('crud.cancel')</a>                                {{-- <a href="{{ route('dossier-patients.parent') }}" class="btn btn-primary">@lang('crud.previous')</a> --}}

                                <button id="next-button" class="btn btn-primary">@lang('crud.next')</button>

                            </div>
                            </form>
                            
                            <div class="card-footer clearfix">
                                <div class="float-right">
                                    @include('adminlte-templates::common.paginate', [
                                        'records' => $tuteurs,
                                    ])
                                </div>
                                <div class="float-left">
                                    @can('export-Tuteur')
                                    <button type="button" class="btn btn-default swalDefaultQuestion">
                                        <i class="fas fa-download"></i> @lang('crud.export')
                                    </button>
                                    @endcan
                                    @can('import-Tuteur')
                                    <button type="button" class="btn btn-default swalDefaultQuestion">
                                        <i class="fas fa-file-import"></i> @lang('crud.import')
                                    </button>
                                    @endcan
                                </div>
                            </div>
                            -
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                </div>
            </div>
            <!-- /.card -->



    </section>
@endsection

@push('page_scripts')
    
    <script>
       $(document).ready(function() {
        function fetch_data(page, search) {
            $.ajax({
                url: "/parentForm/?page=" + page + "&query=" + search.trim(),
                dataType: 'json', 
                success: function(response) {
                    $('#tuteurTable').html('');
                    var data = response.data.data;

                    for (var i = 0; i < data.length; i++) {
                        var row = '<tr>';
                        var rowData = data[i];

                        row += '<td><input type="radio" name="parentRadio" value="' + rowData.id + '" ' + (rowData.id == "{{ $tuteur->id }}" ? 'checked' : '') + '></td>';
                        row += '<td>' + rowData.tuteur_nom + '</td>';
                        row += '<td>' + rowData.prenom + '</td>';
                        row += '<td>' + rowData.telephone + '</td>';
                        row += '<td>' + rowData.email + '</td>';
                        row += '<td>' + rowData.adresse + '</td>';
                        row += '<td>' + rowData.etat_civil_nom + '</td>';
                        row += '<td style="width: 120px">';
                        row += '<div class="btn-group">';

                        row += '@can("show-Tuteur")';
                        row += '<a href="{{ route("tuteurs.show", ["tuteur" => ' + rowData.id + ']) }}" class="btn btn-default btn-sm">';
                        row += '<i class="far fa-eye"></i>';
                        row += '</a>';
                        row += '@endcan';

                        row += '@can("edit-Tuteur")';
                        row += '<a href="{{ route("tuteurs.edit", ["tuteur" => ' + rowData.id + ']) }}" class="btn btn-default btn-sm">';
                        row += '<i class="far fa-edit"></i>';
                        row += '</a>';
                        row += '@endcan';

                        row += '@can("destroy-Tuteur")';
                        row += '<a href="#" class="btn btn-danger btn-xs" onclick="deleteTuteur(' + rowData.id + ')">';
                        row += '<i class="far fa-trash-alt"></i>';
                        row += '</a>';
                        row += '@endcan';

                        row += '</div>';
                        row += '</td>';
                        row += '</tr>';

                        $('#tuteurTable').append(row);
                    }


                }


            });



        }

        $('body').on('click', '.pagination li', function(event) {
            event.preventDefault();
            var pageButton = $(this).find('.page-link');
            if (pageButton.length) {
                var page = pageButton.attr('page-number');
                var search = $('#searchTuteur').val();
                fetch_data(page, search);
            }
        });

        $('body').on('keyup', '#searchTuteur', function() {
            var search = $('#searchTuteur').val();
            var page = 1;

            console.log(search);
            fetch_data(page, search);
        });

       fetch_data(1, '');
    });

        function deleteTuteur(tuteurId) {
            const confirmDelete = confirm('Are you sure?');
            if (confirmDelete) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("tuteurs") }}/' + tuteurId;
                form.style.display = 'none';

                const csrfTokenInput = document.createElement('input');
                csrfTokenInput.type = 'hidden';
                csrfTokenInput.name = '_token';
                csrfTokenInput.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfTokenInput);
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }

    </script>

@endpush
