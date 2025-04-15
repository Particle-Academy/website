<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website',
        'description',
        'logo_path',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'display_order' => 'integer',
        'is_published' => 'boolean',
    ];
}
