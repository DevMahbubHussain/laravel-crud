<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;


    const PLACEHOLDER_IMAGE_PATH = 'images/placeholder.jpeg';

    protected $fillable = [
        'title',
        'description',
        'price',
        'status',
        'author_id',
        'deleted_by',
        'deleted_at'
    ];


    public function author()
    {
        return $this->belongsTo(User::class);
    }
    // offer has many location and categories as well 

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->hasMedia()
            ? $this->getFirstMediaUrl()
            : self::PLACEHOLDER_IMAGE_PATH;
    }
}
