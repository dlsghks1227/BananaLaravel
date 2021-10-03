<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Players extends Authenticatable
{
    use HasFactory;

    // 화이트리스트 방식으로 대량 할당을 허용할 필드 설정
    // protected $fillable = [
    //     'address',
    //     'counter',
    // ];

    // 블랙리스트 방식으로 대량 할당을 혀용하지 않을 필드 설정
    protected $guarded = [
        'id'
    ];

    // 숨길 항목 설정
    protected $hidden = [
        'password', 'remeber_token'
    ];

    // 기본값 설정
    protected $attributes = [
        'counter' => 0
    ];

    // player 필드에서 테이블의 해시된 암호를 반환할 메서드 getAuthPassword()를 overwrite 합니다.
    public function getAuthPassword()
    {

    }
}
