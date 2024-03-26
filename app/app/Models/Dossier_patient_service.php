<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier_patient_service extends Model
{
    protected $table= 'dossier_patient_service';
    use HasFactory;

    public $fillable = [
        'dossier_patient_id',
        'service_id'
    ];
}
