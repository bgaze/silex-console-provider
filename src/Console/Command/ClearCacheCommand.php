<?php

namespace Bgaze\Silex\Console\Command;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCacheCommand extends AbstractCommand {

    public function isEnabled() {
        $app = $this->getSilexApplication();

        if (!$app->offsetExists('cache_dir') || !is_dir($app['cache_dir'])) {
            return false;
        }

        return parent::isEnabled();
    }

    protected function configure() {
        $this->setName('cache:clear')->setDescription('Clears application cache.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $app = $this->getSilexApplication();

        $output->writeln(sprintf('Clearing <comment>%s</comment>', realpath($app['cache_dir'])));

        // Find cache files that doesn't start with a dot.
        $dir = new \RecursiveDirectoryIterator($app['cache_dir'], \FilesystemIterator::SKIP_DOTS);
        $filter = new \RecursiveCallbackFilterIterator($dir, function ($current, $key, $iterator) {
            return !preg_match('/^\./', $current->getFilename());
        });
        $iterator = new \RecursiveIteratorIterator($filter, \RecursiveIteratorIterator::CHILD_FIRST);

        // If files, remove them.
        if (iterator_count($iterator) > 0) {
            $fs = new Filesystem();
            $fs->remove($iterator);
            $output->writeln('Cache cleared!');
        } else {
            $output->writeln('Nothing to clear!');
        }
    }

}
