<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class Consultation extends Model
{
    use HasFactory;    public $table = 'consultations';

    public $fillable = [
        'date_enregistrement',
        'date_consultation',
        'observation',
        'diagnostic',
        'type',
        'bilan',
        "etat"
    ];

    protected $casts = [
        'date_enregistrement' => 'datetime',
        'date_consultation' => 'datetime',
        'observation' => 'string',
        'diagnostic' => 'string',
        'bilan' => 'string',
        'type' => 'string'
        
    ];

    public static array $rules = [
        'date_enregistrement' => 'required',
        'date_consultation' => 'required',
        'observation' => 'nullable|string|max:65535',
        'type' => 'nullable|string|max:65535',
        'diagnostic' => 'nullable|string|max:65535',
        'bilan' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function consultationServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->BelongsToMany(\App\Models\Service::class, 'consultation_service');
    }

    public function dossierPatientConsultations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\DossierPatient::class, 'dossier_patient_consultation');
    }

    public function rendezVous(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RendezVou::class, 'id_consultation');
    }

    public function typeHandicapConsultations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\TypeHandicapConsultation::class, 'consultation_id');
    }

    public function setTypeAttribute($value)
    {
        if ($value == 'dentiste') {
            $this->attributes['type'] = 'dentiste';
        } elseif ($value == 'medecinGeneral') {
            $this->attributes['type'] = 'medecinGeneral';
        } else {
            $this->attributes['type'] = null;
        }
    }

    public function dentiste(){
        $this::where('type','dentiste');
    }
}
