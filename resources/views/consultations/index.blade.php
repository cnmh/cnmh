@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                @if ($titleApp == "Liste d'attente")
                <h1>{{ $titleApp }}</h1>

                @else
                <h1>@lang('models/consultations.plural') {{$titleApp}}</h1>
                @endif
            </div>
            @if ($titleApp == "Liste d'attente")

            @else
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="{{ route('consultations.rendezVous',$title)}}">
                    @lang('crud.add_new') Consultation
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card-header">
        <div class="col-sm-12 d-flex justify-content-between p-0">
            <div class="mt-3">
                <div class="col-sm-12">

                    <div class="form-group d-flex">
                        <i class="fa-solid fa-filter mr-2 mt-2"></i>
                        <select class="form-control form-control-sm" id="selectSearch">
                            <option value="">Choisir l'état</option>
                            <option value="enAttente">En attente</option>
                            <option value="enConsultation">En consultation</option>
                            <option value="enRendezVous">En rendez-vous</option>
                        </select>

                    </div>
                </div>
            </div>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input type="search" class="form-control form-control-lg" id="searchConsultation"
                        placeholder="Recherche">
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
        @include('consultations.table')
    </div>
</div>

<script>
$(document).ready(function() {
    function fetch_data(page, search) {
        var modelName = "liste-attente";
        $.ajax({
            url: "/consultations/" + modelName + "/?page=" + page + "&query=" + search.trim(),
            success: function(data) {
                var newData = $(data);
                $('#consultations-table').html(newData.find('#consultations-table').html());
                $('.card-footer').html(newData.find('.card-footer').html());
                var paginationHtml = newData.find('.pagination').html();
                if (paginationHtml) {
                    $('.pagination').html(paginationHtml);
                } else {
                    $('.pagination').html('');
                }
            }
        });
    }

    $('body').on('click', '.pagination li', function(event) {
        event.preventDefault();
        var pageButton = $(this).find('.page-link');
        if (pageButton.length) {
            var page = pageButton.attr('page-number');
            var search = $('#searchConsultation').val();
            fetch_data(page, search);
        }
    });

    $('body').on('keyup', '#searchConsultation', function() {
        var search = $('#searchConsultation').val();
        var page = 1;
        fetch_data(page, search);
    });

    $('body').on('change', '#selectSearch', function() {
        var search = $('#selectSearch').val();
        var page = 1;
        fetch_data(page, search);
    });



    fetch_data(1, '');
});
</script>

@endsection
@push('page_scripts')

@endpush