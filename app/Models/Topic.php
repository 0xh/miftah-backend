<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'description'];

    protected $dates = ['deleted_at'];

    public function speeches()
    {
        return $this->hasMany(Speech::class);
    }

     /**
      * Return users following this topic
      */
    public function followers()
    {
        return $this->morphToMany(User::class, 'followerble', 'followerbles', 'followerble_id', 'follower_id');
    }
}
