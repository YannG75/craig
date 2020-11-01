<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/categories.json');
        $categories = json_decode($getJson);

        foreach ($categories as $singleCategories){
            $category = new Category();
            $category->name = $singleCategories->name;
            $category->slug = Str::slug($singleCategories->name);
            $category->save();
        }
    }
}
