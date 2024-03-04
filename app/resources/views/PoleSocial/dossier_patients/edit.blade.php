@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        @lang('crud.edit') @lang('models/dossierPatients.singular')
                    </h1>
                    <div class="mt-5">
                        @include('flash::message')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($dossierPatient, ['route' => ['dossier-patients.modifier', $dossierPatient->numero_dossier], 'method' => 'put']) !!}

            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
                    @include('PoleSocial.dossier_patients.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('dossier-patients.list') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
