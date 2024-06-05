@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            @if (App\Models\Consultation\Consultation::SocialType() == "Liste-d'attente")
                <h1>List d'attente</h1>
            @else
                <h1>Consultations {{ App\Models\Consultation\Consultation::OrientationType() }}</h1>
            @endif

               
            </div>
            @if(\App\Models\Consultation\Consultation::OrientationType()==="Médecin-général")
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('consultations.rendezvous') }}">
                        @lang('crud.add_new') Consultation
                    </a>
                </div>
            @else
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route(\App\Models\Consultation\Consultation::OrientationType().'.rendezvous') }}">
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
                    @if(auth()->user()->email == 'social@gmail.com')
                    <div class="form-group d-flex">
                        <i class="fa-solid fa-filter mr-2 mt-2"></i>
                        <select class="form-control form-control-sm" id="selectSearch">
                            <option value="">Choisir la phase</option>
                            <option value="enAttente">En attente</option>
                            <option value="enConsultation">En consultation</option>
                            <option value="enRendezVous">En rendez-vous</option>
                        </select>

                    </div>
                    @endif
                </div>
            </div>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input type="search" class="form-control form-control-lg" id="table_search"
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
        @include('Consultations.table')
    </div>
</div>



@endsection
@push('page_scripts')

@endpush