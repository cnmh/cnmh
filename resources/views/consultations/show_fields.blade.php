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
    {!! Form::label('Services', 'Services') !!}
    <ol>
        @foreach($consultation_service_patient as $service_patient)
          <li>{{ $service_patient->nom }}</li>
        @endforeach
    </ol>
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

