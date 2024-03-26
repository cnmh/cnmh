<!-- Dossier Patient Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dossier_patient_id', __('models/orientationExternes.fields.dossier_patient_id').':') !!}
    {!! Form::number('dossier_patient_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', __('models/orientationExternes.fields.service_id').':') !!}
    {!! Form::number('service_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Objet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('objet', __('models/orientationExternes.fields.objet').':') !!}
    {!! Form::text('objet', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/orientationExternes.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Date Orientation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_orientation', __('models/orientationExternes.fields.date_orientation').':') !!}
    {!! Form::text('date_orientation', null, ['class' => 'form-control','id'=>'date_orientation']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_orientation').datepicker()
    </script>
@endpush