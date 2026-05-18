<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'role',
    'photo',
    'experience_label',
    'bio',
    'display_order',
    'is_active',
])]
class TeamMember extends Model
{
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('display_order')->orderBy('name');
    }
}
