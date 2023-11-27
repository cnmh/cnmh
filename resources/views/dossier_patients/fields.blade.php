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
    {!! Form::label("type d'handycapé", __('models/dossierPatients.fields.type_handicap_id')) !!}
    {{ Form::select(
    'type_handicap_id',
    ['' => __('models/dossierPatients.fields.selecter.select_type_handicap_id')] + $type_handicap->pluck('nom', 'id')->toArray(),
    isset($type_handicap_patient->id) ? $type_handicap_patient->id : null,
    ['class' => 'form-control', 'required']
) }}

</div>

<!-- Couverture Medical Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fonction', __('models/dossierPatients.fields.couverture_medical_id')) !!}
    {{ Form::select(
        'couverture_medical_id',
        ['' => __('models/dossierPatients.fields.selecter.select_couverture_medical_id')] + $couverture_medical->pluck('nom', 'id')->toArray(),
        null,
        ['class' => 'form-control', 'required'],
    ) }}
</div>

<!-- Date Enregsitrement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_enregsitrement', __('models/dossierPatients.fields.date_enregsitrement')) !!}
    {!! Form::datetimeLocal('date_enregsitrement', null, ['class' => 'form-control','id'=>'date_enregsitrement']) !!}
</div>


<!-- Patient Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('patient_id', __('models/dossierPatients.fields.patient_id'), ['hidden']) !!}
    {!! Form::number('patient_id', $patientId, ['class' => 'form-control', 'required', 'hidden']) !!}
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