<?php

namespace Bgaze\Silex\Console\Command;

use Silex\Application;
use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Command base class.
 *
 */
abstract class AbstractCommand extends BaseCommand {

    protected $app;

    public function __construct() {
        /* @var $app SilexApplication */
        $this->app = $this->getApplication()->getSilexApplication();
    }

}
