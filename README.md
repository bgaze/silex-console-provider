# bgaze/silex-console-provider

Provides for Silex :

* a handy way to create custom console commands. 
* clear cache command : `$ php bin/console cache:clear`.

Please check [Console component documentation][1] for more details about how to use console and build commands.

## Installation

Import the provider with Composer:

```
$ composer require bgaze/silex-console-provider dev-master
```

Clear cache commands requires cache path to be defined under `cache_dir` key :

```php
    $app['cache_dir'] = __DIR__ . '/../var/cache';
```

Then register it in your app :

```php
use Bgaze\Silex\Provider\ConsoleServiceProvider;
$app->register(new ConsoleServiceProvider(), ['console.name' => 'My Application', 'console.version' => 'n/a']);
$app['console']->add(new \Bgaze\Silex\Console\Command\ClearCacheCommand());
```

## Usage

Assuming your console executable is `bin/console`, call any of command like this :

```
$ php bin/console your:command
```

Clear your application cache like this :

```
$ php bin/console cache:clear
```
    
## Write commands

Your commands should extend `Bgaze\Silex\Console\Command\AbstractCommand`.  
This base class provide acces to the current Silex application under `$app` protected attribute.

Here is a custom command example :

```php
<?php

namespace MyApp\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Bgaze\Silex\Console\Command\AbstractCommand;

class MyCommand extends AbstractCommand {

    public function isEnabled() {
        if (!isset($this->app['my_value'])) {
            return false;
        }

        return parent::isEnabled();
    }

    protected function configure() {
        $this
                ->setName('my:command')
                ->setDefinition([
                    new InputArgument('foo', InputArgument::REQUIRED, 'A required argument'),
                    new InputOption('bar', 'b', InputOption::VALUE_REQUIRED, 'An option with default value', 'Bar!')
                ])
                ->setDescription('This is a demo command ...');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $foo = $input->getArgument('foo');
        $output->writeln('Foo : ' . $foo);

        $bar = $input->getOption('bar');
        $output->writeln('Bar : ' . $bar);
    }

}
```

## Credits

This provider is heavily inspired from [codito/silex-console-provider][2]

[1]: http://symfony.com/doc/current/components/console/introduction.html
[2]: https://github.com/CoditoNet/silex-console-provider