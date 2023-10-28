<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsWorksModel extends Model
{
    use HasFactory;

    protected $table = 'clients-works';
    protected $fillable = [
        'name',
        'email',
        'work-type',
        'work-description',
        'work-price',
    ];

    public function user() {
        return $this->belongsTo('App\Models\ClientUser');
    }
    
}
