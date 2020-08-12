<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
         $this->call(CremationSeeder::class); 
         $this->call(CemeterySeeder::class);
         $this->call(PlotSeeder::class); 
    }
}
