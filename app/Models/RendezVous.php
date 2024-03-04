<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class RendezVous extends Model
{
    use HasFactory;    public $table = 'rendez_vous';

    public $fillable = [
        'id_consultation',
        'date_rendez_vous',
        'etat',
        'remarques'
    ];

    protected $casts = [
        'date_rendez_vous' => 'datetime',
        'etat' => 'string',
        'remarques' => 'string'
    ];

    public static array $rules = [
        'id_consultation' => 'required',
        'date_rendez_vous' => 'required',
        'etat' => 'required|string|max:255',
        'remarques' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function idConsultation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Consultation::class, 'id_consultation');
    }
}
