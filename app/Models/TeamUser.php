<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    use HasFactory;

    protected $table = 'team_user';

    const STATUS_ACTIVE = 'active';
    const STATUS_SUSPENDED = 'suspended';

    const ROLES = [
        'admin',
        'manager',
        'user',
        'guest'
    ];

    protected $casts =[
        'roles'=>'array'
    ];
}
