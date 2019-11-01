<?php
declare(strict_types=1);
/**
* set di
*/
use Phalcon\Config;
use Phalcon\Config\Adapter\Ini as ConfigIni;
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
    function () {
        $config = new ConfigIni(BASIC_PATH . 'app/config/config.ini');
        return new MySql($config->database->toArray());
    }
);
