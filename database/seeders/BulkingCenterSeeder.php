<?php

namespace Database\Seeders;

use App\Models\BulkingCenter;
use Illuminate\Database\Seeder;

class BulkingCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Seed admin
         $admin = new BulkingCenter();

         $admin->name = 'Pristine Eggs Main Factory';
         $admin->address = 'Plot 2173, Block, 230 Kamuli - Kilule Rd, Kampala';
         $admin->save();
    }
}
