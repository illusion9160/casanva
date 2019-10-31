<?php

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
        return new MySql([
            'host'     => 'rg_mariadb',
            'username' => 'root',
            'password' => 'password',
            'dbname'   => 'demo',
            'charset'  => 'utf8',
        ]);
    }
);
