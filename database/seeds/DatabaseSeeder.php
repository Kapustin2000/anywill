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
        $this->call(CemeterySeeder::class);
        $this->call(CremationSeeder::class);
        $this->call(PlotTypesSeeder::class);
        $this->call(PlotSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ClassificationSeeder::class);
    }
}
