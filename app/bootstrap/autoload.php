<?php
declare(strict_types=1);
/*
  +------------------------------------------------------------------------+
  | Phalcon Cli                                                            |
  +------------------------------------------------------------------------+
*/

use Phalcon\Loader;

define('BASIC_PATH', realpath(dirname(dirname(dirname(__FILE__)))) . '/');

(new Loader)
    ->registerNamespaces([
        'App\Controllers' => BASIC_PATH . 'app/controllers/',
        'App\Models'      => BASIC_PATH . 'app/models/',
        'App\Console'     => BASIC_PATH . 'app/console/',
        'App\Tasks'       => BASIC_PATH . 'app/tasks/',
    ])
    ->register();

/**
 * Register the Composer autoloader (if any)
 */
if (file_exists(BASIC_PATH . 'vendor/autoload.php')) {
    require_once BASIC_PATH . 'vendor/autoload.php';
}
