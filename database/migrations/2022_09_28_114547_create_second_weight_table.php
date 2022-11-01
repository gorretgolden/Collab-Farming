<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondWeightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_weights', function (Blueprint $table) {
            $table->id();
            $table -> bigInteger('delivery_request_id');
            $table -> integer('actual_no_of_trays2');
            $table -> integer('weight2');
            $table -> integer('total_price2');
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
        Schema::dropIfExists('second_weights');
    }
}
