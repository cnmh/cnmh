<!-- Patients Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('patient_id', __('models/reclamations.fields.patient_id').':') !!}
    {!! Form::number('patient_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Objet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('objet', __('models/reclamations.fields.objet').':') !!}
    {!! Form::text('objet', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reclamation', __('models/reclamations.fields.reclamation').':') !!}
    {!! Form::text('reclamation', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Remarques Field -->


<!-- Date Reclamation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_reclamation', __('models/reclamations.fields.date_reclamation').':') !!}
    {!! Form::text('date_reclamation', null, ['class' => 'form-control','id'=>'date_reclamation']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_reclamation').datepicker()
    </script>
@endpush