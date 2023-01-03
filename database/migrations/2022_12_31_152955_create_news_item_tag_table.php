<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_item_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_item_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
    
            $table->foreign('news_item_id')->references('id')->on('news_items')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_item_tag');
    }
};
