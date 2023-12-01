@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('models/etatCivils.management')
                        des
                        {{ strtolower(__('models/etatCivils.plural')) }}
                    </h1>
                </div>
                @can('create-EtatCivilController')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('etatCivils.create') }}">
                        @lang('crud.create') @if (app()->getLocale() == 'fr')
                            {{ is_male_localisation('message.isMale') }}
                            @lang(strtolower(__('models/etatCivils.singular')))
                        @else
                            {{ strtolower(__('models/etatCivils.singular')) }}
                        @endif
                    </a>
                </div>
                @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card-header">
            <div class="col-sm-12 d-flex justify-content-end p-3">
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input type="search" class="form-control form-control-lg" placeholder="Tapez vos mots-clés ici">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" id="table-container">
            @include('etat_civils.table')
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        const tableContainer = $('#table-container')
        var searchQuery = ''
        const search = (query = '', page = 1) => {
            $.ajax('{{ route('etatCivils.index') }}', {
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
