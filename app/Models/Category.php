<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['sub_categories', 'advert'];
    public function sub()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_slug', 'slug');
    }

    public function advert()
    {
        return $this->hasMany('App\Advert', 'category_slug', 'slug');
    }
}
