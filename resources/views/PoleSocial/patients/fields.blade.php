<!-- Nom Field -->
<div class="form-group col-sm-6">
    <label for="nom">{!! __('models/patients.fields.nom') !!} <span class="required-field">*</span></label>
    {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-6">
    <label for="prenom">{!! __('models/patients.fields.prenom') !!} <span class="required-field">*</span></label>
    {!! Form::text('prenom', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Parent Id Field -->

<input type="hidden" name="tuteur_id" value="{{ $tuteur->id }}">


<!-- Niveau Scolaire Id Field -->
<div class="form-group col-sm-6">
    <label for="niveau_scolaire_id">{!! __('models/patients.fields.niveau_scolaire_id') !!} <span class="required-field">*</span></label>
    {{ Form::select(
        'niveau_scolaire_id',
        ['' => '-- Sélectionner le niveau scolaire --'] + $niveau_s->pluck('nom', 'id')->toArray(),
        old('niveau_scolaire_id'),
        ['class' => 'form-control', 'required'],
    ) }}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telephone', __('models/patients.fields.telephone')) !!}
    {!! Form::text('telephone', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Cin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cin', __('models/patients.fields.cin')) !!}
    {!! Form::text('cin', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/patients.fields.email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/patients.fields.image')) !!}
    {!! Form::file('image', ['class' => 'form-control']) !!}
</div>

<!-- Adresse Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adresse', __('models/patients.fields.adresse')) !!}
    {!! Form::text('adresse', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- data de naissance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Date de naissance', __('models/patients.fields.dataNaissance')) !!} <span class="required-field">*</span>
    {!! Form::date('date_naissance', null, [
        'id' => 'date_naissance_input',
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'required',
    ]) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('Age', __('models/patients.fields.age')) !!}
    {!! Form::text('age', null, [
        'id' => 'age',
        'class' => 'form-control',
        'maxlength' => 65535,
        'maxlength' => 65535,
        'readonly',
    ]) !!}
</div>


<!-- Sexe Field -->
@php
    $sexe = ['Homme', 'Femme'];
@endphp

<div class="form-group col-sm-12">
    {!! Form::label('Sexe', __('models/tuteurs.fields.sexe') . ':') !!} <span class="required-field">*</span>
    {!! Form::select('sexe', array_combine($sexe, $sexe), old('sexe'), ['class' => 'form-control', 'required']) !!}
</div>


<!-- Remarques Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('remarques', __('models/patients.fields.remarques')) !!}
    {!! Form::textarea('remarques', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>
