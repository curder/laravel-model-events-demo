<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body'
    ];

    protected static function boot()
    {

        Post::creating(function($post){
            echo "creating event is fired\n";
            if($post->title == 'title') return false;
        });

        Post::created(function($post){
            echo "created event is fired\n";
        });

        Post::updating(function($post){
            echo "updating event is fired\n";
        });

        Post::updated(function($post){
            echo "updated event is fired\n";
        });

        Post::saving(function($post){
            echo "saving event is fired\n";
        });
        
        
        Post::saved(function($post){
            echo "saved event is fired\n";
        });

        Post::deleting(function($post){
            echo "deleting event is fired\n";
        });

        Post::deleted(function($post) {
            echo "deleted event is fired\n";
        });
    }
}
