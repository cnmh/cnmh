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



                        @include('dossier_patients.stepper')
                        <div class="card-header">

                            <div class="col-sm-12 d-flex justify-content-between">
                                <div class="col-sm-6">
                                    <a class="btn btn-primary " href="{{ route('tuteurs.create') }}?=parentForm">

                                        @lang('crud.add_new') {{strtolower(__('models/tuteurs.singular'))}}
                                    </a>
                                </div>

                                <!-- SEARCH FORM -->
                                <form class="form-inline ml-3">
                                    <div class="input-group input-group-sm">
                                        <input type="search" class="form-control form-control-lg" placeholder="@lang('crud.search')">
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
                                <form action="{{ route('dossier-patients.patient') }}" method="GET">

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
                                        <tbody>
                                            @foreach ($tuteurs as $tuteur)
                                                <tr>
                                                    <td>

                                                        <input type="radio" name="parentRadio" value="{{ $tuteur->id }}" {{ $tuteur->id == request('tuteur_id') ? 'checked' : '' }}>
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

                                                        @can('destroy-Tuteur')
                                                        <a href="{{ route('tuteurs.destroy', [$tuteur->id]) }}" class='btn btn-danger btn-xs' onclick="return confirm('Are you sure?')">
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
                                    <button type="button" class="btn btn-default swalDefaultQuestion">
                                        <i class="fas fa-download"></i> @lang('crud.export')
                                    </button>
                                    <button type="button" class="btn btn-default swalDefaultQuestion">
                                        <i class="fas fa-file-import"></i> @lang('crud.import')
                                    </button>
                                </div>
                            </div>
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
        const tableContainer = $('#table-container')
        var searchQuery = ''

        const search = (query = '', page = 1) => {
            $.ajax('{{ route('tuteurs.index') }}', {
                data: {
                    query: query,
                    page: page
                },
                success: (data) => updateTable(data)
            })
            history.pushState(null, null, '?query=' + query + '&page=' + page)
        }

        const updateTable = (html) => {
            tableContainer.html(html)
            updatePaginationLinks()
        }

        const updatePaginationLinks = () => {
            $('button[page-number]').each(function() {
                $(this).on('click', function() {
                    pageNumber = $(this).attr('page-number')
                    search(searchQuery, pageNumber)
                })
            })
        }

        $(document).ready(() => {
            $('[type="search"]').on('input', function() {
                searchQuery = $(this).val()
                search(searchQuery)
            })
            updatePaginationLinks()
        var parentId = {{ request('tuteur_id') ?: 'null' }};
    if (parentId) {
        $("input[name='parentRadio'][value='" + parentId + "']").prop('checked', true);
    }
        })

    </script>

@endpush
