<?php
declare(strict_types=1);
namespace App\Console;

use App\Cron\Schedule;
use Phalcon\Config\Adapter\Yaml;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Di\FactoryDefault\Cli as CliDI;

/**
* 設定 cliDI
*/
class CliSetUp
{
    /**
    * @var \Phalcon\Di\FactoryDefault\Cli
    */
    protected $cliDI;

    /**
    * @var \Phalcon\Cli\Console
    */
    protected $console;

    /**
    * @var \App\Cron\Schedule
    */
    protected $schedule;

    /**
    * @var \Phalcon\Config\Adapter\Yaml
    */
    protected $config;

    /**
    * Cli Definition
    *
    * @param \Phalcon\Di\FactoryDefault\Cli $cliDI
    */
    public function __construct(CliDI $cliDI, ConsoleApp $console, Yaml $config)
    {
        $this->cliDI = $cliDI;
        $this->console = $console;
        $this->config = $config;
    }

    /**
    * 處理要使用的設定
    *
    * @return \App\Console\Command $command
    */
    public function handle()
    {
        $this->namespaceSetting();
        $this->cliDI->setShared('console', $this->console);
        $this->cronSetting();
        $this->console->setDI($this->cliDI);
        $command = $this->commandSetting();

        return $command;
    }

    /**
    * 定義 cliDI namespace
    *
    */
    protected function namespaceSetting()
    {
        $this->cliDI->get('dispatcher')->setDefaultNamespace('App\Console');
        $this->cliDI->get('dispatcher')->setDefaultNamespace('App\Cron');
        $this->cliDI->get('dispatcher')->setDefaultNamespace('App\Tasks');
    }

    /**
    * 載入排程
    */
    protected function scheduleSetting()
    {
        $this->schedule = new Schedule($this->cliDI);

        $scheduleFiles = glob(
            BASIC_PATH . $this->config->phalcon->dir->schedules . '*.php'
        );

        foreach ($scheduleFiles as $file) {
            include $file;
        }
    }

    /**
    * 定義 cron
    *
    */
    protected function cronSetting()
    {
        if (!$this->schedule) {
            $this->scheduleSetting();
        }
        $this->cliDI = $this->schedule->cron();
    }

    /**
    * 定義 command
    *
    * @return \App\Console\Command $command
    */
    protected function commandSetting()
    {
        $command = new Command($this->console);

        $ns = '\App\Tasks\\';
        $tasks = glob(
            BASIC_PATH . $this->config->phalcon->dir->tasks . '*Task.php'
        );

        foreach ($tasks as $task) {
            $name = basename($task, '.php');
            if ($name != 'BasicTask') {
                $className = $ns . $name;
                $command->setCommand(new $className());
            }
        }

        return $command;
    }
}
