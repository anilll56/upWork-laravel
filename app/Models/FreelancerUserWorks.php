<?php
use  Illuminate\Database\Eloquent\Model;
use App\Models\FreelancerUser;
class UserWork extends Model{
    protected $table = 'user-work-table';
    protected $fillable = [
        'name',
        'email',
        'work-type',
        'work-description',
        'work-price',
    ];

    public function user() {
        return $this->belongsTo('App\Models\FreelancerUser');
    }

    public function getUserWorkById($id)
    {
        return $this->hashMany('App\Models\UserWork')->where('id', $id)->get();
    }

    public function getUserWorkByTalent($talent)
    {
        $user = FreelancerUser::where('talent', $talent)->first();
    
        if ($user) {
            return $this->where('user_id', $user->id)->get();
        }
    
        return collect(); 
    }

}

