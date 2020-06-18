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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $headers = ['Name', 'Email', 'Receives Email'];
        $users = User::all(['name', 'email', 'receives_email'])->toArray();

        if(count($users) < 1) {
            $this->error("No users exist!");
        }
        else {
            $this->table($headers, $users);
        }
    }
}
