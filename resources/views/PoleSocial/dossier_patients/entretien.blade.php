@extends('layouts.app')

@section('content')
    <section class="content-header">


        <div class="container-fluid">

        </div>
    </section>


    <section class="content">
        <div class="container-fluid ">
            @include('flash::message')

            <div class="clearfix"></div>

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@lang('models/dossierPatients.plural')</h1>
                        </div>
                        
                    </div>
                </div>
            </section>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        @include('PoleSocial.dossier_patients.stepper')
                        <div class="card-header">
                          @include('flash::message')
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="card">
                                    {!! Form::open(['route' => ['AjouterEntretienSocial', $PatientID], 'method' => 'POST']) !!}
                                    <!-- Specify the route and method for the form -->

                                    <div class="card-body">
                                        <div class="row">
                                            @include('PoleSocial.dossier_patients.fields')
                                        </div>
                                    </div>


                                    
                                    <div class="card-footer">
                                        <a href=""
                                            class="btn btn-primary">@lang('crud.previous')</a>
                                        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                                        {{-- <a href="{{ route('dossier-patients.index') }}" class="btn btn-default">
                                            @lang('crud.cancel') </a> --}}
                                    </div>

                                    {!! Form::close() !!}
                                </div>


                            </div>

                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->

                    </div>
                </div>
                <!-- /.card -->




    </section>
@endsection
