<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('DistrictName')->nullable();
            $table->string('CountyName')->nullable();
            $table->string('SubCountyName')->nullable();
            $table->string('ParishName')->nullable();
            $table->string('VillageName')->nullable();
            $table->string('EAName')->nullable();

            $table->string("ethnographic_grouping")->nullable();
            $table->string("sub_region")->nullable();
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
        Schema::dropIfExists('districts');
    }
}
