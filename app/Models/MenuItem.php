<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class MenuItem extends Model
{
    use HasFactory;    public $table = 'menu_items';

    public $fillable = [
        'nom',
        'description',
        'icon',
        'url',
        'visible_for',
        'menu_group_id'
    ];

    protected $casts = [
        'nom' => 'string',
        'description' => 'string',
        'icon' => 'string',
        'url' => 'string',
        'visible_for' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string|max:65535',
        'icon' => 'nullable|string|max:255',
        'url' => 'required|string|max:255',
        'visible_for' => 'nullable|string|max:255',
        'menu_group_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function menu_group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\MenuGroup::class, 'menu_group_id');
    }
}
