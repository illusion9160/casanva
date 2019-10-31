<?php
declare(strict_types=1);
/*
  +------------------------------------------------------------------------+
  | Phalcon Command Tools                                                  |
  +------------------------------------------------------------------------+
*/

namespace App\Console;

use App\Tasks\BasicTask;
use Phalcon\Cli\Console as CliConsole;

/**
* command 入口
*
*/
class Command
{
    const HELP_TAG = 'help';

    /**
     * CLI factory default services container
     *
     * @var \Phalcon\Cli\Console
     */
    protected $console;

    /**
     * Tasks attached to the Script
     *
     * @var \App\Tasks\Tasks[]
     */
    protected $commands;

    /**
     * Script Constructor
     *
     * @param \Phalcon\Events\Manager $eventsManager
     */
    public function __construct(CliConsole $console)
    {
        $this->console = $console;
    }

    /**
     * Script Constructor
     *
     * @param \Phalcon\Events\Manager $eventsManager
     */
    public function setCommand(BasicTask $task)
    {
        $this->commands[] = $task;
    }

    public function getCommands()
    {
        return $this->commands;
    }

    public function run()
    {
        if (!isset($_SERVER['argv'][1])) {
            $_SERVER['argv'][1] = self::HELP_TAG;
        }

        $input = $_SERVER['argv'][1];

        if (in_array(strtolower(trim($input)), ['-h', '--help', 'help'], true)) {
            $input = $_SERVER['argv'][1] = self::HELP_TAG;
        }

        $taskName = '\App\Tasks\\' . trim(ucfirst($input)) . 'Task';
        if (!class_exists($taskName) || trim(strtolower($input)) == 'basic') {
            throw new \Exception('Error: ' . $input . ' is not a recognized command.');
        }

        $task = new $taskName();
        if (!in_array(new $task, $this->commands)) {
            throw new \Exception('Error: ' . $input . ' is not a recognized command.');
        }

        if (!isset($_SERVER['argv'][2]) && $input !== self::HELP_TAG) {
            $task->getHelp();
            exit;
        }

        $count = count($_SERVER['argv']);
        $params = [];
        if (isset($_SERVER['argv'][2])) {
            for ($i = 2; $i < $count; $i++) {
                if(in_array(strtolower(trim($_SERVER['argv'][$i])), ['-h', '--help', 'help'], true)) {
                    $task->getHelp();
                    exit;
                }
                $params[] = trim($_SERVER['argv'][$i]);
            }
        }

        if ($input === self::HELP_TAG) {
            $params = $this->commands;
        }

        $arguments = [];
        $arguments['task'] = $input;
        $arguments['params'] = $params;

        $this->console->handle($arguments);
    }
}
