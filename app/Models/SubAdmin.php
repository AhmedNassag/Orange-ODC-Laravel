<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SubAdmin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table   = 'sub_admins';
    protected $guarded = [];
}