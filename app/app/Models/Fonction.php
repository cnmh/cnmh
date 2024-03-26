<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

 /**
 * Sprint 3
 */

class Fonction extends BaseModel
{
    use HasFactory;    public $table = 'fonctions';


        // $this->referance_culomn = "nom";


    public $fillable = [
        'nom',
        'description'
    ];

    protected $casts = [
        'nom' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|string|max:255|unique:fonctions,nom',
        'description' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

}
