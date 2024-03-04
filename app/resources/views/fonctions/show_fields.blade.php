<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/fonctions.fields.nom').':') !!}
    <p>{{ $fonction->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/fonctions.fields.description').':') !!}
    <p>{{ $fonction->description }}</p>
</div>

