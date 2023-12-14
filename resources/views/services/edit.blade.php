@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">

            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')
    <div class="d-flex justify-content-center">
        <div class="col-md-10  ">
            <div class="col-md-12  ">
                <div class="card card-primary card-create">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('crud.edit')
                            @if (app()->getLocale() == 'fr')
                            {{ is_male_localisation('models/services.isMale') }}
                            @lang(strtolower(__('models/services.singular')))
                            @else
                            @lang(strtolower(__('models/services.singular')))
                            @endif
                        </h3>
                    </div>
                    {!! Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'patch']) !!}

                    <div class="card-body">
                        @include('services.fields')
                    </div>


                    <div class="card-footer">
                        <div class="d-flex bd-highlight mb-3">
                            <div class="p-2 bd-highlight">
                                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                            </div>
                            <div class="ml-auto p-2 bd-highlight">
                                <a href="{{ route('services.index') }}" class="btn btn-secondary"> @lang('crud.cancel')
                                </a>
                            </div>

                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        @endsection
        @push('page_scripts')
        <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 100,
            });
            $('.dropdown-toggle').dropdown();
        });
        </script>
        @endpush