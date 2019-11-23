<?php

namespace App\Models;


use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Notifications\ExpertUserResetPasswordNotification;
use Illuminate\Auth\Passwords;

// use Illuminate\Foundation\Auth\User as Authenticatable;
// 
class User extends Model implements Authenticatable ,CanResetPasswordContract
{
    use Notifiable;
    // use ResetsPasswords;
    // use CanResetPasswordContract;

 
    protected $table = 'user_table';

    public $guard;

    protected $primaryKey ='_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'useremail',
        'email',
        'country_code',
        'phone',
        'gender',
        'dob',
        'about',
        'address',
        'image',
    ];

    // protected $table_name ='fdsajalkf';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'fcm_id',
        'verificationcode',
        'date_created',
        'status',
        'remember_token'
    ];

    protected $guarded =[
        'password',
        'fcm_id',
        'verificationcode',
        'date_created',
        'status'
    ];

    public $timestamps = false;


    public function setNameAttribute($name){

        $this->attributes['name'] = $name;
    }

    public function setPasswordAttribute($password){

        $this->attributes['password'] = Hash::make($password);
    }

    public function setCountryCode($countryCode){

        $this->attributes['country_code'] = $countryCode;
    }


/**
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // Return the name of unique identifier for the user (e.g. "id")
        return '_id';
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        // Return the unique identifier for the user (e.g. their ID, 123)
        return $this->attributes['_id'];
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        // Returns the (hashed) password for the user
        return $this->attributes['password'];
    }

    /**
     * @return string
     */
    public function getRememberToken()
    {
        // Return the token used for the "remember me" functionality
        return $this->attributes['remember_token'];
    }

    /**
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Store a new token user for the "remember me" functionality (Cookie)
        
        //  All encrypted values are encrypted using OpenSSL and the AES-256-CBC cipher
        $this->attributes['remember_token'] = Hash::make($value);
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        // Return the name of the column / attribute used to store the "remember me" token
        return 'remember_token';
    }

    // public function createToken(CanResetPasswordContract $user)
    // {
    //     return $this->tokens->create($user);
    // }

// overridding the trait CanResetPassword
    // public function guard(array $guarded) {
    //     return $this->gaurd;
    // }
 
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ExpertUserResetPasswordNotification($token));
    }

    public function getEmailForPasswordReset()
    {
        return $this->useremail;
    }
}