<?php

use Illuminate\Database\Seeder;

class FuneralHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\FuneralHome::class, 100)->create();
    }
}
