<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->string('category');
            $table->string('asset_type');
            $table->string('asset_condition');
            $table->string('city');
            $table->string('address_name');
            $table->string('address_num');
            $table->string('area');
            $table->string('neighborhood');
            $table->string('floor');
            $table->string('entry_num')->nullable();
            $table->string('sum_of_floor');
            $table->boolean('is_on_pillars');
            $table->integer('parking_place');
            $table->string('rooms');
            $table->string('porch');
            $table->string('about_the_asset')->nullable();
            $table->json('asset_extras')->default(['0']);
            $table->integer('asset_size')->nullable();
            $table->integer('total_asset_size');
            $table->integer('price')->nullable();
            $table->date('entry_date')->nullable();
            $table->boolean('is_immediate_entry');
            $table->json('images')->nullable();
            $table->json('contacts');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
