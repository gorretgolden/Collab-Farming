<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AuthControllerAPI extends Controller
{
    //
    // 
    public function login(Request $request)
    {
        //production url pointing  (Use this in production environment by uncommenting and commenting out the development  url below )
        $url = env('APP_URL') . '/oauth/token';

        //local environment url(Use this in development environment )
        // $url = 'http://127.0.0.1:8001/oauth/token';

        // $url = 'http://127.0.0.1:8001/oauth/token';

        $response =  Http::post($url, [
            'grant_type' => 'password',
            'client_id' => env('client_id'),
            'client_secret' => env('client_secret'),
            'username' => $request->username,
            'password' => $request->password,
        ]);

        //check if the response is succesful
        if ($response->successful()) {
            return $response;
        }

        if ($response->failed()) {
            return Helpers::response($response, 401);
        }
    }


    public function logOut(Request $request)
    {
        $accessToken = auth()->user()->token();

        $token_check = $request->user()->tokens->find($accessToken);

        $token_check->revoke();
        $token_check->delete();

        return Helpers::response('Logged Out Successfull', 200);
    }


    public function getUserDetails()
    {
        $user = User::find(auth()->user()->id);
        $roleArray = [];

        $permData = Role::join('user_roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('user_roles.user_id', $user->id)
            ->get();

        foreach ($permData as $c) {

            $role = Role::find($c->role_id);

            if ($role) {
                array_push($roleArray, $role->name);
            }
        }
        $user->roleArray = $roleArray;

        // return response()->json(['user' => $user->roles]);
        return Helpers::response($user, 200);
    }
}
