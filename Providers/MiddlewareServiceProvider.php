<?php

namespace Modules\PortalApi\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Modules\PortalApi\Http\Middleware\AuthenticateOnceWithBasicAuth;

class MiddlewareServiceProvider extends ServiceProvider {

    //protected $defer = true;
 
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router) {
        $router->aliasMiddleware('auth.basic.once.api', AuthenticateOnceWithBasicAuth::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {   
    }

}