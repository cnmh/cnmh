<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/niveauScolaires.fields.nom').':') !!}
    <p>{{ $niveauScolaire->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/niveauScolaires.fields.description').':') !!}
    <p>{{ $niveauScolaire->description }}</p>
</div>

