<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;
    protected $table = 'users';
    protected $fillable = ['cpf', 'name', 'phone', 'birth', 'gender', 'notes', 'email', 'password', 'status', 'permission'];
    protected $hidden = ['password', 'remember_token',];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
    }

    public function getCpfAttribute(){
        $cpf = $this->attributes['cpf'];
        return substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 7, 3).'-'.substr($cpf, -2);
    }

    public function getPhoneAttribute(){
        $phone = $this->attributes['phone'];
        return '(' . substr($phone, 0, 2).')'.substr($phone, 2, 4).'-'.substr($phone, 6, 4);
    }

    public function getBirthAttribute(){
        $birth = explode('-', $this->attributes['birth']);

        if (count($birth) != 3)
            return '';

        $birth =  $birth[2] . '/' . $birth[1] . '/' . $birth[0];
        return $birth;
    }

}
