<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierPatient_typeHandycape extends Model
{
    use HasFactory;
   protected $table= 'dossier_patient_type_handicap';
    public $fillable = [
        'dossier_patient_id',
        'type_handicap_id'
    ];

    // protected $casts = [
    //     'nom' => 'string',
    //     'description' => 'string'
    // ];

    // public static array $rules = [
    //     'nom' => 'required|string|max:255',
    //     'description' => 'required|string|max:255',
    //     'created_at' => 'nullable',
    //     'updated_at' => 'nullable'
    // ];

}
