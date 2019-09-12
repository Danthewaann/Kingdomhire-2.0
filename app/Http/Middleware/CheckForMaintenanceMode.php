<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as MaintenanceMode;

class CheckForMaintenanceMode
{
    /**
     * Reference to the application instance.
     *
     * @var Application
     */
    protected $app;
    
    /**
     * Accessible paths in maintenance mode.
     *
     * @var array
     */
    private $acceptedPaths = [
        '\/login',
        '\/logout',
        '\/password\/*',
        '\/admin\/*'
    ];

    /**
     * Create a CheckForMaintenanceMode instance.
     *
     * @param Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->app->isDownForMaintenance()) {
            $requestPath = $request->getPathInfo();
            $requestAcceptable = false;
            foreach ($this->acceptedPaths as $path) {
                if (preg_match('/' . $path . '/', $requestPath) == 1) {
                    $requestAcceptable = true;
                    break;
                }
            }

            if (!$requestAcceptable)
            {
                $maintenanceMode = new MaintenanceMode($this->app);
                return $maintenanceMode->handle($request, $next);
            }
        }

        return $next($request);
    }

}