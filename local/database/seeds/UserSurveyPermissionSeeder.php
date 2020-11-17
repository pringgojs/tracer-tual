<?php

use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;

class UserSurveyPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();

        $user = new User;
        $user->name = 'User Survey Teknik Informatika';
        $user->email = 'usersurvey.it@pens.ac.id';
        $user->password = bcrypt('secret');
        $user->save();
        
        $user_survey_role = Role::create([
            'name' => 'User Survey ',
            'slug' => 'user.survey',
        ]);
        
        $user->attachRole($user_survey_role);
        
        \DB::commit();
    }
}
