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
                        <h1>Consultation {{ App\Models\Consultation::OrientationType() }}</h1>
                    </div>

                </div>
            </div>
        </section>
        <div class="row">

            <div class="col-md-12">
                <div class="card card-default">
                    <div class="steps">
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step  done">
                                <div class="md-step-circle"><span>1</span></div>
                                <div class="md-step-title">Rendez-Vous</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active done">
                                <div class="md-step-circle"><span>2</span></div>
                                <div class="md-step-title">Patient</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step ">
                                <div class="md-step-circle"><span>3</span></div>
                                <div class="md-step-title">Consultation</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>

                        </div>
                    </div>

                    <br>

                    <div id="information-part" class="content" role="tabpanel"
                        aria-labelledby="information-part-trigger">
                        <div class="d-flex">

                            <div class="card-body">
                                <table class="table table-striped projects">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img width="99" height="99"
                                                    src="{{ asset($dossier_patient->patient->image) }}">
                                            </td>
                                            <td>
                                            </td>
                                        <tr>
                                            <td>
                                                Numéro:
                                            </td>
                                            <td>
                                                {{ $dossier_patient->numero_dossier }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nom:
                                            </td>
                                            <td>
                                                {{ $dossier_patient->patient->nom }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Prénom:
                                            </td>
                                            <td>

                                                {{ $dossier_patient->patient->prenom }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Téléphone:
                                            </td>
                                            <td>
                                                {{ $dossier_patient->patient->telephone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                CIN:
                                            </td>
                                            <td>
                                                {{ $dossier_patient->patient->cin }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Adresse:
                                            </td>
                                            <td>
                                                {{ $dossier_patient->patient->adresse }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Date d'enregistrement:
                                            </td>
                                            <td>

                                                {{ $dossier_patient->date_enregsitrement }}
                                            </td>
                                        </tr>

                                        <td>
                                            Remarques:
                                        </td>
                                        <td>
                                            {!! $dossier_patient->patient->remarques !!}
                                        </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="dossier_patient_id" value="{{ $dossier_patient->id }}">
                        <input type="hidden" name="consultation_id" value="{{ $consultation_id }}">
                        <div class="ml-4 mb-3">
                            <a href="{{ route('consultations.rendezvous',  App\Models\Consultation::OrientationType()) }} "
                                class="btn btn-primary">@lang('crud.previous')</a>
                                <a href="{{ route('consultations.FormAjouterConsultation', ['type' => App\Models\Consultation::OrientationType(), 'dossier_patient_id' => $dossier_patient->id]) }}"
                                    class="btn btn-primary">@lang('crud.next')</a>                                 
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- /.card -->



    </div>
</section>
@endsection