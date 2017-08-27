<?php

namespace Bgaze\Silex\Console\Command;

use Silex\Application;
use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Command base class.
 *
 */
abstract class AbstractCommand extends BaseCommand {

    /**
     * Returns main Silex application in which console service is registered
     * 
     * @return Application
     */
    public function getSilexApplication() {
        return $this->getApplication()->getSilexApplication();
    }

}
