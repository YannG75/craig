<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/cities.json');
        $cities = json_decode($getJson);

        foreach ($cities as $singlecities){
            $city = new City();
            $city->name = $singlecities->name;
            $city->code = $singlecities->code;
            $city->picture = $singlecities->picture;
            $city->slug = Str::slug($singlecities->name);
            $city->save();
        }
    }
}
