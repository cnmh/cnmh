<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\consultation;

class DossierPatientConsultation extends Model
{
    use HasFactory;
     public $table = 'dossier_patient_consultation';

    public $fillable = [
        'dossier_patient_id',
        'consultation_id',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

}
