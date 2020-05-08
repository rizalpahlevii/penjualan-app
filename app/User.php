<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'nama', 'email', 'password', 'level', 'username'
    ];
    public function cart_transaksi()
    {
        return $this->hasMany(Cart_transaksi::class, 'user_id', 'id');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'user_id', 'id');
    }
    public function return_penjualan()
    {
        return $this->hasMany(Return_penjualan::class, 'user_id', 'id');
    }
}
