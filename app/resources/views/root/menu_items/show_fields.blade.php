<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/menuItems.fields.nom').':') !!}
    <p>{{ $menuItem->nom }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/menuItems.fields.description').':') !!}
    <p>{{ $menuItem->description }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', __('models/menuItems.fields.icon').':') !!}
    <p>{{ $menuItem->icon }}</p>
</div>

<!-- Url Field -->
<div class="col-sm-12">
    {!! Form::label('url', __('models/menuItems.fields.url').':') !!}
    <p>{{ $menuItem->url }}</p>
</div>

<!-- Visible For Field -->
<div class="col-sm-12">
    {!! Form::label('visible_for', __('models/menuItems.fields.visible_for').':') !!}
    <p>{{ $menuItem->visible_for }}</p>
</div>

<!-- Menu Group Id Field -->
<div class="col-sm-12">
    {!! Form::label('menu_group_id', __('models/menuItems.fields.menu_group_id').':') !!}
    <p>{{ $menuItem->menu_group_id }}</p>
</div>

