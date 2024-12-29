<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = ['id'];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function setImageAttribute($image)
    {
        if ($image instanceof \Illuminate\Http\UploadedFile) {
        $newImageName = uniqid().'_'.'store_image'.'.'.$image->extension();
        $image->move(public_path('store_image'), $newImageName);

        return $this->attributes['image'] = '/'.'store_image'.'/'.$newImageName;
    } elseif (is_string($image)) {
        $this->attributes['image'] = $image;
    }
    }
}
