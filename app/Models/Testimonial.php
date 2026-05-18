<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'client_name',
    'client_title',
    'company',
    'rating',
    'quote',
    'display_order',
    'is_active',
])]
class Testimonial extends Model
{
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('display_order')->latest('created_at');
    }
}
