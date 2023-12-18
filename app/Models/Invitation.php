<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'data'=>'array'
    ];
}
