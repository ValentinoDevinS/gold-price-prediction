<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemActivity extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [

        'uuid',

        'module',

        'activity_type',

        'message',

        'status',

        'occurred_at',

    ];

    protected function casts(): array
    {
        return [

            'occurred_at'

                =>

                'datetime',

        ];
    }
}