<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/couvertureMedicals.fields.nom').':') !!}
    <p>{{ $couvertureMedical->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/couvertureMedicals.fields.description').':') !!}
    <p>{{ $couvertureMedical->description }}</p>
</div>

