<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'file_path',
    ];
    public function sender()
{
    return $this->belongsTo(Utilisateur::class, 'sender_id');
}

}
