<!-- Date Enregistrement Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::label('date_enregistrement', __('models/consultations.fields.date_enregistrement').':') !!}
    {!! Form::datetimeLocal('date_enregistrement',  now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control', 'id' => 'date_enregistrement']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_enregistrement').datepicker()
    </script>
@endpush

@if(\App\Models\Consultation\Consultation::OrientationType()==="Médecin-général")
<!-- TypeHandicap Field -->
<div class="form-group col-sm-6">
    {!! Form::label("type d'handycapé", __('models/dossierPatients.fields.type_handicap_id')) !!}
    
    {{ Form::select(
        'type_handicap_id[]',
        $type_handicap->pluck('nom', 'id')->toArray(),
        isset($type_handicap_patients) ? $type_handicap_patients->pluck('type_handicap_id')->toArray() : [],
        ['class' => 'form-control type_handicap_select', 'id'=> 'type_handicap_select', 'required', 'multiple' => 'multiple']
    ) }}
</div>

<!-- Services Field -->
<div class="form-group col-sm-6">
    {!! Form::label("Services", __('models/services.fields.service_id')) !!}
    <br>
    {{ Form::select(
        'services_id[]',
        $services->pluck('nom', 'id')->toArray(),
        isset($service_patient) ? $service_patient->pluck('service_id')->toArray() : [],
        ['class' => 'form-control services_select', 'id'=> 'services_select', 'required', 'multiple' => 'multiple']
    ) }}
</div>
@endif



<!-- Date Consultation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_consultation', __('models/consultations.fields.date_consultation').':') !!}
    {!! Form::datetimeLocal('date_consultation',  now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control','id'=>'date_consultation']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_consultation').datepicker()
    </script>
@endpush

<input type="hidden" name="consultation_id" value="{{ $dossierPatientConsultation->consultation_id }}">

<!-- Your 'observation' textarea -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observation', __('models/consultations.fields.observation').':') !!}
    {!! Form::textarea('observation', null, ['class' => 'form-control editorObservation', 'id' => 'observation', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Your 'diagnostic' textarea -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('diagnostic', __('models/consultations.fields.diagnostic').':') !!}
    {!! Form::textarea('diagnostic', null, ['class' => 'form-control editorDiagnostic', 'id' => 'diagnostic', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Your 'bilan' textarea -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('bilan', __('models/consultations.fields.bilan').':') !!}
    {!! Form::textarea('bilan', null, ['class' => 'form-control editorBilan', 'id' => 'bilan', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

@if(\App\Models\Consultation\Consultation::OrientationType() !== "Médecin-général")
    <div class="form-group col-12">
        <label>Nombre de séances</label>
        <input type="number" class="form-control" name="nombre_seance"
            id="nombre_seance" value="{{ $nombreSeance ?? '' }}"
            data-existing-seance-dates="{{ json_encode($existingSeanceDates ?? []) }}">
    </div>

    <div class="d-flex flex-wrap mt-3" id="seance_dates_container">
        @for ($i = 1; $i <= ($nombreSeance ?? 0); $i++)
            <div class="form-group col-md-6">
                <label>Date Séance {{ $i }}</label>
                <input type="date" class="form-control" name="date_seance{{ $i }}"
                    value="{{ $existingSeanceDates[$i - 1] ?? '' }}">
            </div>
        @endfor
    </div>
@endif



    {!! Form::hidden('dossier_patients',$dossierPatientConsultation->dossier_patient_id , ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}

