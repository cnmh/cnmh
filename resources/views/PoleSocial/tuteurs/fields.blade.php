

<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Nom', __('models/tuteurs.fields.nom') . ':') !!}<span class="required-field">*</span></label>
    {!! Form::text('nom', old('nom'), [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        ]) !!}
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Prénom', __('models/tuteurs.fields.prenom') . ':') !!}<span class="required-field">*</span></label>
    {!! Form::text('prenom', old('prenom'), [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
        ]) !!}
</div>

<!-- Sexe Field -->
@php
    $sexe = ['homme', 'femme'];
@endphp

<div class="form-group col-sm-6">
    {!! Form::label('Sexe', __('models/tuteurs.fields.sexe') . ':') !!}<span class="required-field">*</span></label>
    {!! Form::select('sexe', array_combine($sexe, $sexe), old('sexe'), ['class' => 'form-control', 'required']) !!}
</div>


@if (request()->getRequestUri() == '/tuteurs/create?=parentForm')
<input type="hidden" name="parentForm" value="parentForm">
@endif

<!-- Etat Civil Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('etat_civil_id', __('models/tuteurs.fields.etat_civil_id') . ':') !!}<span class="required-field">*</span></label>
    {{ Form::select(
        'etat_civil_id',
        ['' => "-- Sélectionner l'état civil  --"] + ($etat_civil ? $etat_civil->pluck('nom', 'id')->toArray() : []),
        old('etat_civil_id'),
        ['class' => 'form-control', 'required'],
    ) }}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('téléphone', __('models/tuteurs.fields.telephone') . ':') !!}<span class="required-field">*</span></label>
    {!! Form::text('telephone', old('telephone'), [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Email', __('models/tuteurs.fields.email') . ':') !!}
    {!! Form::email('email', old('email'), [
        'class' => 'form-control',
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Adresse Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Adresse', __('models/tuteurs.fields.adresse') . ':') !!}<span class="required-field">*</span></label>
    {!! Form::text('adresse', old('adresse'), [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Cin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CIN', __('models/tuteurs.fields.cin') . ':') !!}<span class="required-field">*</span></label>
    {!! Form::text('cin', old('cin'), [
        'class' => 'form-control',
        'required',
        'maxlength' => 255,
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Remarques Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('remarques', __('models/tuteurs.fields.remarques') . ':') !!}
    {!! Form::textarea('remarques', old('remarques'), [
        'class' => 'form-control',
        'id' => 'remarques', // Add the 'id' attribute
        'maxlength' => 65535,
        'maxlength' => 65535,
    ]) !!}
</div>

<div>
    
</div>