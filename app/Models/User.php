<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'location'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'email'    => 'required|unique:users|email|max:255',
        'username' => 'required|unique:users|alpha_dash|max:20',
        'password' => 'required|min:6',
    ];

    public function getName( ){
        if($this->first_name && $this->last_name)
            return "{$this->first_name} {$this->last_name}";

        if($this->first_name)
            return "{$this->first_name}";

        return null;
    }

    public function getNameOrUsername( ){
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername(){
        return $this->first_name ?: $this->username;
    }
}
