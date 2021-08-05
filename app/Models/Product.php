<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'price',
        'gender',
        'type',
        'sub_type',
        'size_available',
        'color',
        'material',
        'collection'
    ];
}
