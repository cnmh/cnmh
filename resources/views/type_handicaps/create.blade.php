
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                {{-- <div class="col-sm-12">
                    <h1>
                    @lang('crud.create') @lang('models/typeHandicaps.singular')
                    </h1>
                </div> --}}
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid d-flex justify-content-center">
            <!-- Small boxes (Stat box) -->
            <div class="col-md-10 ">
                <!-- general form elements -->
                <div class="card card-primary card-create">
                    <div class="card-header">
                        {{-- <h3 class="card-title"> {{__('crud.addtypehandicap')}}</h3> --}}
                        @lang('crud.create') un nouveau  {{strtolower(__('models/typeHandicaps.singular'))}}
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {!! Form::open(['route' => 'typeHandicaps.store']) !!}

                        <div class="card-body">
                                @include('type_handicaps.fields')
                        </div>

                        <div class="card-footer">
                            <div class="d-flex bd-highlight mb-1">
                                <div class="p-2 bd-highlight">
                                    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}

                                </div>
                                <div class="ml-auto p-2 bd-highlight">
                                    <a href="{{ route('typeHandicaps.index') }}" class="btn btn-secondary"> @lang('crud.cancel') </a>
                                </div>

                            </div>
                        </div>
            
                        {!! Form::close() !!}
                </div>
                </form>
                <!-- /.card -->
            </div>
        </div>
    </section>
    {{-- <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'typeHandicaps.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('type_handicaps.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('typeHandicaps.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> --}}
{{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js" defer></script> --}}
       
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