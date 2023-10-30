<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class FreelancerUser extends Model
{
    use HasFactory;

    protected $table = 'freelancer-users';
    protected $fillable = [
        'name',
        'email',
        'password',
        "remember_token",
        'talent',
        'price',
    ];
    



    public function findFreelancerUser($email , $password)
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

    public function saveFreelancerUser($name , $email , $password , $talent , $price )
    {
        $saveUser = $this->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            "remember_token" => null,
            'talent' => $talent,
            'price' => $price,
        ]);
        if ($saveUser) {
            return $saveUser;
        }
        else {
            return false;
        }
    }
    public function getFreelancerUserWorksbyId($id)
    {
        return $this->hashMany('App\Models\FreelancerUserWorks')->where('id', $id)->get();
    }
    

}
