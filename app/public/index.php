<?php
declare(strict_types=1);

use Phalcon\Mvc\Micro;

try {
    define('APP_PATH', realpath(dirname(dirname(__FILE__))) . '/');
    require APP_PATH . 'bootstrap/autoload.php';
    require APP_PATH . 'config/services.php';

    $app = new Micro();
    $app->setDI($di);

    $app->get(
        '/',
        function () {
            echo 'Home';
        }
    );

    $app->get(
        '/error',
        function () {
           echo 'error';
        }
    );

    $app->get(
        '/user',
        function () {
            $users = \App\Models\Users::find();
            foreach ($users as $user) {
                echo $user->name, '<br>';
            }
        }
    );

    $app->handle();
} catch (\Exception $e) {
    var_dump($e);
}
