<?php

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceOptions;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $service = Service::create(['name' => 'Material of vase', 'entity_id' => 2, 'input_type_id' => 1]);

        $service->options()->saveMany(
            [
                new ServiceOptions(['name' => 'Tree']),
                new ServiceOptions(['name' => 'Bronze'])
            ]
        );
        
    }
}
