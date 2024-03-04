<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/etatCivils.fields.nom').':') !!}
    <p>{{ $etatCivil->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/etatCivils.fields.description').':') !!}
    <p>{!! $etatCivil->description !!}</p>
</div>

