<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tuteur extends Model
{
    use HasFactory;    public $table = 'tuteurs';

    public $fillable = [
        'etat_civil_id',
        'nom',
        'prenom',
        'sexe',
        'telephone',
        'email',
        'adresse',
        'cin',
        'remarques'
    ];

    protected $casts = [
        'nom' => 'string',
        'prenom' => 'string',
        'sexe' => 'string',
        'telephone' => 'string',
        'email' => 'string',
        'adresse' => 'string',
        'cin' => 'string',
        'remarques' => 'string'
    ];

    public static array $rules = [
        'etat_civil_id' => 'required',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'sexe' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'cin' => 'required|string|max:255',
        'remarques' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function etatCivil(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\EtatCivil::class, 'etat_civil_id');
    }

    public function patients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Patient::class, 'tuteur_id');
    }
}
