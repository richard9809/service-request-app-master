<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'eqptName',
        'serial',
        'model',
        'summary',
        'user_id',
        'service',
        'remarks'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
