<?php
$url = parse_url($_SERVER['REQUEST_URI']);
$explodePath = explode('/', $url['path']);
$parentId = $explodePath[count($explodePath) - 2];  
$patientId = null;
if (isset($url['query'])) {
    $explodeQuery = explode('=', $url['query']);
    $patientId = $explodeQuery[1];
}
?>


<!-- Numero Dossier Field -->
{!! Form::text('numero_dossier', null, ['class' => 'form-control','hidden']) !!}

<!-- Fonction Field -->
<div class="form-group col-sm-6">
    {!! Form::label("type de handycape", __('models/dossierPatients.fields.type_handicap_id')) !!}

    {{ Form::select(
        'type_handicap_id[]',
        $type_handicap->pluck('nom', 'id')->toArray(),
        isset($type_handicap_patient) ? $type_handicap_patient->pluck('id')->toArray() : [],
        ['class' => 'form-control', 'id'=> 'type_handicap_select' ,'required', 'multiple' => 'multiple']
    ) }}
</div>

<!-- Service field -->

<div class="form-group col-sm-6">
    {!! Form::label("Services", __('models/services.fields.service_dm')) !!}
    <br>

    {{ Form::select(
        'services_id[]',
        $services->pluck('nom', 'id')->toArray(),
        isset($service_patient) ? $service_patient : [],
        ['class' => 'form-control', 'id'=> 'services_select', 'required', 'multiple' => 'multiple']
    ) }}
</div>

@if($editMode)

<!-- Tuteur field -->

<div class="form-group col-sm-6">
    {!! Form::label("Tuteur", __('Tuteur')) !!}
    <br>
    <div class="d-flex">
    {{ Form::select(
        'tuteur_id',
        [$tuteur->id => $tuteur->nom . ' ' . $tuteur->prenom],
        null,
        ['class' => 'form-control', 'id'=> 'tuteur_select']
    ) }}
       <a href="/tuteurs/{{$tuteur->id}}/edit" class="btn btn-primary ml-2">Edit</a>
    </div>
</div>


<!-- Patient field -->
<div class="form-group col-sm-6">
    <label for="beneficiaire_select">Bénéficiaire</label>
    <div class="d-flex">
        <select name="patient_id" id="" class="form-control" id="beneficiaire_select">
            @foreach($patients_tuteur as $patient_itemt)
            <option value="{{ $patient_itemt->id }}">{{ $patient_itemt->nom }} {{ $patient_itemt->prenom }}</option>
            @endforeach
        </select>
        <a href="/patients/{{$patients_tuteur[0]->id}}/edit" class="btn btn-primary ml-2" id="editLink">Edit</a>
    </div>
</div>


@endif

<!-- Couverture Medical Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('fonction', __('models/dossierPatients.fields.couverture_medical_id')) !!}
    {{ Form::select(
        'couverture_medical_id',
        ['' => __('models/dossierPatients.fields.selecter.select_couverture_medical_id')] + $couverture_medical->pluck('nom', 'id')->toArray(),
        null,
        ['class' => 'form-control', 'required'],
    ) }}
</div>

<!-- Remarque fields -->
<div class="form-group col-sm-12">
    {!! Form::label('remarques', 'Remarque') !!}
    {!! Form::textarea('romarque', null, ['class' => 'form-control', 'id' => 'remarques']) !!}
</div>



<!-- Date Enregsitrement Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::label('date_enregsitrement', __('models/dossierPatients.fields.date_enregsitrement')) !!}
    {!! Form::datetimeLocal('date_enregsitrement', now()->format('Y-m-d\TH:i:s'), ['class' =>
    'form-control','id'=>'date_enregsitrement']) !!}
</div>


<!-- Etat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('etat', __('models/dossierPatients.fields.etat'), ['hidden']) !!}
    {!! Form::text('etat', 'entretien social', ['class' => 'form-control', 'required', 'maxlength' => 255, 'hidden'])
    !!}
</div>

@push('page_scripts')
<script type="text/javascript">
$('#date_enregsitrement').datepicker()
</script>
@endpush