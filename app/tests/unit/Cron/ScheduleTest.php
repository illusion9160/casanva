<?php
declare(strict_types=1);
namespace Test\Unit\Cron;

use App\Cron\Job;
use App\Cron\Schedule;
use Phalcon\Di\FactoryDefault\Cli;

/**
* 測試排程定義類別
*/
class ScheduleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
    * @var \App\Cron\Schedule
    */
    protected $schedule;

    protected function _before()
    {
        $this->schedule = new Schedule(new Cli);
    }

    protected function _after()
    {
    }

    /**
    * 測試 cron method
    */
    public function testCron()
    {
        $expected = Cli::class;
        $actual = $this->schedule->cron();

        $this->assertInstanceOf($expected, $actual);
    }

    /**
    * 測試 call method
    */
    public function testCall()
    {
        $expected = Job::class;

        $actual = $this->schedule->call(function () {
            return 'unit test';
        });

        $this->assertInstanceOf($expected, $actual);
    }

    /**
    * 測試 command method
    */
    public function testCommand()
    {
        $expected = Job::class;

        $actual = $this->schedule->command('help', ['unit test']);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
    * 測試 exec method
    */
    public function testExec()
    {
        $expected = Job::class;

        $actual = $this->schedule->command('ls -al');

        $this->assertInstanceOf($expected, $actual);
    }
}