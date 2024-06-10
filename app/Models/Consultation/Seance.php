<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    protected $table = "seances";

    public $fillable = [
        "rendezVous_id",
        "consultation_id",
        "etat"
    ]; 
}
