<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupCronFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:setup-cron-file {--override}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates /cron/cron.php in /public directory';

    protected $cronFile = __DIR__.'/../../../cron.php';
    protected $dir = __DIR__.'/../../../public/cron';
    protected $target = __DIR__.'/../../../public/cron/cron.php';

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
        if(!file_exists($this->dir)) {
            $this->createCronFile();
        }
        else {
            if($this->option('override')) {
                $files = glob($this->dir.'/*');
                foreach($files as $file) { 
                    if(is_file($file))
                        unlink($file); 
                    }

                rmdir($this->dir);
                $this->createCronFile();
            }
            else {
                $this->error('public/cron directory already exists!');
                $this->error('Provide --override to override it');
            }
        }
    }

    private function createCronFile()
    {
        if(!mkdir($this->dir)) {
            $this->error('Failed to create public/cron directory!');
        }
        else {
            if(!copy($this->cronFile, $this->target)) {
                $this->error('Failed to create public/cron/cron.php!');
            }
            else {
                $this->info('Successfully created public/cron/cron.php!');
            }
        }
    }
}
