<?php

use Illuminate\Database\Seeder;

class PlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Plot::class, 1)->create();
    }
}
