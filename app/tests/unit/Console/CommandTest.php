<?php 
declare(strict_types=1);
namespace Test\Unit\Console;

use App\Console\Command;
use Phalcon\Cli\Console as CliConsole;

/**
* 測試 Command
*/
class CommandTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
    * @var \App\Console\Command
    */
    protected $command;

    protected function _before()
    {
        $this->tasks = [
            '\App\Tasks\PlayTask',
            '\App\Tasks\HelpTask',
            '\App\Tasks\ScheduleTask'
        ];

        $this->command = new Command(new CliConsole());
    }

    protected function _after()
    {
    }

    /**
    * 測試設置 Command (Task)
    */
    public function testSetCommand()
    {
        $key = array_rand($this->tasks);
        $task = $this->tasks[$key];

        $this->command->setCommand(new $task());
    }

    /**
    * 測試取得 Command (Task)
    */
    public function testGetCommands()
    {
        $key = array_rand($this->tasks);
        $task = new $this->tasks[$key]();

        $this->command->setCommand($task);

        $expected = [$task];
        $actual = $this->command->getCommands();

        $this->assertEquals($expected, $actual);
    }
}