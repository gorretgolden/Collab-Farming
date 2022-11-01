<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('data_collection_date')->nullable();
            $table->string('location_address')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('parish')->nullable();
            $table->string('village')->nullable();
            $table->string('respondent_name')->nullable();
            $table->string('respondent_gender')->nullable();
            $table->string('respondent_dob')->nullable();
            $table->string('is_respondent_owner')->nullable();
            $table->string('dob_of_owner')->nullable();
            $table->string('gender_of_owner')->nullable();
            $table->string('marital_status_owner')->nullable();
            $table->string('level_of_education_owner')->nullable();
            $table->string('type_of_house_owner')->nullable();
            $table->string('type_of_roofing')->nullable();
            $table->string('religion_of_owner')->nullable();
            $table->string('registered_phone_owner')->nullable();
            $table->string('belongs_to_agricultural_group')->nullable();
            $table->string('benefits_of_group')->nullable();
            $table->string('is_group_for_poiltry_farmers')->nullable();
            $table->string('when_started_egg_production')->nullable();
            $table->string('type_of_birds_kept')->nullable();
            $table->string('number_of_laying_birds')->nullable();
            $table->string('main_source_of_feeds')->nullable();
            $table->string('source_of_birds')->nullable();
            $table->string('is_source_good')->nullable();
            $table->string('source_of_birds2')->nullable();
            $table->string('is_source_good2')->nullable();
            $table->string('source_of_birds3')->nullable();
            $table->string('is_source_good3')->nullable();
            $table->string('how_many_annual_cycles')->nullable();
            $table->string('what_records_kept_at_farm')->nullable();
            $table->string('who_provides_labor')->nullable();
            $table->string('frequency_of_labor')->nullable();
            $table->string('who_provides_labor2')->nullable();
            $table->string('frequency_of_labor2')->nullable();
            $table->string('who_provides_labor3')->nullable();
            $table->string('frequency_of_labor3')->nullable();
            $table->string('major_challenges')->nullable();
            $table->string('solution_to_challenge')->nullable();
            $table->string('major_challenges2')->nullable();
            $table->string('solution_to_challenge2')->nullable();
            $table->string('major_challenges3')->nullable();
            $table->string('solution_to_challenge3')->nullable();
            $table->integer('daily_trays_number')->nullable();
            $table->integer('weekly_trays_number')->nullable();
            $table->integer('minimum_price_in_area')->nullable();
            $table->integer('maximum_price_in_area')->nullable();
            $table->string('current_egg_market')->nullable();
            $table->string('Select_income_source')->nullable();
            $table->string('do_you_get_money_from_source')->nullable();
            $table->string('who_gets_it')->nullable();
            $table->string('who_spends_it')->nullable();
            $table->string('Select_income_source2')->nullable();
            $table->string('do_you_get_money_from_source2')->nullable();
            $table->string('who_gets_it2')->nullable();
            $table->string('who_spends_it2')->nullable();
            $table->string('Select_income_source3')->nullable();
            $table->string('do_you_get_money_from_source3')->nullable();
            $table->string('who_gets_it3')->nullable();
            $table->string('who_spends_it3')->nullable();
    
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
        Schema::dropIfExists('farmer_profiles');
    }
}
