@extends('layouts.app')

<style>
    .md-stepper-horizontal {
    display: table;
    width: 100%;
    margin: 0 auto;
    background-color: #FFFFFF;
    box-shadow: 0 3px 8px -6px rgba(0, 0, 0, .50);
}

.md-stepper-horizontal .md-step {
    display: table-cell;
    position: relative;
    padding: 24px;
}

.md-stepper-horizontal .md-step:hover,
.md-stepper-horizontal .md-step:active {
    background-color: rgba(0, 0, 0, 0.04);
}

.md-stepper-horizontal .md-step:active {
    border-radius: 15% / 75%;
}

.md-stepper-horizontal .md-step:first-child:active {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.md-stepper-horizontal .md-step:last-child:active {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.md-stepper-horizontal .md-step:hover .md-step-circle {
    background-color: #757575;
}

.md-stepper-horizontal .md-step:first-child .md-step-bar-left,
.md-stepper-horizontal .md-step:last-child .md-step-bar-right {
    display: none;
}

.md-stepper-horizontal .md-step .md-step-circle {
    width: 30px;
    height: 30px;
    margin: 0 auto;
    background-color: #999999;
    border-radius: 50%;
    text-align: center;
    line-height: 30px;
    font-size: 16px;
    font-weight: 600;
    color: #FFFFFF;
}


.md-stepper-horizontal.orange .md-step.active .md-step-circle {
    background-color: #0275d8;
}


/* .md-stepper-horizontal .md-step.done .md-step-circle:before {

    font-weight: 100;
    content: "\f00c";
} */

.md-stepper-horizontal .md-step.done .md-step-circle *,
.md-stepper-horizontal .md-step.editable .md-step-circle * {
    display: block;
}

.md-stepper-horizontal .md-step.editable .md-step-circle {
    -moz-transform: scaleX(-1);
    -o-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
}

.md-stepper-horizontal .md-step.editable .md-step-circle:before {
    /* font-family:'FontAwesome'; */
    font-weight: 100;
    content: "\f040";
}

.md-stepper-horizontal .md-step .md-step-title {
    margin-top: 16px;
    font-size: 16px;
    font-weight: 600;
}

.md-stepper-horizontal .md-step .md-step-title,
.md-stepper-horizontal .md-step .md-step-optional {
    text-align: center;
    color: rgba(0, 0, 0, .26);
}

.md-stepper-horizontal .md-step.active .md-step-title {
    font-weight: 600;
    color: rgba(0, 0, 0, .87);
}

.md-stepper-horizontal .md-step.active.done .md-step-title,
.md-stepper-horizontal .md-step.active.editable .md-step-title {
    font-weight: 600;
}

.md-stepper-horizontal .md-step .md-step-optional {
    font-size: 12px;
}

.md-stepper-horizontal .md-step.active .md-step-optional {
    color: rgba(0, 0, 0, .54);
}

.md-stepper-horizontal .md-step .md-step-bar-left,
.md-stepper-horizontal .md-step .md-step-bar-right {
    position: absolute;
    top: 36px;
    height: 1px;
    border-top: 1px solid #DDDDDD;
}

.md-stepper-horizontal .md-step .md-step-bar-right {
    right: 0;
    left: 50%;
    margin-left: 20px;
}

.md-stepper-horizontal .md-step .md-step-bar-left {
    left: 0;
    right: 50%;
    margin-right: 20px;
}
</style>

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>
                    {{-- @lang('crud.create') @lang('models/rendezVouses.singular') --}}
                </h1>
            </div>
        </div>
    </div>
    <div class="md-stepper-horizontal orange">
        <div class="md-step done">
            <div class="md-step-circle"><span>1</span></div>
            <div class="md-step-title">Liste d'attente</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
        </div>
        <div class="md-step active done">
            <div class="md-step-circle"><span>2</span></div>
            <div class="md-step-title">RendezVous</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
        </div>

    </div>
</section>



<div class="content px-3">
   

    @include('adminlte-templates::common.errors')
    <div class="container-fluid ">
        <div class="d-flex justify-content-center">
            <div class="col-md-10  ">
                <div class="col-md-12  ">
                    <div class="card card-primary card-create ">
                        <div class="card-header">
                            <h3 class="card-title"> @lang('crud.create')
                                @if (app()->getLocale() == 'fr')
                                {{ is_male_localisation('models/rendezVouses.isMale') }}
                                @lang(strtolower(__('models/rendezVouses.singular')))
                                @else
                                @lang(strtolower(__('models/rendezVouses.singular')))
                                @endif

                            </h3>
                        </div>
                        <div class="card-body ">
                            {!! Form::open(['route' => 'rendez-vous.store', 'method' => 'post']) !!}

                            <div class="row">
                                @include('rendez_vouses.fields')
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex bd-highlight mb-3">
                                <div class="p-2 bd-highlight">
                                    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                                </div>
                                <div class="ml-auto p-2 bd-highlight">
                                    <a href="{{ route('rendez-vous.list_dossier') }}" class="btn btn-secondary">
                                        @lang('crud.cancel')
                                    </a>
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

            {!! Form::open(['route' => 'rendez-vous.store', 'method' => 'post']) !!}

            <div class="card-body">

                <div class="row">
                    @include('rendez_vouses.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('rendez-vous.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
</div>

{!! Form::close() !!}

</div> --}}
</div>
@endsection
@push('page_scripts')
<script>
$(document).ready(function() {
    $('#remarques').summernote({
        height: 100,
    });
    $('.dropdown-toggle').dropdown();
});
</script>
@endpush