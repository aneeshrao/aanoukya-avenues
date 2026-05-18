<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'email',
    'phone',
    'project_type',
    'message',
    'source',
    'replied_at',
])]
class ContactSubmission extends Model
{
    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
        ];
    }
}
