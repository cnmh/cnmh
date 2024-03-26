{{-- <!-- Patient Id Field -->
<div class="col-sm-12">
    {!! Form::label('patient_id', __('models/dossierPatients.fields.patient_id').':') !!}
    <p>{{ $dossierPatient->patient_id }}</p>
</div>

<!-- Couverture Medical Id Field -->
<div class="col-sm-12">
    {!! Form::label('couverture_medical_id', __('models/dossierPatients.fields.couverture_medical_id').':') !!}
    <p>{{ $dossierPatient->couverture_medical_id }}</p>
</div>

<!-- Numero Dossier Field -->
<div class="col-sm-12">
    {!! Form::label('numero_dossier', __('models/dossierPatients.fields.numero_dossier').':') !!}
    <p>{{ $dossierPatient->numero_dossier }}</p>
</div>

<!-- Etat Field -->
<div class="col-sm-12">
    {!! Form::label('etat', __('models/dossierPatients.fields.etat').':') !!}
    <p>{{ $dossierPatient->etat }}</p>
</div>

<!-- Date Enregsitrement Field -->
<div class="col-sm-12">
    {!! Form::label('date_enregsitrement', __('models/dossierPatients.fields.date_enregsitrement').':') !!}
    <p>{{ $dossierPatient->date_enregsitrement }}</p>
</div> --}}

<div class="tab-content" id="custom-tabs-two-tabContent">
        <!-- /.col -->
        <br>
        @include('PoleSocial.dossier_patients.show_partials.Patient_Tuteurs')
    @include('PoleSocial.dossier_patients.show_partials.rendez_vous')
    @include('PoleSocial.dossier_patients.show_partials.liste_attente')
    @include('PoleSocial.dossier_patients.show_partials.inférmiere_medcine_général')
   {{-- @include('dossier_patients.show_partials.psychomotricite')
    @include('PoleSocial.dossier_patients.show_partials.Entretien_Social')
    @include('PoleSocial.dossier_patients.show_partials.kinésithérapeute')
    @include('PoleSocial.dossier_patients.show_partials.orthophoniste')
    @include('PoleSocial.dossier_patients.show_partials.orthoptiste')
    @include('PoleSocial.dossier_patients.show_partials.ergothérapie')
    @include('PoleSocial.dossier_patients.show_partials.inférmiere_dentiste')
    @include('PoleSocial.dossier_patients.show_partials.inférmiere_neurologe')
    @include('PoleSocial.dossier_patients.show_partials.orientations_exterieurs')
    @include('PoleSocial.dossier_patients.show_partials.réclamation') --}}

</div>