<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'body'
    ];

    protected static function booted()
    {
        static::creating(function($post) {
            echo "creating event is fired\n";
            if ($post->title === 'title') {
                return false;
            }
        });

        static::created(function($post){
            echo "created event is fired\n";
        });

        static::updating(function($post){
            echo "updating event is fired\n";
        });

        static::updated(function($post){
            echo "updated event is fired\n";
        });

        static::saving(function($post){
            echo "saving event is fired\n";
        });

        static::saved(function($post){
            echo "saved event is fired\n";
        });

        static::deleting(function($post){
            echo "deleting event is fired\n";
        });

        static::deleted(function($post) {
            echo "deleted event is fired\n";
        });


        static::restoring(function($post) {
            echo "restoring event is fired\n";
        });

        static::restored(function(){
           echo "restored event is fired\n";
        });
    }
}
