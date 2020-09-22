<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement("SET foreign_key_checks=0");
//        Permission::truncate();
//        DB::statement("SET foreign_key_checks=1");
//        
//        $permissions = [
//            'all',
//            'upload_media',
//            'delete_media'
//        ];
//        
//        foreach(config('entities') as $entity) {
//            array_push($permissions,  'create_'.$entity);
//            array_push($permissions,  'update_'.$entity);
//            array_push($permissions,  'delete_'.$entity); 
//        }
//        
//        foreach ($permissions as $permission) {
//            Permission::create(['name' => $permission]);
//        }
    }
}
