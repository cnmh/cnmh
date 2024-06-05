<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\MorphType; 

class Consultation extends Model
{
    use HasFactory,MorphType;   
    public $table = 'consultations';

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

  

    public static function OrientationType()
    {
        $userEmail = Auth()->user()->email;

        $type = [
            'medecin@gmail.com' => 'Médecin-général',
            'dentiste@gmail.com' => 'Dentiste',
            'orthophoniste@gmail.com' => 'Orthophoniste',
            'orthoptiste@gmail.com' => 'Orthoptiste',
            'psychomotricien@gmail.com' => 'Psychomotricien',
            'kinesitherapeute@gmail.com' => 'Kinesitherapeute',
            'social@gmail.com' => 'Médecin-général'
        ];
        return $type[$userEmail] ?? null;
    }


    public static function SocialType(){
        $user = Auth()->user()->email;
        if($user === 'social@gmail.com'){
            return $type = "Liste-d'attente";
        }
    }

    

    const ETAT_EN_ATTENTE = 'enAttente';
    const ETAT_EN_RENDEZVOUS = 'enRendezVous';
    const ETAT_CONSULTATION = 'enConsultation';

    public static function ConsultationEtat(){
        return [
            self::ETAT_EN_ATTENTE,
            self::ETAT_EN_RENDEZVOUS,
            self::ETAT_CONSULTATION,
        ];
    }
}
