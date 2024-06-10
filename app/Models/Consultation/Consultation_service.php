<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation_service extends Model
{
    use HasFactory;
    protected $fillable = ['consultation_id', 'service_id'];
}
