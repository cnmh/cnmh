@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>
                        @lang('crud.details')
                        @if (app()->getLocale() == 'fr')
                           de la {{ strtolower(__('models/consultations.singular')) }} {{ App\Models\Consultation\Consultation::OrientationType()}}
                        @else
                            {{ strtolower(__('models/consultations.singular')) }}
                        @endif
                    </h5>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('consultations.list',  App\Models\Consultation\Consultation::OrientationType()) }}">
                                                    @lang('crud.back')
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('Consultations.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
