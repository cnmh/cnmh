<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', __('models/patients.fields.parent_id').':') !!}
    <p>{{ $patient->parent_id }}</p>
</div>

<!-- Niveau Scolaire Id Field -->
<div class="col-sm-12">
    {!! Form::label('niveau_scolaire_id', __('models/patients.fields.niveau_scolaire_id').':') !!}
    <p>{{ $patient->niveau_scolaire_id }}</p>
</div>

<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/patients.fields.nom').':') !!}
    <p>{{ $patient->nom }}</p>
</div>

<!-- Prenom Field -->
<div class="col-sm-12">
    {!! Form::label('prenom', __('models/patients.fields.prenom').':') !!}
    <p>{{ $patient->prenom }}</p>
</div>

<!-- Telephone Field -->
<div class="col-sm-12">
    {!! Form::label('telephone', __('models/patients.fields.telephone').':') !!}
    <p>{{ $patient->telephone }}</p>
</div>

<!-- Cin Field -->
<div class="col-sm-12">
    {!! Form::label('cin', __('models/patients.fields.cin').':') !!}
    <p>{{ $patient->cin }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/patients.fields.email').':') !!}
    <p>{{ $patient->email }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/patients.fields.image').':') !!}
    <p>{{ $patient->image }}</p>
</div>

<!-- Adresse Field -->
<div class="col-sm-12">
    {!! Form::label('adresse', __('models/patients.fields.adresse').':') !!}
    <p>{{ $patient->adresse }}</p>
</div>

<!-- Remarques Field -->
<div class="col-sm-12">
    {!! Form::label('remarques', __('models/patients.fields.remarques').':') !!}
    <p>{{ $patient->remarques }}</p>
</div>

