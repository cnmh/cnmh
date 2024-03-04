@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        @lang('crud.edit') @lang('models/roles.singular')
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('roles.fields')
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    {!! Form::submit('Enregestrer', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary"> @lang('crud.cancel') </a>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
