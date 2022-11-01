<?php

namespace App\Http\Requests\Profiling;

use App\Mail\AccountCreated;
use App\Models\EggProducerprofile;
use App\Models\EmailLog;
use App\Models\Role;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class createProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function save()
    {
        $formDetails = $this->formDetails;

        $id = $this->id;
        $form_stage = $this->form_stage;

        if ($id) {
            $profile = EggProducerprofile::find($id);
        
            if ($profile) {

                //check form stage and store its corresponding records

                if ($form_stage == 1) {

                    $profile->address = $formDetails;
                    $profile->form_stage = $form_stage;
                    $profile->save();

                    return Helpers::response($profile, 200);
                }

                //second stage save

                if ($form_stage == 2) {

                    $profile->house_hold_info = $formDetails;
                    $profile->form_stage = $form_stage;
                    $profile->save();

                    return Helpers::response($profile, 200);
                }


                if ($form_stage == 3) {

                    $profile->social_info = $formDetails;
                    $profile->form_stage = $form_stage;
                    $profile->save();

                    return Helpers::response($profile, 200);
                }


                if ($form_stage == 4) {

                    $profile->egg_production = $formDetails;
                    $profile->form_stage = $form_stage;
                    $profile->save();

                    return Helpers::response($profile, 200);
                }

                if ($form_stage == 5) {

                    $profile->marketing = $formDetails;
                    $profile->form_stage = $form_stage;
                    $profile->save();

                    return Helpers::response($profile, 200);
                }
                if ($form_stage == 6) {

                    $profile->household_income = $formDetails;
                    $profile->form_stage = $form_stage;
                    $profile->save();

                    return Helpers::response($profile, 200);
                }
                if ($form_stage == 7) {

                    $profile->savings = $formDetails;
                    $profile->form_stage = $form_stage;
                    $profile->save();

                    return Helpers::response($profile, 200);
                }
            }
        }


        


        $check = User::where('email', $this->email)->first();


        if ($check) {
            

            return Helpers::response('Account associated to the email exists', 405);
        }





        $role = Role::where('name', 'farm')->first();

        //generate a random password 

        //return Helpers::response($this, 200);

        $password = Helpers::randomPassword(8);
        $formDecode = json_decode($formDetails);

        //if role exists continue with creation of the related account 
        if ($role) {

            $user = User::create([
                'name' => $formDecode->names,
                'email' => $formDecode->email,
                'password' => bcrypt($password)
            ]);

            $user->password = $password;

            $user->roles()->attach($role);

            $profile = new EggProducerprofile();
            $profile->address = $formDetails;
            $profile->form_stage = 1;
            $profile->created_by = auth()->user()->id;
            $profile->save();

            $this->dispatchAccountCreatedEmail($user);

            return Helpers::response($profile, 200);
        }
    }



    private function dispatchAccountCreatedEmail($details)
    {



        $mail = new AccountCreated($details);

        try {
            $mail = new AccountCreated($details);

            EmailLog::create([
                'to' => $details->name . ' (' . $details->email . ')',
                'title' => 'Account Registered',
                'message' => $mail->render()
            ]);
            Mail::to($details->email)->send($mail);
        } catch (\Exception $ex) {
        }
    }
}
