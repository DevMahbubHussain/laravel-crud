<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

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
