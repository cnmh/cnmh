<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/services.fields.name').':') !!}
    <p>{{ $service->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/services.fields.description').':') !!}
    <p>{!! $service->description !!}</p>
</div>


