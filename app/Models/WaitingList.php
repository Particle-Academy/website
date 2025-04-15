<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaitingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'interest',
        'contacted',
        'notes',
    ];

    protected $casts = [
        'interest' => 'array',
        'contacted' => 'boolean',
    ];
}
