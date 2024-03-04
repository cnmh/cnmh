<!-- Dossier Patient Id Field -->
<div class="col-sm-12">
    {!! Form::label('dossier_patient_id', __('models/orientationExternes.fields.dossier_patient_id').':') !!}
    <p>{{ $orientationExterne->dossier_patient_id }}</p>
</div>

<!-- Service Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_id', __('models/orientationExternes.fields.service_id').':') !!}
    <p>{{ $orientationExterne->service_id }}</p>
</div>

<!-- Objet Field -->
<div class="col-sm-12">
    {!! Form::label('objet', __('models/orientationExternes.fields.objet').':') !!}
    <p>{{ $orientationExterne->objet }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/orientationExternes.fields.description').':') !!}
    <p>{{ $orientationExterne->description }}</p>
</div>

<!-- Date Orientation Field -->
<div class="col-sm-12">
    {!! Form::label('date_orientation', __('models/orientationExternes.fields.date_orientation').':') !!}
    <p>{{ $orientationExterne->date_orientation }}</p>
</div>

