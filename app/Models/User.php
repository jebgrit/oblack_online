<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $guarded = [];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }



    /**
     * one to Many.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }


    /**
     * one to Many.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }




    // user activity
    public function UserOnline()
    {
        return Cache::has('user-is-online' . $this->id);
    }
}
