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

    public function getAvatarUrl( ){
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=40";
    }

    public function friendsOfMine( ){
        return $this->belongsToMany( 'User', 'friends', 'user_id', 'friend_id' );
    }

    public function friendOf(){
        return $this->belongsToMany( 'User', 'friends', 'friend_id', 'user_id' );
    }

    public function friends( ){
        return $this->friendsOfMine()->wherePivot( 'accepted', true )->get()
                ->merge($this->friendOf()->wherePivot('accepted',true)->get());
    }

    public function friendRequests( ){
        return $this->friendsOfMine()->wherePivot( 'accepted', false )->get();
    }

    public function friendRequestsPending( ){
        return $this->friendOf()->wherePivot( 'accepted', false )->get();
    }

}
