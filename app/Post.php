<?php

namespace App;

use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
  
    use Commentable;

    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('post_id', $this->id)
                            ->first();
    }

    public function favorites()
    {
      return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimeStamps();
    }
}
