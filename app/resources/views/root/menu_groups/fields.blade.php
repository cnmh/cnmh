<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom', __('models/menuGroups.fields.nom').':') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/menuGroups.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', __('models/menuGroups.fields.icon').':') !!}
    {!! Form::text('icon', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>