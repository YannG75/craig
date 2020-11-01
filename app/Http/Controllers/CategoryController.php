<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{

    public function index (Request $request, $city) {
        $getCity = City::where('slug', $city)->get();

        return Inertia::render('City', [
            'citySlug' => $city,
            'cityName' => $getCity[0]['name'],
            'categories' => Category::all()->load('sub'),
        ]);

    }
}
