<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecretLog extends Model
{
    protected $fillable = [
        'token',
        'ip_address',
        'country',
        'city',
        'device',
        'browser',
        'os',
        'event',
    ];
}