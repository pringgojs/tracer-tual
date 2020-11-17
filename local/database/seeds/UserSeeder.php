<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class UserSeeder extends Seeder
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
        $this->output->writeln('<info>--- User Seeder Started ---</info>');
        //DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'name' => 'system',
            'email' => 'tracer@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        $this->output->writeln('<info>--- User Seeder Finished ---</info>');

    }
}