<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EtatCivil extends Model
{
    use HasFactory;    public $table = 'etat_civils';

    public $fillable = [
        'nom',
        'description'
    ];

    protected $casts = [
        'nom' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
