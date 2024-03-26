@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        @lang('crud.details')
                        @if (app()->getLocale() == 'fr')
                           de la {{ strtolower(__('models/couvertureMedicals.singular')) }}
                        @else
                            {{ strtolower(__('models/couvertureMedicals.singular')) }}
                        @endif
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('couvertureMedicals.index') }}">
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
                    @include('couverture_medicals.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
