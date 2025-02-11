<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'user_username',
        'user_password',
        'user_ipassword',
        'user_mobile',
        'user_email',
    ];
    public function getAuthPassword()
    {
        return $this->user_password; 
    }
}
