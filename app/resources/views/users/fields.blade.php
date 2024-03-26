<!-- Name Field -->
<div class="form-group w-100">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group w-100">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

@if(empty($user)) 
    <!-- password Field -->
    <div class="form-group w-100">
        {!! Form::label('password', __('models/users.fields.password').':') !!}
        {!! Form::password('password', ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>
@endif
