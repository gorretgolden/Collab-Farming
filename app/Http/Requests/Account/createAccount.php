<?php

namespace App\Http\Requests\Account;

use App\Mail\AccountCreated;
use App\Models\EmailLog;
use App\Models\Role;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class createAccount extends FormRequest
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


        //check if the email exists in the  system 

        $check = User::where('email', $this->email)->first();


        if ($check && !$this->id) {

            return Helpers::response('Account associated to the email exists', 405);
        }

        //if qequst has id then edit the user account 
        if ($this->id) {
            $user = User::find($this->id);
            if ($user) {
                $user->name = $this->name;
                $user->email = $this->email;
                $user->save();
            }

            return Helpers::response(true, 200);
        } else {
            //create a new user account 

            $role = Role::where('name', $this->type)->first();

            //generate a random password 

            //return Helpers::response($this, 200);

            $password = Helpers::randomPassword(8);

            //if role exists continue with creation of the related account 
            if ($role) {

                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => bcrypt($password)
                ]);
                $user->password = $password;
                $user->roles()->attach($role);

                $this->dispatchAccountCreatedEmail($user);
            }

            return Helpers::response(true, 200);
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
