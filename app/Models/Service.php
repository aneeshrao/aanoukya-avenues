<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'slug',
    'icon',
    'short_description',
    'description',
    'display_order',
    'is_active',
])]
class Service extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('display_order')->orderBy('name');
    }
}
