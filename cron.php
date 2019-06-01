<?php

// This file acts as a cron job for certain HTTP GET cron job managers
// call `php artisan cron:setup-cron-file` to move this file to
// `public/cron`, so it can be accessed by HTTP requests.
// It is advisable to set `public/cron` to a protected directory 
// if you are using a web hosting service as well

require __DIR__.'/../../vendor/autoload.php';

$app = require_once __DIR__.'/../../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

function callCronJob($jobName) {
    Artisan::call($jobName);
    $output = explode("\n", Artisan::output());
    if(count($output) > 0 && !empty($output[0])) {
        foreach($output as $line) {
            echo $line . "<br>";
        }
    }
}

// Run scheduler commands as if they were cron jobs
callCronJob('scheduler:reservations-to-hires');
callCronJob('scheduler:active-to-inactive-hires');
echo "Done...";