<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

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

    public  function clientUserLogin($email , $password)
    {
         $findUser = $this->where('email', $email)->first();
         if ($findUser) {
            if (Hash::check($password, $findUser->password)) {
                return $findUser;
            }
            else {
                return false;
            }
            
         }
    }
    
    public function getClientJobByEmail($email)
    {
        return $this->hashMany('App\Models\ClientWork')->where('email', $email)->get();
    }
}
