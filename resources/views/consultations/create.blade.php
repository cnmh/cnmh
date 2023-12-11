@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>
                    {{-- @lang('crud.create') @lang('models/consultations.singular') {{$title}} --}}
                </h1>
            </div>
        </div>
    </div>
    <div class="steps">
        <div class="md-stepper-horizontal orange">
            <div class="md-step  done">
                <div class="md-step-circle"><span>1</span></div>
                <div class="md-step-title">Rendez-Vous</div>
                <div class="md-step-bar-left"></div>
                <div class="md-step-bar-right"></div>
            </div>
            <div class="md-step done">
                <div class="md-step-circle"><span>2</span></div>
                <div class="md-step-title">Patient</div>
                <div class="md-step-bar-left"></div>
                <div class="md-step-bar-right"></div>
            </div>
            <div class="md-step active done">
                <div class="md-step-circle"><span>3</span></div>
                <div class="md-step-title">Consultation</div>
                <div class="md-step-bar-left"></div>
                <div class="md-step-bar-right"></div>
            </div>

        </div>
    </div>


</section>



<div class="content px-3 mb-0">

    @include('adminlte-templates::common.errors')

    <div class="container-fluid ">
        <div class="d-flex justify-content-center">
            <div class="col-md-10">
                <div class="col-md-12">
                    <div class="card card-primary card-create ">
                        <div class="card-header">
                            <h3 class="card-title"> @lang('models/rendezVouses.schedule')
                                @if (app()->getLocale() == 'fr')
                                {{ is_male_localisation('models/rendezVouses.isMale') }}
                                @lang(strtolower(__('models/rendezVouses.singular')))
                                @else
                                @lang(strtolower(__('models/rendezVouses.singular')))
                                @endif

                            </h3>
                        </div>
                        <div class="card-body ">
                            {!! Form::open(['route' => ['consultations.store',$title]]) !!}

                            <div class="row">
                                @include('consultations.fields')
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex bd-highlight mb-3">
                                <div class="p-2 bd-highlight">
                                    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                                </div>
                                <div class="ml-auto p-2 bd-highlight">
                                    {{-- <a href="{{ route('consultations.patient', request()->model)) }}" class="btn
                                    btn-secondary"> @lang('crud.cancel') --}}
                                    </a>
                                    <a href="{{ route('consultations.patient', request()->model) }}?dossier_patients={{request()->dossier_patients}} "
                                        class="btn btn-secondary">@lang('crud.cancel')</a>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    {{-- <div class="card">

            {!! Form::open(['route' => ['consultations.store',$title]]) !!}

            <div class="card-body">

                <div class="row">
                    @include('consultations.fields')
                </div>

            </div>

            <div class="card-footer">
                <a href="{{ route('consultations.patient', request()->model) }}?dossier_patients={{request()->dossier_patients}}
    "
    class="btn btn-primary">@lang('crud.Previous')</a>
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

</div> --}}
</div>
@endsection

@push('page_scripts')
<script>
$(document).ready(function() {
    $('#observation').summernote({
        height: 100,
    });
    $('.dropdown-toggle').dropdown();
});
$(document).ready(function() {
    $('#diagnostic').summernote({
        height: 100,
    });
    $('.dropdown-toggle').dropdown();
});
$(document).ready(function() {
    $('#bilan').summernote({
        height: 100,
    });
    $('.dropdown-toggle').dropdown();
});
</script>
@endpush