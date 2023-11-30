@extends('layouts.app')
@section('content')
@can('create-EtatCivilController')
    <section class="content-header">
        {{-- <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    @lang('crud.create') @lang('models/etatCivils.singular')
                    </h1>
                </div>
            </div>
        </div>  --}}
    </section>

    <section class="content px-3">
        @include('adminlte-templates::common.errors')
        <div class="container-fluid d-flex justify-content-center">

            <div class="col-md-10">
                <div class="card card-primary card-create">
                    <div class="card-header">
                        <h3 class="card-title">@lang('crud.create')
                            {{-- une nouvelle --}}
                            @if (app()->getLocale() == 'fr')
                                {{ is_male_localisation('message.isMale') }} 
                                @lang(strtolower(__('models/etatCivils.singular')))
                            @else
                                {{ strtolower(__('models/etatCivils.singular')) }}
                            @endif
                        </h3>
                    </div>
                    {!! Form::open(['route' => 'etatCivils.store']) !!}
                    <div class="card-body">
                        <div class="row">
                            @include('etat_civils.fields')
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex bd-highlight mb-1">
                            <div class="p-2 bd-highlight">
                                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}

                            </div>
                            <div class="ml-auto p-2 bd-highlight">
                                <a href="{{ route('etatCivils.index') }}" class="btn btn-secondary"> @lang('crud.cancel') </a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </section>
@endsection
@endcan
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
