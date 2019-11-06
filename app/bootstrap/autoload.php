<?php
declare(strict_types=1);
/*
  +------------------------------------------------------------------------+
  | Phalcon Cli                                                            |
  +------------------------------------------------------------------------+
*/
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Loader;

define('BASIC_PATH', realpath(dirname(dirname(dirname(__FILE__)))) . '/');

$config = new ConfigIni(BASIC_PATH . 'app/config/config.ini');

(new Loader)
    ->registerNamespaces([
        'App\Controllers' => BASIC_PATH . $config->phalcon->controllersDir,
        'App\Models'      => BASIC_PATH . $config->phalcon->modelsDir,
        'App\Console'     => BASIC_PATH . $config->phalcon->consoleDir,
        'App\Tasks'       => BASIC_PATH . $config->phalcon->tasksDir,
        'App\Cron'        => BASIC_PATH . $config->phalcon->cronDir,
    ])
    ->register();

/**
 * Register the Composer autoloader (if any)
 */
if (file_exists(BASIC_PATH . 'app/vendor/autoload.php')) {
    require_once BASIC_PATH . 'app/vendor/autoload.php';
}
