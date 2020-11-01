<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Inertia\Inertia as Inertia;

class CityController extends Controller
{
    public function index (Request $request) {

        return Inertia::render('Home', [
            'cities' => City::all(),
        ]);
    }
}
