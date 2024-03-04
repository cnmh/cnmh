<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $user->email }}</p>
</div>

