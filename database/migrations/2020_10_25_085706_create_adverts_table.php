<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->string('picture');
            $table->string('city');
            $table->string('category');
            $table->string('sub_category')->nullable();
            $table->boolean('is_masked')->default(false);
            $table->string('slug');
            $table->foreignId('user_id');
            $table->string('city_slug');
            $table->string('category_slug');
            $table->string('sub_category_slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
