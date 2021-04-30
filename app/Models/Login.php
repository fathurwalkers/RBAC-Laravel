<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Login extends Model
{
    use HasFactory;

    protected $table = 'login';

    protected $guarded = [];

    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
