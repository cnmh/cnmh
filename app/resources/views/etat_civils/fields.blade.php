<!-- Nom Field -->
<div class="form-group col-md-12">
    {!! Form::label('nom', __('models/etatCivils.fields.nom').':') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-md-12">
    <label for="description" class="mb-2">{{ __('models/typeHandicaps.fields.description') }}:</label>
    {!! Form::textarea('description', old('description'), ['id' => 'description', 'class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>
