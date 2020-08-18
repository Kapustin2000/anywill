<?php

use Illuminate\Database\Seeder;
use App\Models\PlotTypes;

class PlotTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlotTypes::insert(
            [
                [
                    'name'=>'A place on the lawn'
                ],
                [
                    'name'=>'A crypt in the mausoleum'
                ],
                [
                    'name'=>'A site for ashes after cremation'
                ],
                [
                    'name'=>'A cremation niche'
                ]
            ]
        );
    }
}
