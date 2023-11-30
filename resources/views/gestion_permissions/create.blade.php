@can('create-Permission')
@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>@lang('crud.assign') @lang('models/permissions.singular') Pour {{$user->name}}</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">

       

        {!! Form::open(['route' => 'assign.role.permission']) !!}

        <div class="card-body">

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="user">@lang('crud.selectUser')</label>
                    <select name="user" id="user" class="form-control">
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="role">@lang('crud.selectRole')</label>
                    <select name="role" id="role" class="form-control">
                        @if($userRole->isEmpty())
                        <option value="">Select Role</option>
                        @else
                        @foreach($userRole as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                        @endif

                        @foreach($roles as $roleId => $roleName)
                        @if(!$userRole->contains('id', $roleId))
                        <option value="{{ $roleId }}">{{ $roleName }}</option>
                        @endif
                        @endforeach

                        <option value="">clear role</option>
                    </select>
                </div>

            </div>

            <div class="form-group col-md-12">
                <label for="permissions">@lang('crud.selectPermissions')</label>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle w-50" type="button" id="permissionsDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('crud.selectPermissions')
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="permissionsDropdown">
                        <div class="scrollable-dropdown centered-dropdown">
                            <button type="button" class="close close-dropdown" data-dismiss="dropdown"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="row">
                                @foreach($permissions as $permissionId => $permissionName)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" id="permission{{ $permissionId }}"
                                            value="{{ $permissionId }}" class="form-check-input"
                                            {{ in_array($permissionId, $userPermissions) ? 'checked' : '' }}>
                                        <label for="permission{{ $permissionId }}" class="form-check-label">
                                            {{ $permissionName }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           


        </div>

        <div class="card-footer">
            {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('fonctions.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection
@endcan