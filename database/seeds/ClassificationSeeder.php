<?php

use Illuminate\Database\Seeder;
use App\Models\Classification;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classification::insert(
            [
                ['name'=>'All'],
                ['name'=>'Christ']
            ]
        );
    }
}
