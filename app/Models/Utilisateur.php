<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'name',
        'email',
        'password',
         'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function messages()
{
    return $this->hasMany(Message::class, 'sender_id');
}

}
