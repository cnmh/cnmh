<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/** 
 * Sprint 3
*/


class OrientationExterne extends Model
{
    use HasFactory;    public $table = 'orientation_externes';

    public $fillable = [
        'dossier_patient_id',
        'service_id',
        'objet',
        'description',
        'date_orientation'
    ];

    protected $casts = [
        'objet' => 'string',
        'description' => 'string',
        'date_orientation' => 'date'
    ];

    public static array $rules = [
        'dossier_patient_id' => 'required',
        'service_id' => 'required',
        'objet' => 'required|string|max:255',
        'description' => 'required|string|max:65535',
        'date_orientation' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function dossierPatient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\DossierPatient::class, 'dossier_patient_id');
    }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Service::class, 'service_id');
    }
}
