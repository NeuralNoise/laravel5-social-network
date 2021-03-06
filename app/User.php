<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name', 'location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    public static $rules = [
        'email' => 'required|unique:users|email|max:255',
        'username' => 'required|unique:users|alpha_dash|max:20',
        'password' => 'required|min:6',
    ];

    public static $rules_update_profile = [
        'first_name' => 'alpha_num|max:255',
        'last_name' => 'alpha_num|max:255',
        'location' => 'max:20',
    ];

    /**
     * Get Full name of user
     *
     * @return null|string
     */
    public function getName()
    {
        if ($this->first_name && $this->last_name)
            return "{$this->first_name} {$this->last_name}";

        if ($this->first_name)
            return "{$this->first_name}";

        return null;
    }

    /**
     * Get Full name or Username
     *
     * @return mixed
     */
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    /**
     * Get First name or Username
     *
     * @return mixed
     */
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    /**
     * Get user avatar
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=40";
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friendOfUser()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function statuses()
    {
        return $this->hasMany('App\Models\Status', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool)$this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool)$this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach(['user_id'=>$user->id,'accepted'=>0]);
    }

    public function deleteFriend(User $user)
    {
        $this->friendOfUser()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool)$this->friends()->where('id', $user->id)->count();
    }

    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool)$status->likes->where('user_id', $this->id)->count();
    }
}
