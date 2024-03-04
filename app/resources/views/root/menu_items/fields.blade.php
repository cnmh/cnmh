<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom', __('models/menuItems.fields.nom').':') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/menuItems.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', __('models/menuItems.fields.icon').':') !!}
    {!! Form::text('icon', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', __('models/menuItems.fields.url').':') !!}
    {!! Form::text('url', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Reference Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reference', __('models/menuItems.fields.reference').':') !!}
    {!! Form::text('reference', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Visible Field -->
<div class="form-group col-sm-6">
    {!! Form::label('visible', __('models/menuItems.fields.visible').':') !!}
    {!! Form::select('visible', ['No', 'Yes'], [$menuItem->visible ?? 1], ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Menu Group Id Field -->
{{-- @dd($menuGroups->pluck('nom', 'id')) --}}

<div class="form-group col-sm-6">
    {!! Form::label('menu_group_id', __('models/menuItems.fields.menu_group_id').':') !!}
    {!! Form::select(
        'menu_group_id',
        $menuGroups->pluck('nom', 'id'), (isset($menuItem) ? $menuItem->menu_group_id : null),
        ['class' => 'form-control']
        ) !!}
</div>
