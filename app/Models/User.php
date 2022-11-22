<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['image'];


    public function getImageAttribute(){
         
        return 'https://eu.ui-avatars.com/api/?name='.$this->name.'&background=0D8ABC&color=fff';
    }

    public function posts()
    {
        return $this->hasMany(Post::Class);
    }

    public function likes()
    {
        return $this->hasMany(Like::Class);
    }

    public function toggleLike($post_id)
    {
        return $this->likes()->where('post_id', $post_id)->first() 
                ? $this->likes()->where('post_id', $post_id)->delete() 
                : $this->likes()->create(['post_id'=>$post_id]);
    }
}
