#!/usr/bin/env php
<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Cli\Console as ConsoleApp;

require dirname(__FILE__) . '/bootstrap/autoload.php';

try {
    // Using the CLI factory default services container
    $di = new CliDI();

    // Create a console application
    $console = new ConsoleApp();

    // Setting CLI and Console
    $cliDI = new \App\Console\CliSetUp($di, $console);
    $command = $cliDI->handle();

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
