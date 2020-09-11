<?php

use Illuminate\Database\Seeder;

class CremationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Cremation::class, 100)->create();
    }
}
