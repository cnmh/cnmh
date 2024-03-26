<!-- Patients Id Field -->
<div class="col-sm-12">
    {!! Form::label('patients_id', __('models/reclamations.fields.patients_id').':') !!}
    <p>{{ $reclamation->patients_id }}</p>
</div>

<!-- Objet Field -->
<div class="col-sm-12">
    {!! Form::label('objet', __('models/reclamations.fields.objet').':') !!}
    <p>{{ $reclamation->objet }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/reclamations.fields.description').':') !!}
    <p>{{ $reclamation->description }}</p>
</div>

<!-- Remarques Field -->
<div class="col-sm-12">
    {!! Form::label('remarques', __('models/reclamations.fields.remarques').':') !!}
    <p>{{ $reclamation->remarques }}</p>
</div>

<!-- Date Reclamation Field -->
<div class="col-sm-12">
    {!! Form::label('date_reclamation', __('models/reclamations.fields.date_reclamation').':') !!}
    <p>{{ $reclamation->date_reclamation }}</p>
</div>

