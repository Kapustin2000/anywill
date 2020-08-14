<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Material of vase
        DB::table('services')->insert(
            [
                'name'=>'Material of vase',
                'entity_id' => \App\Models\Service::ENTITIES['cremation']
            ]
        );

        DB::table('services')->insert([
            [
                'name'=>'Sporcelain',
                'parent_id' => 1
            ],
            [
                'name'=>'Tree',
                'parent_id' => 1
            ],
            [
                'name'=>'Bronze',
                'parent_id' => 1
            ],
            [
                'name'=>'Stainless steel',
                'parent_id' => 1
            ],
            [
                'name'=>'Ceramics',
                'parent_id' => 1
            ],
            [
                'name'=>'Ceramics',
                'parent_id' => 1
            ],
            [
                'name'=>'Marble',
                'parent_id' => 1
            ]
        ]);


        //If to save a vase
        DB::table('services')->insert(
            [
                'name'=>'Save vase',
                'entity_id' => 3
            ]
        );

        DB::table('services')->insert([
            [
                'name'=>'Separate between members',
                'parent_id' => 9
            ],
            [
                'name'=>'Save at once',
                'parent_id' => 9
            ]
        ]);


    }
}
