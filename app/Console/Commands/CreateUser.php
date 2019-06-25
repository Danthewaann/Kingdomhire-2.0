<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create 
                            {--t|test : Create a user for testing purposes } 
                            {name? : User name} 
                            {email? : User email e.g. test@test.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user (name + email with password prompt)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = new User();
        $test_option = $this->option('test');
        $test_name = 'test';
        $test_password = 'test123';
        $test_email = 'test@test.com';

        $name_option = $this->argument('name');
        $email_option = $this->argument('email');
        $password = null;
        $has_error = false;
        
        if ($test_option) {
            $user->name = $test_name;
            $user->password = $test_password;
            $user->email = $test_email;
        }
        else {
            if (empty($name_option) || empty($email_option)) {
                $this->error('Need to provide a name and email!');
                $has_error = true;
            }
            else {
                $password = $this->secret('Enter password');
                $user->name = $name_option;
                $user->password = Hash::make($password);
                $user->email = $email_option;
            }
        }
        if (!$has_error) {
            try {
                $user->save();

                $this->info("Successfully created user!");
                if ($test_option) {
                    $this->info("User name: " . $user->name);
                    $this->info("User password: " . $test_password);
                    $this->info("User email: " . $user->email);
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                $this->error("Failed to create user!\n");
                $this->error($exception->getMessage());
            }
        }
    }
}
