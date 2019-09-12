<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a user (email)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        if(is_null($user)) {
            $this->error("No user exists with provided email!");
        }
        else {
            $user->delete();
            $this->info("Successfully deleted user with email: ".$this->argument('email'));
        }
    }
}
