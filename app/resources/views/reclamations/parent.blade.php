@extends('layouts.app')

@section('content')
    <section class="content-header">
        {{-- <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/tuteurs.plural')</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('tuteurs.create') }}">
                         @lang('crud.add_new') Tuteur
                    </a>
                </div>
            </div>
        </div> --}}
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card-header">
            <div class="col-sm-12 d-flex justify-content-between p-0">
                <div>
                </div>
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input type="search" class="form-control form-control-lg" placeholder="Recherche">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" id="table-container">
            <div class="card-body p-0">
                <div class="table-responsive">
                    @php
                    $url = parse_url($_SERVER['REQUEST_URI']);
                    // var_dump($url['query']);
                @endphp
                    <form action="{{route('reclamations.patient')}}" method="GET">

                        <table class="table table-striped" id="tuteurs-table">
                        <thead>
                            <tr>
                                <th>Etat Civil Id</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Sexe</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Cin</th>
                                <th>Remarques</th>
                                <th colspan="3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tuteurs as $tuteur)
                                <tr>
                                    <td>

                                        <input type="radio" value="{{ $tuteur->id }}" name="parentRadio"
                                            aria-label="Radio button for following text input" >
                                    </td>
                                    <td>{{ $tuteur->etat_civil_id }}</td>
                                    <td>{{ $tuteur->nom }}</td>
                                    <td>{{ $tuteur->prenom }}</td>
                                    <td>{{ $tuteur->sexe }}</td>
                                    <td>{{ $tuteur->telephone }}</td>
                                    <td>{{ $tuteur->email }}</td>
                                    <td>{{ $tuteur->adresse }}</td>
                                    <td>{{ $tuteur->cin }}</td>
                                    <td>{{ $tuteur->remarques }}</td>
                                    <td style="width: 120px">

                                        <div class='btn-group'>
                                            <a href="{{ route('tuteurs.show', [$tuteur->id]) }}"
                                                class='btn btn-default btn-sm'>
                                                <i class="far fa-eye"></i>
                                            </a>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <button  class="btn btn-primary">Next</button>
                </form>
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
        </div>
    </div>
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
        })
    </script>
@endpush
