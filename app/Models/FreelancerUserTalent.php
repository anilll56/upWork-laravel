<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerUserTalent extends Model
{
    use HasFactory;

    protected $table = 'freelancer-user-talent';
    protected $fillable = [
        'id',
        'user_id',
        'talent',
    ];

    public function getFreelancerUserTalentsByTalents(array $talents)
    {
        return $this->whereIn('talent', $talents)
                    ->groupBy('user_id')
                    ->havingRaw('COUNT(DISTINCT talent) = ' . count($talents))
                    ->get();
    }
}
