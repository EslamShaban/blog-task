<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

        
    protected $appends = ['image_path'];


    public function getImagePathAttribute(){
         
        return asset(($this->asset->url ?? 'assets/images/default.png'));
        
    }

    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::Class);
    }

    public function likers()
    {
        return $this->hasMany(Like::Class);
    }
}
