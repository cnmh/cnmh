<!-- Nom Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nom', __('models/services.fields.name').':') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', __('models/services.fields.description').':') !!}
    {!! Form::textarea('description', old('description'), ['class' => 'form-control w-100', 'required', 'maxlength' => 255]) !!}
</div>
