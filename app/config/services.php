<?php
declare(strict_types=1);
/**
* set di
*/
use Phalcon\Config;
use Phalcon\Db\Adapter\Pdo\MySql;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Dispatcher;

$di = new FactoryDefault();

$di->set(
    'dispatcher',
    function () {
        $dispatcher = new Dispatcher();

        $dispatcher->setDefaultNamespace('App\Controllers');
        $dispatcher->setDefaultNamespace('App\Models');

        return $dispatcher;
    }
);

$di->set(
    'db',
    function () use ($config) {
        return new MySql($config->database->toArray());
    }
);
