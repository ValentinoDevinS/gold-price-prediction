<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemHealthHistory extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [

        'uuid',

        'overall_status',

        'database_status',

        'storage_status',

        'scheduler_status',

        'python_status',

        'pipeline_status',

        'response_time_ms',

        'checked_at',

        'details',

    ];

    protected $casts = [

        'checked_at' => 'datetime',

        'details' => 'array',

        'response_time_ms' => 'integer',

    ];
}