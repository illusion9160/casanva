#!/usr/bin/env php
<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Cli\Console as ConsoleApp;

require dirname(__FILE__) . '/bootstrap/autoload.php';

// Using the CLI factory default services container
$di = new CliDI();
$di->get('dispatcher')->setDefaultNamespace('App\Console');
$di->get('dispatcher')->setDefaultNamespace('App\Tasks');

// Create a console application
$console = new ConsoleApp();
$console->setDI($di);

$command = new \App\Console\Command($console);

$tasks = glob(BASIC_PATH . 'app/tasks/*Task.php');
$ns = '\App\Tasks\\';

foreach ($tasks as $task) {
    $name = basename($task, '.php');
    if ($name != 'BasicTask') {
        $className = $ns . $name;
        $command->setCommand(new $className());
    }
}

try {
    // execute command
    $command->run();
} catch (\Phalcon\Exception $e) {
    // Do Phalcon related stuff here
    // ..
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
} catch (\Throwable $throwable) {
    fwrite(STDERR, $throwable->getMessage() . PHP_EOL);
    exit(1);
} catch (\Exception $exception) {
    fwrite(STDERR, $exception->getMessage() . PHP_EOL);
    exit(1);
}
