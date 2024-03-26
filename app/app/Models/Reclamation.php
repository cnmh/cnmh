<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

  /**
 * Sprint 3
 */

class Reclamation extends Model
{
    use HasFactory;    public $table = 'reclamations';

    public $fillable = [
        'patient_id',
        'objet',
        'reclamation',
        'date_reclamation'
    ];

    protected $casts = [
        'objet' => 'string',
        'reclamation' => 'string',
        'date_reclamation' => 'datetime'
    ];

    public static array $rules = [
        'patient_id' => 'required',
        'objet' => 'required|string|max:255',
        'reclamation' => 'required|string|max:255',
        'date_reclamation' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function patients(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Patient::class, 'patient_id');
    }
}
