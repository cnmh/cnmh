@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/dossierPatients.plural')</h1>
                </div>
                <div class="col-sm-6">
                    @can('create-DossierPatient')
                    <a class="btn btn-primary float-right"
                       href="{{ route('dossier-patients.parent') }}">
                         @lang('crud.add_new')
                    </a>
                    @endcan
                </div>
            </div>
        </div>
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
                        <input type="search" class="form-control form-control-lg" id="search" placeholder="Recherche">
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
            @include('dossier_patients.table')
        </div>
    </div>

@endsection

@push('page_scripts')
    


<script>
$(document).ready(function() {
    function fetch_data(page, search) {
        $.ajax({
            url: "dossier-patients",
            data: {
                page: page,
                search: search
            },
            success: function(data) {
                $('#dossier-patients-table').html($(data).find('#dossier-patients-table').html());
                $('.card-footer').html($(data).find('.card-footer').html());
                var paginationHtml = $(data).find('.pagination').html();
                $('.pagination').html(paginationHtml || '');
            }
        });
    }

    $('body').on('click', '.pagination li', function(event) {
        event.preventDefault();
        var page = $(this).find('.page-link').attr('page-number');
        var search = $('#search').val();
        fetch_data(page, search);
    });

    $('body').on('keyup', '#search', function() {
        var search = $(this).val();
        var page = 1;
        fetch_data(page, search);
    });

    fetch_data(1, '');
});

</script>
@endpush

