<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo('App\city');
    }
    
    public function categories()
    {
        return $this->belongsTo('App\category');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

}
