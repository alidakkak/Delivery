<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function features()
    {
        return $this->hasMany(Features::class);
    }

    public function setImageAttribute($image)
    {
        if ($image instanceof \Illuminate\Http\UploadedFile) {
        $newImageName = uniqid().'_'.'product_image'.'.'.$image->extension();
        $image->move(public_path('product_image'), $newImageName);

        return $this->attributes['image'] = '/'.'product_image'.'/'.$newImageName;
    } elseif (is_string($image)) {
        $this->attributes['image'] = $image;
    }
    }
}
