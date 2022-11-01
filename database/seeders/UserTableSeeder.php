<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        DB::table('user_roles')->truncate();


        $enum_role = Role::where('name', 'enum')->first();

        $admin_role = Role::where('name', 'admin')->first();

        $farmer_role = Role::where('name', 'farm')->first();
        $account_role = Role::where('name', 'account')->first();

        $agent_role = Role::where('name', 'agent')->first();



        //Seed admin
        $admin = new User();

        $admin->name = 'Admin';
        $admin->email = 'info@trailanalytics.com';
        $admin->password = bcrypt('@admin');
        $admin->save();
        $admin->roles()->attach($admin_role);

        //Seed enumermator 
        $user = new User();

        $user->name = 'Enumerator Test';
        $user->email = 'testing@gmail.com';
        $user->password = bcrypt('@enumerator');
        $user->save();
        $user->roles()->attach($enum_role);

        //Seed Farmers
        $farmer = new User();

        //farmer acoount setting

        $farmer->name = 'Farmer Test';
        $farmer->email = 'farmertest@gmail.com';
        $farmer->password = bcrypt('@farmer');
        $farmer->save();
        $farmer->roles()->attach($farmer_role);

        //Seed Account
        $account = new User();

        $account->name = 'Account Test';
        $account->email = 'accounttest@gmail.com';
        $account->password = bcrypt('@account');
        $account->save();
        $account->roles()->attach($account_role);

        //Seed Collection Agents
        $agent = new User();

        $agent->name = 'Agent Test';
        $agent->email = 'agenttest@gmail.com';
        $agent->password = bcrypt('@agent');
        $agent->save();
        $agent->roles()->attach($agent_role);
    }
}
