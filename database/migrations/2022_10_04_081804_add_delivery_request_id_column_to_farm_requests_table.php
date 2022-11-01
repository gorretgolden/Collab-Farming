<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryRequestIdColumnToFarmRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farm_requests', function (Blueprint $table) {
            $table->foreignId('delivery_request_id');
            $table->string('request_input')->nullable();
            $table->foreign('delivery_request_id')->references('id')->on('delivery_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farm_requests', function (Blueprint $table) {
            $table->dropForeign('delivery_request_id');
        });
    }
}