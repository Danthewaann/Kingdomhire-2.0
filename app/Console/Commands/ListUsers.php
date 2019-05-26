<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users in database';

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
        $users = User::all();
        if($users->isNotEmpty()) {
            foreach($users as $user) {
                echo "Name: " . $user->name . " Email: " . $user->email . "\n";
            }
        }
        else {
            echo "No users exist!\n";
        }
    }
}
