<?php
declare(strict_types=1);
/*
  +------------------------------------------------------------------------+
  | Phalcon Cli                                                            |
  +------------------------------------------------------------------------+
*/
use Phalcon\Config\Adapter\Yaml;
use Phalcon\Loader;

define('BASIC_PATH', realpath(dirname(dirname(dirname(__FILE__)))) . '/');

$config = new Yaml(BASIC_PATH . 'app/.env.yml');

(new Loader)
    ->registerNamespaces([
        'App\Controllers' => BASIC_PATH . $config->phalcon->dir->controllers,
        'App\Models'      => BASIC_PATH . $config->phalcon->dir->models,
        'App\Console'     => BASIC_PATH . $config->phalcon->dir->console,
        'App\Tasks'       => BASIC_PATH . $config->phalcon->dir->tasks,
        'App\Cron'        => BASIC_PATH . $config->phalcon->dir->cron,
    ])
    ->register();

/**
 * Register the Composer autoloader (if any)
 */
if (file_exists(BASIC_PATH . 'app/vendor/autoload.php')) {
    require_once BASIC_PATH . 'app/vendor/autoload.php';
}
