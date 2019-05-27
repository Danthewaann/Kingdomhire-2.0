<?php

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

callCronJob('scheduler:reservations-to-hires');
callCronJob('scheduler:active-to-inactive-hires');
echo "Done...";