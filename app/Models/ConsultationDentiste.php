<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Consultation;

class ConsultationDentiste extends Consultation
{
    use HasFactory;    
    
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

}
