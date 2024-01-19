<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'content', 
        'published_at',
         'image_1',
          'image_2', 
          'image_3',
           'image_4', 
           'image_5',
    ];

    protected $dates = [
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}