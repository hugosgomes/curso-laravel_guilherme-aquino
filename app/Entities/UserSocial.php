<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Traits\TransformableTrait;

class UserSocial extends Authenticatable
{
    use TransformableTrait;
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;
    protected $table = 'user_socials';
    protected $fillable = ['user_id', 'social_network', 'social_id', 'social_email', 'social_avatar'];
    protected $hidden = [];
}