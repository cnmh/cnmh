<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @author CodeCampers,Soufiane boukhar
 */


class TypeHandicap extends Model
{
    use HasFactory;    public $table = 'type_handicaps';

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
        'description' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
