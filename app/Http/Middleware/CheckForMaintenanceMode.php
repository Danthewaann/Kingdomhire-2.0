<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as MaintenanceMode;

class CheckForMaintenanceMode {

    protected $app;
    private $acceptedPaths = [
        '\/login',
        '\/logout',
        '\/password\/*',
        '\/admin\/*'
    ];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(Request $request, Closure $next)
    {
        $requestPath = $request->getPathInfo();
        $requestAcceptable = false;
        foreach ($this->acceptedPaths as $path) {
            if (preg_match('/' . $path . '/', $requestPath) == 1) {
                $requestAcceptable = true;
                break;
            }
        }

        if ($this->app->isDownForMaintenance() && !$requestAcceptable)
        {
            $maintenanceMode = new MaintenanceMode($this->app);
            return $maintenanceMode->handle($request, $next);
        }

        return $next($request);
    }

}