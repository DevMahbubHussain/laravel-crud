<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    const PLACEHOLDER_IMAGE_PATH = 'images/placeholder.jpeg';

    protected $fillable = [
        'title',
        'description',
        'price',
        'status',
        'author_id'
    ];


    // offer has many location and categories as well 

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
}
