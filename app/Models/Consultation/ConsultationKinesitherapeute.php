<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Consultation\Consultation;
use App\Traits\MorphType; 


class ConsultationKinesitherapeute extends Consultation
{
    use HasFactory,MorphType;    
}
