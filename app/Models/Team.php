<?php

namespace App\Models;

use Filament\Models\Contracts\HasCurrentTenantLabel;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model implements HasAvatar, HasCurrentTenantLabel
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function members()
    {
        return $this->users();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->logo;
    }

    public function getCurrentTenantLabel(): string
    {
        return 'Active team';
    }
}
