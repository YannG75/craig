<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/subcategories.json');
        $subCategories = json_decode($getJson);

        foreach ($subCategories as $singleSubCategories){
            $SubCategory = new SubCategory();
            $SubCategory->name = $singleSubCategories->name;
            $SubCategory->slug = Str::slug($singleSubCategories->name);
            $SubCategory->category_slug = $singleSubCategories->category_slug;
            $SubCategory->save();
        }
    }
}
