<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 대량 할당 가능한 속성
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'address',
        'counter',
        'password'
    ];

    /**
     * 배열로 출력 시 제외되어야 하는 속성
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * PHP 네이티브 타입으로 형변환되어야 하는 속성
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // 기본값 설정
    protected $attributes = [
        'counter' => 0
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setAddressAttribute($address)
    {
        $this->attributes['address'] = ip2long($address);
    }
}
