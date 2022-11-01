<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\createAccount;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Traits\Helpers;

use Illuminate\Support\Facades\DB;

class UserAccountApi extends Controller
{
    //create user account
    public function createAccount(createAccount $request)
    {
        return $request->save($request);
    }

    //deleting a user 

    public function DeleteUser($id)
    {
        $user = User::find($id);


        // return Helpers::response(true, 200);


        if ($user) {
            DB::table('user_roles')->where('user_id', $id)->delete();

            $user->delete();

            return Helpers::response(true, 200);
        }
    }
    //get collectors
    public function getCollectors(){
        $user_details = UserRole::with('user')->Where('role_id','5')->get();
        return $user_details;

    }

    //get added user accounts
    public function getUsers()
    {

        $users = User::orderBy('id', 'desc')
            ->get();

        $admin = [];
        $enum = [];
        $farmer = [];
        $agent = [];
        $account = [];

        foreach ($users as $c) {

            //get the user permission and relate  to where the user exists

            $permData = Role::join('user_roles', 'user_roles.role_id', '=', 'roles.id')

                ->where('user_roles.user_id', $c->id)->first();

            if ($permData) {

                //Add the users according to there respective account type
                if ($permData->name == 'admin') {
                    array_push($admin, $c);
                }
                if ($permData->name == 'enum') {
                    array_push($enum, $c);
                }
                if ($permData->name == 'farm') {
                    array_push($farmer, $c);
                }
                if ($permData->name == 'account') {
                    array_push($account, $c);
                }
                if ($permData->name == 'agent') {
                    array_push($agent, $c);
                }
            }
        }

        $object = (object) array(
            'admin' => $admin,
            'enum' => $enum,
            'farmer' => $farmer,
            'account' => $account,
            'agent' => $agent
        );

        return Helpers::response($object, 200);
    }
}
