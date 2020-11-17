<?php

use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class PermissionSeeder extends Seeder
{
    /**
     * @var Output
     */
    private $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();
        $this->output->writeln('<info>--- Permission Seeder Started ---</info>');
        $admin_role = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => '', // optional
            'level' => 1, // optional, set to 1 by default
        ]);

        $surveyor_role = Role::create([
            'name' => 'Surveyor',
            'slug' => 'surveyor',
        ]);
        
        $user = User::find(1);
        $user->attachRole($admin_role);
        \DB::commit();
    }
}
