<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'category',
    'location',
    'year_label',
    'cover_image',
    'gallery_images',
    'project_area',
    'status_label',
    'summary',
    'description',
    'display_order',
    'is_featured',
    'is_active',
])]
class Project extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function casts(): array
    {
        return [
            'gallery_images' => AsArrayObject::class,
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('display_order')->latest('created_at');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->where('is_active', true)->orderBy('display_order');
    }
}
