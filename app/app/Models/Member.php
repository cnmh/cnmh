<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

 /**
 * A supprimer
 */
class Member extends Model
{
    use HasFactory;    public $table = 'members';

    public $fillable = [
        'first_name',
        'last_name'
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string'
    ];

    public static array $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
