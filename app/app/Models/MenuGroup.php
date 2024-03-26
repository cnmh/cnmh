<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class MenuGroup extends Model
{
    use HasFactory;    public $table = 'menu_groups';

    public $fillable = [
        'nom',
        'description',
        'icon'
    ];

    protected $casts = [
        'nom' => 'string',
        'description' => 'string',
        'icon' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string|max:65535',
        'icon' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function menuItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\MenuItem::class, 'menu_group_id');
    }
}
