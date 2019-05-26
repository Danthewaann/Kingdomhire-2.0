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
    protected $signature = 'user:create {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user (name, email and password)';

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
        try {
            echo "User password: ";
            system('stty -echo');
            $password = rtrim(fgets(STDIN));
            system('stty echo');
            User::create([
                'name' => $this->argument('name'),
                'email' => $this->argument('email'),
                'password' => Hash::make($password)
            ]);
            echo "Successfully created user!\n";
        } catch (\Illuminate\Database\QueryException $exception) { 
            echo "Failed to create user!\n";
            echo $exception->getMessage() . "\n";
        }
    }
}
