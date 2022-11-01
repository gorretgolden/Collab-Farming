<?php

namespace App\Http\Controllers\API\Profiling;

use App\Mail\AccountCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profiling\createProfile;
use App\Models\District;
use App\Models\EggProducerprofile;
use App\Models\EmailLog;
use App\Models\FarmerProfile;
use App\Models\Role;
use App\Models\User;
use App\Models\Weight;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProfilingApi extends Controller
{



    public function saveProfile(createProfile $request)
    {

        return $request->save();
    }


    public function getProfile($id)
    {

        $profile = Farmerprofile::find($id);

        return $profile;
    }
    public function getAllProfiles()
    {
        $all_farmers = FarmerProfile::all();
        return Helpers::response($all_farmers, 200);

    }


    public function getReports()
    {
        $reports = FarmerProfile::all();

        return Helpers::response($reports, 200);
    }
    public function countProfiles()
    {
        $reports = FarmerProfile::all()->count();
        $female = FarmerProfile::where('respondent_gender','female')->count();
        $male = FarmerProfile::where('respondent_gender','male')->count();


        return response()->json(compact('reports','female','male'));

    }

    public function destroy($id)
    {
        $existinginput = FarmerProfile::find ( $id );
        //delete input
        if($existinginput){
            $existinginput -> delete();
            return "Input successfully deleted.";
        }
        return "Input not found";
    }
    
    public function getDistricts()
    {

        $district = District::select('DistrictName')->distinct()->get(['DistrictName']);

        return Helpers::response($district, 200);
    }

    public function getSubCountry($id)
    {
        $sub = District::where('DistrictName', $id)
            ->select('SubCountyName')
            ->distinct()->get(['SubCountyName']);

        return Helpers::response($sub, 200);
    }

    public  function getParish(Request $request)
    {

        $parish = District::where('SubCountyName', $request->sub_county)
            ->where('DistrictName', $request->district)
            ->select('ParishName')
            ->distinct()->get(['ParishName']);


        return Helpers::response($parish, 200);
    }


    public  function getVillage(Request $request)
    {

        $village = District::where('ParishName', $request->parish)
            ->where('SubCountyName', $request->sub_county)
            ->where('DistrictName', $request->district)
            ->select('VillageName')
            ->distinct()->get(['VillageName']);


        return Helpers::response($village, 200);
    }
    public function saveFarmerProfile(Request $request)
    {
     
                if ($request->form_stage == 1) {
        

                    FarmerProfile::create([
                        'village' => $request->village,
                        'district' => $request->district,
                        'sub_county' => $request->sub_county,
                        'parish' => $request->parish,
                        'name' => $request->names,
                        'email' => $request->email,
                        'location_address' => $request->address,
                        'data_collection_date' => $request->collection_date,
                        'form_stage' => $request->form_stage

                    ]);

                    $role = Role::where('name', 'farm')->first();

                    //generate a random password 
            
                    //return Helpers::response($this, 200);
            
                    $password = Helpers::randomPassword(8);
            
                    //if role exists continue with creation of the related account 
                    if ($role) {
            
                        $user = User::create([
                            'name' => $request->names,
                            'email' => $request->email,
                            'password' => bcrypt($password)
                        ]);
            
                        $user->password = $password;
            
                        $user->roles()->attach($role);

                        $this->dispatchAccountCreatedEmail($user);

            
                    }
                

                    return Helpers::response($request->email, 200);
                }

               
        }
    private function dispatchAccountCreatedEmail($details)
    {

        $mail = new AccountCreated($details);

        try {
            $mail = new AccountCreated($details);

            EmailLog::create([
                'to' => $details->name . ' (' . $details->email . ')',
                'title' => 'Farmer Account Registered',
                'message' => $mail->render()
            ]);
            Mail::to($details->email)->send($mail);
        } catch (\Exception $ex) {
        }
    }
        public function editAddressDetails(Request $request)
        {
            $id = $request->id;

   
                $profile = FarmerProfile::where('id', $id)->first();

                $profile->update([
                'village' => $request->village,
                'district' => $request->district,
                'sub_county' => $request->sub_county,
                'parish' => $request->parish,
                'name' => $request->names,
                'email' => $request->email,
                'location_address' => $request->address,
                'data_collection_date' => $request->collection_date,

            ]);

            return Helpers::response($id, 200);

        }
        public function editStepTwo(Request $request){
            $id = $request->id;

   
                $profile = FarmerProfile::where('id', $id)->first();

                $profile->update([
                    'respondent_name' => $request->respondent_name,
                    'respondent_gender' => $request->respondents_gender,
                    'respondent_dob' => $request->respondents_date_of_birth,
                    'is_respondent_owner' => $request->is_respondent_owner_of_enterprise,
                    'dob_of_owner' => $request->enterprise_owner_date_of_birth,
                    'gender_of_owner' => $request->enterprise_owner_gender,
                    'marital_status_owner' => $request->enterprise_owner_marital_status,
                     'level_of_education_owner' => $request->enterprise_owner_education_level,
                     'type_of_house_owner' => $request->enterprise_owner_house_type,
                     'type_of_roofing' => $request->enterprise_owner_roofing_type,
                     'religion_of_owner' => $request->enterprise_owner_religion,
                     'registered_phone_owner' => $request->registered_phone,
                     'form_stage' => $request->form_stage


                ]);

                return Helpers::response($id, 200);


        }
        public function editStepThree(Request $request){
            $id = $request->id;

   
                $profile = FarmerProfile::where('id', $id)->first();

                $profile->update([
                    'belongs_to_agricultural_group' => $request->agric_oriented_group,
                    'is_group_for_poiltry_farmers' => $request->is_poultry_farmers,
                    'benefits_of_group' => $request->benefits,
                    'why_not_in_group' => $request->why,
                    'form_stage' => $request->form_stage


                ]);

                return Helpers::response($id, 200);

            
        }
        public function editStepFour(Request $request){
            $id = $request->id;

   
                $profile = FarmerProfile::where('id', $id)->first();

                $profile->update([
                    'when_started_egg_production' => $request->egg_production_date,
                    'type_of_birds_kept' => $request->type_of_birds,
                    'number_of_laying_birds' => $request->number_of_egg_laying_birds,
                    'main_source_of_feeds' => $request->source_of_feeds,
                    'source_of_birds' => $request->source_of_birds,
                    'is_source_good' => $request->source_of_birds_quality,
                    'source_of_birds2' => $request->source_of_birds_2,
                    'is_source_good2' => $request->source_of_birds_quality_2,
                    'source_of_birds3' => $request->source_of_birds_3,
                    'is_source_good3' => $request->source_of_birds_quality_3,
                    'how_many_annual_cycles' => $request->number_of_cycles,
                    'what_records_kept_at_farm' => $request->records_kept_on_the_farm,
                    'who_provides_labor' => $request->labour_provider,
                    'frequency_of_labor' => $request->labour_provider_frequency,
                    'who_provides_labor2' => $request->labour_provider_2,
                    'frequency_of_labor2' => $request->labour_provider_frequency_2,
                    'who_provides_labor3' => $request->labour_provider_3,
                    'frequency_of_labor3' => $request->labour_provider_frequency_3,
                    'major_challenges' => $request->challenges,
                    'solution_to_challenge'  => $request->solution,
                    'form_stage' => $request->form_stage
                ]);

                return Helpers::response($id, 200);

            
        }
        public function editStepFive(Request $request){
            $id = $request->id;

   
                $profile = FarmerProfile::where('id', $id)->first();

                $profile->update([
                    'daily_trays_number' => $request->trays_per_day,
                    'weekly_trays_number' => $request->trays_per_week,
                    'minimum_price_in_area' => $request->first_range,
                    'maximum_price_in_area' => $request->second_range,
                    'current_egg_market' => $request->current_market,
                    'form_stage' => $request->form_stage

                ]);

                return Helpers::response($id, 200);

            
        }
        public function editStepSix(Request $request){
            $id = $request->id;

   
                $profile = FarmerProfile::where('id', $id)->first();

                $profile->update([
                    'Select_income_source' => $request->income_source,
                    'do_you_get_money_from_source' => $request->is_income_generating,
                    'who_gets_it' => $request->who_gets_it,
                    'who_spends_it' => $request->who_spents_it,
                    'Select_income_source2' => $request->income_source2,
                    'do_you_get_money_from_source2' => $request->is_income_generating2,
                    'who_gets_it2' => $request->who_gets_it2,
                    'who_spends_it2' => $request->who_spents_it2,
                    'Select_income_source3' => $request->income_source3,
                    'do_you_get_money_from_source3' => $request->is_income_generating3,
                    'who_gets_it3' => $request->who_gets_it3,
                    'who_spends_it3' => $request->who_spents_it3,
                    'form_stage' => $request->form_stage
 
                ]);


                return Helpers::response($id, 200);

            
        }
        public function editStepSeven(Request $request){
            $id = $request->id;

   
                $profile = FarmerProfile::where('id', $id)->first();
                
                $profile->update([
                    'market_information' => $request->market_information,
                    'belongs_to_saving_group' => $request->belongs_to_saving_group,
                    'saving_group_name' => $request->saving_group_name,
                    'saving_group_type' => $request->saving_group_type,
                    'saving_group_name2' => $request->saving_group_name2,
                    'saving_group_type2' => $request->saving_group_type2,
                    'saving_group_name3' => $request->saving_group_name3,
                    'saving_group_type3' => $request->saving_group_type3,
                    'consultation' => $request->consultation,
                    'consultation_number' => $request->consultation_number,
                    'information_requested' =>$request->information_requested,
                    'required_training' => $request->required_training,
                    'form_stage' => $request->form_stage
          
                ]);


                return Helpers::response($id, 200);

            
        }
        public function saveHouseHoldDetails(Request $request)
        {
            
        $id = $request->id;

        if ($id) {

            $profile = FarmerProfile::where('email', $id)->first();
        
            if ($profile) {

            if ($request->form_stage == 2) {
        

                $profile->update([
                    'respondent_name' => $request->respondent_name,
                    'respondent_gender' => $request->respondents_gender,
                    'respondent_dob' => $request->respondents_date_of_birth,
                    'is_respondent_owner' => $request->is_respondent_owner_of_enterprise,
                    'dob_of_owner' => $request->enterprise_owner_date_of_birth,
                    'gender_of_owner' => $request->enterprise_owner_gender,
                    'marital_status_owner' => $request->enterprise_owner_marital_status,
                     'level_of_education_owner' => $request->enterprise_owner_education_level,
                     'type_of_house_owner' => $request->enterprise_owner_house_type,
                     'type_of_roofing' => $request->enterprise_owner_roofing_type,
                     'religion_of_owner' => $request->enterprise_owner_religion,
                     'registered_phone_owner' => $request->registered_phone,
                     'form_stage' => $request->form_stage


                ]);
            
            }
        
            }
            // return('success');

                return Helpers::response($id, 200);
            }

        }
        public function stepThree(Request $request)
        {
          
            $id = $request->id;

            if ($id) {

            $profile = FarmerProfile::where('email', $id)->first();
        
            if ($profile) {

            if ($request->form_stage == 3) {
        

                $profile->update([
                    'belongs_to_agricultural_group' => $request->agric_oriented_group,
                    'is_group_for_poiltry_farmers' => $request->is_poultry_farmers,
                    'benefits_of_group' => $request->benefits,
                    'why_not_in_group' => $request->why,
                    'form_stage' => $request->form_stage


                ]);
            
            }
        
            }
            // return('success');

                return Helpers::response($id, 200);
            }


            
        }
        public function stepFour(Request $request)
        {
          
            $id = $request->id;

            if ($id) {

            $profile = FarmerProfile::where('email', $id)->first();
        
            if ($profile) {

            if ($request->form_stage == 4) {
        

                $profile->update([
                    'when_started_egg_production' => $request->egg_production_date,
                    'type_of_birds_kept' => $request->type_of_birds,
                    'number_of_laying_birds' => $request->number_of_egg_laying_birds,
                    'main_source_of_feeds' => $request->source_of_feeds,
                    'source_of_birds' => $request->source_of_birds,
                    'is_source_good' => $request->source_of_birds_quality,
                    'source_of_birds2' => $request->source_of_birds_2,
                    'is_source_good2' => $request->source_of_birds_quality_2,
                    'source_of_birds3' => $request->source_of_birds_3,
                    'is_source_good3' => $request->source_of_birds_quality_3,
                    'how_many_annual_cycles' => $request->number_of_cycles,
                    'what_records_kept_at_farm' => $request->records_kept_on_the_farm,
                    'who_provides_labor' => $request->labour_provider,
                    'frequency_of_labor' => $request->labour_provider_frequency,
                    'who_provides_labor2' => $request->labour_provider_2,
                    'frequency_of_labor2' => $request->labour_provider_frequency_2,
                    'who_provides_labor3' => $request->labour_provider_3,
                    'frequency_of_labor3' => $request->labour_provider_frequency_3,
                    'major_challenges' => $request->challenges,
                    'solution_to_challenge'  => $request->solution,
                    'form_stage' => $request->form_stage



                ]);
            
            }
        
            }

                return Helpers::response($id, 200);
            }

         
        }
        public function stepFive(Request $request)
        {
          
            $id = $request->id;

            if ($id) {

            $profile = FarmerProfile::where('email', $id)->first();
        
            if ($profile) {

            if ($request->form_stage == 5) {
        

                $profile->update([
                    'daily_trays_number' => $request->trays_per_day,
                    'weekly_trays_number' => $request->trays_per_week,
                    'minimum_price_in_area' => $request->first_range,
                    'maximum_price_in_area' => $request->second_range,
                    'current_egg_market' => $request->current_market,
                    'form_stage' => $request->form_stage

                ]);
            
            }
        
            }

                return Helpers::response($id, 200);
            }

         
        }
        public function stepSix(Request $request)
        {
          
            $id = $request->id;

            if ($id) {

            $profile = FarmerProfile::where('email', $id)->first();
        
            if ($profile) {

            if ($request->form_stage == 6) {
        

                $profile->update([
                    'Select_income_source' => $request->income_source,
                    'do_you_get_money_from_source' => $request->is_income_generating,
                    'who_gets_it' => $request->who_gets_it,
                    'who_spends_it' => $request->who_spents_it,
                    'Select_income_source2' => $request->income_source2,
                    'do_you_get_money_from_source2' => $request->is_income_generating2,
                    'who_gets_it2' => $request->who_gets_it2,
                    'who_spends_it2' => $request->who_spents_it2,
                    'Select_income_source3' => $request->income_source3,
                    'do_you_get_money_from_source3' => $request->is_income_generating3,
                    'who_gets_it3' => $request->who_gets_it3,
                    'who_spends_it3' => $request->who_spents_it3,
                    'form_stage' => $request->form_stage
 
                ]);
            
            }
        
            }

                return Helpers::response($id, 200);
            }

         
        }
        public function stepSeven(Request $request)
        {
          
            $id = $request->id;

            if ($id) {

            $profile = FarmerProfile::where('email', $id)->first();
        
            if ($profile) {

            if ($request->form_stage == 7) {
        

                $profile->update([
                    'market_information' => $request->market_information,
                    'belongs_to_saving_group' => $request->belongs_to_saving_group,
                    'saving_group_name' => $request->saving_group_name,
                    'saving_group_type' => $request->saving_group_type,
                    'saving_group_name2' => $request->saving_group_name2,
                    'saving_group_type2' => $request->saving_group_type2,
                    'saving_group_name3' => $request->saving_group_name3,
                    'saving_group_type3' => $request->saving_group_type3,
                    'consultation' => $request->consultation,
                    'consultation_number' => $request->consultation_number,
                    'information_requested' =>$request->information_requested,
                    'required_training' => $request->required_training,
                    'form_stage' => $request->form_stage
          
                ]);
            
            }
      
        
            }

                return Helpers::response($id, 200);
            }

         
        }
        
        
                 }

            
   


