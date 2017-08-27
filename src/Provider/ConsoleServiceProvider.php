<?php

namespace Bgaze\Silex\Provider;

use Bgaze\Silex\Console\Application as ConsoleApplication;
use Bgaze\Silex\Console\Helper\DescriptorHelper;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;

/**
 * ConsoleServiceProvider
 *
 */
class ConsoleServiceProvider implements ServiceProviderInterface, BootableProviderInterface {

    /**
     * Registers service in Silex application
     * 
     * @param Application $app
     */
    public function register(Container $app) {
        $app['console'] = function() use ($app) {
            return new ConsoleApplication($app, $app['console.name'], $app['console.version']);
        };
    }

    /**
     * Boots console service when all services were registered and main app boots up.
     * 
     * @param Application $app
     */
    public function boot(Application $app) {
        
    }

}
