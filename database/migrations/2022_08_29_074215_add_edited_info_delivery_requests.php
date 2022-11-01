<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEditedInfoDeliveryRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('delivery_requests', function (Blueprint $table) {
            $table->after('status', function (Blueprint $table) {
                $table->date('new_delivery_date')->nullable();
                $table->time('new_delivery_start_time')->nullable();
                $table->time('new_delivery_end_time')->nullable();
                // $table->foreignId('bulking_center');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('delivery_requests', function (Blueprint $table) {
            $table->dropColumn(['new_delivery_date', 'new_delivery_start_time', 'new_delivery_end_time']);
        });
    }
}
