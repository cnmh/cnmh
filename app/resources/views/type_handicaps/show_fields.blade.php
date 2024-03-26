<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/typeHandicaps.fields.nom').':') !!}
    <p>{{ $typeHandicap->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/typeHandicaps.fields.description').':') !!}
    <p>{!! $typeHandicap->description !!}</p>
</div>

