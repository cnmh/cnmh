<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation_type_handicap extends Model
{
    protected $table= 'type_handicap_consultation';
    use HasFactory;
    protected $fillable = ['consultation_id', 'type_handicap_id'];
}
