<?php

namespace App\Models;

class Client extends User
{
    protected $table = 'users';

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }
} 