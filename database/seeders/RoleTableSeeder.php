<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert role for enumerators

        Role::truncate();

        $user = new Role();
        $user->name = 'enum';
        $user->description = 'A normal user in the application';
        $user->save();


        //insert role for super admins

        $admin = new Role();
        $admin->name = 'admin';
        $admin->description = 'A super administrator in the system';
        $admin->save();



        //insert role for farmers 

        $farmer = new Role();
        $farmer->name = 'farm';
        $farmer->description = 'A farmer in the system';
        $farmer->save();

        //insert role for Accounts

        $account = new Role();
        $account->name = 'account';
        $account->description = 'Acount  in the system';
        $account->save();

        //insert role for Agents

        $agent = new Role();
        $agent->name = 'agent';
        $agent->description = 'Agent in the system';
        $agent->save();

        $agent = new Role();
        $agent->name = 'egg_producer';
        $agent->description = 'Egg Producers in the system';
        $agent->save();
    }
}
