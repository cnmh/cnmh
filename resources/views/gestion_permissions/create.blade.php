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
                    <input type="hidden" name="userId" id="userId" value="{{$user->id}}">
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

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="user">@lang('crud.selectPermissions')</label>
                    <select name="permission" id="permissionName" class="form-control">
                        <option value="Selectionez une permission">@lang('crud.selectPermissions')</option>
                        @foreach($permissionsList as $permissionName)
                        <option value="{{ $permissionName }}">{{ $permissionName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                <label for="permissions">@lang('crud.selectActions')</label>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle w-100" type="button" id="permissionsDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('crud.selectPermissions')
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="permissionsDropdown">
                        <div class="scrollable-dropdown centered-dropdown">
                            <button type="button" class="close close-dropdown" data-dismiss="dropdown"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="row" id='actions'>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>


        </div>

        <div class="content px-3">

    <div class="card">
     
        <div class="card-body">
        <label for="user">@lang('crud.selectPermissions')</label>
            <div class="row" id="selectedPermissions">

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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        
        var permissionsArr = [];
        var permissionsHtml = '';
        function displaySelectedPermissions() {
            var userId = $('#userId').val();
            $.ajax({
                url: '{{ route("get.role.permission", ["id" => ":userId"]) }}'.replace(':userId', userId),
                data: { userId: userId },
                type: 'GET',
                success: function(data) {

                    Object.values(data).forEach(function(permissionObject) {
                       
                        var permission = Object.values(permissionObject)[0]; 
                        permissionsArr.push(permission);
                        var minWidth = permission.length * 10 + 50 ; 
                        permissionsHtml += `
                        <div class="input-group bg-light  p-2 m-1" style="width: ${minWidth}px;" >
                <input type="text" class="form-control" name='assignedPrmissions[]' value="${permission}" readonly>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" id="cancel">X</button>
                </div>
            </div>
                       
                        `;
                    });
                    $('#selectedPermissions').html(permissionsHtml); 
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#selectedPermissions').on('click', '#cancel', function() {
        var $permissionDiv = $(this).closest('.input-group');
        var index = $permissionDiv.index();
        console.log(index);
        permissionsArr.splice(index, 1);
        $permissionDiv.remove();
    });
      
        $('#actions').on('change', 'input[name="actionsName[]"]', function() {
      if ($(this).is(':checked')) {
        var permissionValue = $('#permissionName').val();
        var actionValue = $(this).val();
        var permission = actionValue + '-' + permissionValue;
        permissionsArr.push(permission);
       
            var minWidth = permission.length * 10 + 50 ; 
            permissionsHtml = `
            <div class="input-group bg-light  p-2 m-1" style="width: ${minWidth}px;" >
                <input type="text" class="form-control" name='assignedPrmissions[]' value="${permission}" readonly>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" id="cancel">X</button>
                </div>
            </div>
                       
            `;
        
        $('#selectedPermissions').append(permissionsHtml);
        console.log(permissionsArr);
       
      }
    });

        
        displaySelectedPermissions();
    });
</script>



<script>
  $(document).ready(function () {
    function fetchData(permissionValue, userId) {
      $.ajax({
        url: '{{ route("get.permissions.action") }}',
        data: { permissionValue: permissionValue },
        type: 'GET',
        success: function (data) {
          $('#actions').empty();
          $.each(data, function (index, permission) {
            var checkboxHtml = '<div class="col-md-4">' +
              '<div class="form-check">' +
              '<input type="checkbox" name="actionsName[]" id="actionsName' + index +
              '" value="' + permission + '" class="form-check-input">' +
              '<label for="permission_' + index +
              '" class="form-check-label">' + permission + '</label>' +
              '</div></div>';
            $('#actions').append(checkboxHtml);
          });
          
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }

    $('#permissionName').on('change', function () {
      var permissionValue = $(this).val();
      var userId = $('#userId').val();
      fetchData(permissionValue, userId);
    });
    

  });
</script>







@endsection
@endcan