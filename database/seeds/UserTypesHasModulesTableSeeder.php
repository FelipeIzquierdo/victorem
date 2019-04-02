<?php 

use \Illuminate\Database\Seeder;

class UserTypesHasModulesTableSeeder extends Seeder
{
    public function run()
    {
        $superAdmin = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15, 16, 17, 18];

        foreach ($superAdmin as $module_id) {
            DB::table('user_types_has_modules')->insert(array(
                'user_type_id' => 1,
                'module_id'   => $module_id,
            ));
        }

        DB::table('user_types_has_modules')->insert(array(
            'user_type_id' => 2,
            'module_id'   => 1,
        ));

        DB::table('user_types_has_modules')->insert(array(
            'user_type_id' => 2,
            'module_id'   => 2,
        ));

        DB::table('user_types_has_modules')->insert(array(
            'user_type_id' => 2,
            'module_id'   => 3,
        ));

        DB::table('user_types_has_modules')->insert(array(
            'user_type_id' => 2,
            'module_id'   => 4,
        ));

        DB::table('user_types_has_modules')->insert(array(
            'user_type_id' => 3,
            'module_id'   => 1,
        ));

        DB::table('user_types_has_modules')->insert(array(
            'user_type_id' => 3,
            'module_id'   => 2,
        ));
    	
    }
}

?>