<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;


class Service extends Model
{
    use HasFactory;    public $table = 'services';

    public $fillable = [
        'nom',
        'description'
    ];

    protected $casts = [
        'nom' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function dossierPatientServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\DossierPatient::class, 'dossier_patient_service');
    }
    public function consultationServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->BelongsToMany(\App\Models\Consultation::class, 'consultation_service');
    }

}
