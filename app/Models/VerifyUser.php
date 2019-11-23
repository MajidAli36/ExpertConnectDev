<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{

	protected $guarded = [];
 
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

	public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
 
    //
}
