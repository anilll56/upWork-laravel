<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientUser extends Model
{
    use HasFactory;
    protected $table = 'client-users';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function work() {
        return $this->hasMany('App\Models\ClientWork');
    }
    public function findUser($email , $password , $table)
    {
        return $findUser = $this->where('email', $email)->first();
    }

    public function getClientUserWorkById($id)
    {
        return $this->hashMany('App\Models\ClientWork')->where('id', $id)->get();
    }

    public function getClientWorks ()
    {
        return $this->hasMany('App\Models\ClientWork');
    }

    public function getClientUserWorkByTalent($talent)
    {
        return $this->getClientWorks()->where('talent', $talent)->get();
    }
    
    public function getClientUserWorkByPrice($price)
    {
        return  $this->getUserByPrice() ->where('price', $price)->get();
    }
}
