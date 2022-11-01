<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepSevenColumnDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farmer_profiles', function (Blueprint $table) {
            $table->string('market_information')->nullable();
            $table->string('belongs_to_saving_group')->nullable();
            $table->string('saving_group_name')->nullable();
            $table->string('saving_group_type')->nullable();
            $table->string('saving_group_name2')->nullable();
            $table->string('saving_group_type2')->nullable();
            $table->string('saving_group_name3')->nullable();
            $table->string('saving_group_type3')->nullable();
            $table->string('consultation')->nullable();
            $table->string('consultation_number')->nullable();
            $table->string('information_requested')->nullable();
            $table->string('required_training')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farmer_profiles', function (Blueprint $table) {
            //
        });
    }
}
       