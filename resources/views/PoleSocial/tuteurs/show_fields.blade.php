<!-- Etat Civil Id Field -->
<div class="col-sm-12">
    {!! Form::label('etat_civil_id', __('models/tuteurs.fields.etat_civil_id').':') !!}
    <p>{{ $tuteur->etat_civil_id }}</p>
</div>

<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', __('models/tuteurs.fields.nom').':') !!}
    <p>{{ $tuteur->nom }}</p>
</div>

<!-- Prenom Field -->
<div class="col-sm-12">
    {!! Form::label('prenom', __('models/tuteurs.fields.prenom').':') !!}
    <p>{{ $tuteur->prenom }}</p>
</div>

<!-- Sexe Field -->
<div class="col-sm-12">
    {!! Form::label('sexe', __('models/tuteurs.fields.sexe').':') !!}
    <p>{{ $tuteur->sexe }}</p>
</div>

<!-- Telephone Field -->
<div class="col-sm-12">
    {!! Form::label('telephone', __('models/tuteurs.fields.telephone').':') !!}
    <p>{{ $tuteur->telephone }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/tuteurs.fields.email').':') !!}
    <p>{{ $tuteur->email }}</p>
</div>

<!-- Adresse Field -->
<div class="col-sm-12">
    {!! Form::label('adresse', __('models/tuteurs.fields.adresse').':') !!}
    <p>{{ $tuteur->adresse }}</p>
</div>

<!-- Cin Field -->
<div class="col-sm-12">
    {!! Form::label('cin', __('models/tuteurs.fields.cin').':') !!}
    <p>{{ $tuteur->cin }}</p>
</div>

<!-- Remarques Field -->
<div class="col-sm-12">
    {!! Form::label('remarques', __('models/tuteurs.fields.remarques').':') !!}
    <p>{{ $tuteur->remarques }}</p>
</div>

