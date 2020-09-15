<?php

namespace App\SeriesISaw\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'username', 'password',
    ];

    public function seriesHistory() {
        return $this->hasMany(SeriesHistory::class);
    }

    protected $table = 'user';

    protected $attributes = [
        'is_admin' => false
    ];

    public function isAdmin()  {
        return $this->is_admin;
    }

}
