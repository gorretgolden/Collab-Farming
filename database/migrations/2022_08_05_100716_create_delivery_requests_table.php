<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id');
            $table->integer('quantity')->nullable();
            $table->string('quantity_type')->nullable();
            $table->integer('request_quantity')->nullable();
            $table->string('request_type')->nullable();
            $table->date('delivery_date');
            $table->time('delivery_start_time');
            $table->time('delivery_end_time');
            $table->foreignId('bulking_center');
            $table->enum('status', ['pending', 'received', 'confirmed', 'declined'])->default('pending');
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
        Schema::dropIfExists('delivery_requests');
    }
}
