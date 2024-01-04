<!-- Date Enregistrement Field -->
<div class="col-sm-12">
    {!! Form::label('date_enregistrement', __('models/consultations.fields.date_enregistrement').':') !!}
    <p>{{ $consultation->date_enregistrement }}</p>
</div>

<!-- Date Consultation Field -->
<div class="col-sm-12">
    {!! Form::label('date_consultation', __('models/consultations.fields.date_consultation').':') !!}
    <p>{{ $consultation->date_consultation }}</p>
</div>

<!-- Service Consultation Field -->
<div class="col-sm-12">
    {!! Form::label('Services', 'Services:') !!}
    @if(!empty($consultation_service_patient))
        <ol>
            @foreach($consultation_service_patient as $service_patient_consultation)
            <li>{{ $service_patient_consultation->nom }}</li>
            @endforeach
        </ol>
    @endif

</div>

<!-- Ttye_handicap Consultation Field -->
<div class="col-sm-12">
    {!! Form::label('TypeHandicap', "Types de handicap:") !!}
    @if(!empty($consultation_handicap_patient))
        <ol>
            @foreach($consultation_handicap_patient as $consultation_handicap)
                <li>{{ $consultation_handicap->nom }}</li>
            @endforeach
        </ol>
    @endif

</div>



<!-- Observation Field -->
<div class="col-sm-12">
    {!! Form::label('observation', __('models/consultations.fields.observation').':') !!}
    <p>{!! $consultation->observation !!}</p>
</div>

<!-- Diagnostic Field -->
<div class="col-sm-12">
    {!! Form::label('diagnostic', __('models/consultations.fields.diagnostic').':') !!}
    <p>{!! $consultation->diagnostic !!}</p>
</div>

<!-- Bilan Field -->
<div class="col-sm-12">
    {!! Form::label('bilan', __('models/consultations.fields.bilan').':') !!}
    <p>{!! $consultation->bilan !!}</p>
</div>

