@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            {{-- <div class="col-sm-12">
                <h1>
                    @lang('crud.edit') @lang('models/typeHandicaps.singular')
                </h1>
            </div> --}}
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-md-10 ">
            <div class="card card-primary card-create">
                <div class="card-header">
                    {{-- <h3 class="card-title"> {{__('crud.addtypehandicap')}}</h3> --}}
                    @lang('crud.updated_at') {{strtolower(__('models/typeHandicaps.singular'))}}
                </div>
                @include('adminlte-templates::common.errors')
                    {!! Form::model($typeHandicap, ['route' => ['typeHandicaps.update', $typeHandicap->id], 'method' =>
                    'patch']) !!}

                    <div class="card-body">
                            @include('type_handicaps.fields')
                    </div>

                    <div class="card-footer">
                        <div class="d-flex bd-highlight mb-1">
                            <div class="p-2 bd-highlight">
                                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}

                            </div>
                            <div class="ml-auto p-2 bd-highlight">
                                <a href="{{ route('typeHandicaps.index') }}" class="btn btn-secondary">
                                    @lang('crud.cancel') </a>
                            </div>

                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
@push('page_scripts')
<script>
    $(document).ready(function() {
  $('#description').summernote({
placeholder: '{{__("models/typeHandicaps.summerNote-placeholder")}}',
});
    $('.dropdown-toggle').dropdown();
}); 
</script>
@endpush