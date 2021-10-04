<?php

namespace Afiqiqmal\LaraPassPolicy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}