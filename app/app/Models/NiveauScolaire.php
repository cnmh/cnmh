<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class NiveauScolaire extends Model
{
    use HasFactory;    public $table = 'niveau_scolaires';

    public $fillable = [
        'user_id',
        'nom',
        'description'
    ];
    
    protected $casts = [
        'user_id'=>"int",
        'nom' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
