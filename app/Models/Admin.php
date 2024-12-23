<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_activated',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_activated' => 'boolean',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_activated;
    }
}
