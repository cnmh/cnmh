<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/menuGroups.fields.nom').':') !!}
    <p>{{ $menuGroup->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/menuGroups.fields.description').':') !!}
    <p>{{ $menuGroup->description }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', __('models/menuGroups.fields.icon').':') !!}
    <p>{{ $menuGroup->icon }}</p>
</div>

