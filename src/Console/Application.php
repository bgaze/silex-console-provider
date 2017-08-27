<?php

namespace Bgaze\Silex\Console;

use Silex\Application as SilexApplication;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Application
 *
 */
class Application extends BaseApplication {

    /**
     * @var SilexApplication
     */
    private $app;

    /**
     * Constructor.
     * 
     * @param SilexApplication $application
     * @param string $name
     * @param string $version
     */
    public function __construct(SilexApplication $application, $name = 'UNKNOWN', $version = 'UNKNOWN') {
        parent::__construct($name, $version);

        $this->app = $application;
    }

    /**
     * Returns main Silex application in which console service is registered
     * 
     * @return SilexApplication
     */
    public function getSilexApplication() {
        return $this->app;
    }

    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null) {
        $this->app->boot();

        parent::run($input, $output);
    }

}
