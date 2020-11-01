<?php

namespace Database\Seeders;

use App\Http\Controllers\CityController;
use App\Models\Advert;
use App\Models\City;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('Fr');

        $getJson= File::get('database/data/cities.json');
        $cities = json_decode($getJson);
        $getJson= File::get('database/data/categories.json');
        $categories = json_decode($getJson);
        $getJson= File::get('database/data/subcategories.json');
        $subcategories = json_decode($getJson);

        for ($i=0; $i < 900; $i++) {
            $advert = new Advert();
            $randCity = $faker->numberBetween( 0, 29);
            $randCat = $faker->numberBetween( 0, 6);
            $randSub = $faker->numberBetween( 0, 182);

            $advert->title = $faker->text(50);
            $advert->description = $faker->paragraph(3);
            if($i < 10)
            $advert->picture = 'http://placeimg.com/640/36'.$i.'/any';
            else if ($i < 100)
            $advert->picture = 'http://placeimg.com/640/3'.$i.'/any';
            else
            $advert->picture = 'http://placeimg.com/640/'.($i+300).'/any';
            $advert->city = $cities[$randCity]->name;
            $advert->category = $categories[$randCat]->name;
            if(Str::slug($advert->category) == $subcategories[$randSub]->category_slug )
            $advert->sub_category = $subcategories[$randSub]->name;

            $advert->is_masked = 0; //rand(0,1)

            $advert->slug = Str::slug($advert->title);
            $advert->city_slug = Str::slug($advert->city);
            $advert->category_slug = Str::slug($advert->category);
            $advert->sub_category_slug = Str::slug($advert->sub_category);

            $advert->save();
        }
    }
}
