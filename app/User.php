<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '',
    ];

    public function tickets()
   {
       return $this->hasMany(Ticket::class);
   }
   /**
    * A user can have many comments
    */
   public function comments()
   {
       return $this->hasMany(Comment::class);
   }
   /**
    * Get the user that created ticket
    * @param  User  $user_id
    */
   public static function getTicketOwner($user_id)
   {
       return static::where('id', $user_id)->firstOrFail();
   }


}
