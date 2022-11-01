<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEggProducerprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('egg_producerprofiles', function (Blueprint $table) {
        //     $table->id();
        //     $table->json('address')->nullable();
        //     $table->integer('created_by');
        //     $table->tinyInteger('form_stage');
        //     $table->json('house_hold_info')->nullable();
        //     $table->json('social_info')->nullable();
        //     $table->json('egg_production')->nullable();
        //     $table->json('marketing')->nullable();
        //     $table->json('household_income')->nullable();
        //     $table->json('savings')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('egg_producerprofiles');
    }
}
