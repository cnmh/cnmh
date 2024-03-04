<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sprint 3
 */
class Dentiste extends Consultation
{
    // protected $table = 'consultations';
    use HasFactory;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['type'] = 'dentiste';
    }


}
