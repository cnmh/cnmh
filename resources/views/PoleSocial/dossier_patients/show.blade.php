@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
@lang('models/dossierPatients.singular') N°{{$dossierPatient->numero_dossier}}
{{-- @lang('crud.detail') --}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('dossier-patients.index') }}">
                                                    @lang('crud.back')
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-header p-0 pt-0">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Patient et Parent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Entretien social</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-settings2-tab" data-toggle="pill" href="#custom-tabs-two-settings2" role="tab" aria-controls="custom-tabs-two-settings2" aria-selected="false">Rendez-vous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-settings3-tab" data-toggle="pill" href="#custom-tabs-two-settings3" role="tab" aria-controls="custom-tabs-two-settings3" aria-selected="false">Liste d’attente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab17" data-toggle="pill" href="#custom-tabs-five-normal7" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"> Infirmière médecin générale</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-settings1-tab" data-toggle="pill" href="#custom-tabs-two-settings1" role="tab" aria-controls="custom-tabs-two-settings1" aria-selected="false">Services</a>
                    </li> -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab1" data-toggle="pill" href="#custom-tabs-five-normal1" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">Psychomotricité</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab2" data-toggle="pill" href="#custom-tabs-five-normal2" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"> Kinésithérapeute</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab3" data-toggle="pill" href="#custom-tabs-five-normal3" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"> Orthophoniste</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab4" data-toggle="pill" href="#custom-tabs-five-normal4" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"> Orthoptiste</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab5" data-toggle="pill" href="#custom-tabs-five-normal5" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"> Ergothérapie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab6" data-toggle="pill" href="#custom-tabs-five-normal6" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"> Infirmière dentiste</a>
                    </li>
                   
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab8" data-toggle="pill" href="#custom-tabs-five-normal8" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">Service social</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-normal-tab9" data-toggle="pill" href="#custom-tabs-five-normal9" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">Infirmière neurologue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Orientations externes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Réclamations</a>
                    </li>--}}
                </ul>
            </div>
            <div class="card-body">
                {{-- <div class="row"> --}}
                    @include('PoleSocial.dossier_patients.show_fields')
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
