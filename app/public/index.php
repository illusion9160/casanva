<?php
declare(strict_types=1);

use Phalcon\Mvc\Micro;

try {
    define('APP_PATH', realpath(dirname(dirname(__FILE__))) . '/');
    require APP_PATH . 'bootstrap/autoload.php';
    require APP_PATH . 'config/services.php';

    $app = new Micro();
    $app->setDI($di);

    require APP_PATH . 'routes/web.php';

    $app->handle();
} catch (\Exception $e) {
    var_dump($e);
}
