<?php
declare(strict_types=1);
namespace Test\Unit\Console;

use App\Console\CliSetUp;
use Phalcon\Config\Adapter\Yaml;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Di\FactoryDefault\Cli as CliDI;

/**
* 測試 CliSetUp
*/
class CliSetUpTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
    * \App\Console\CliSetUp
    */
    protected $cliSetUp;

    protected function _before()
    {
        $this->cliSetUp = new CliSetUp(
            new CliDI(),
            new ConsoleApp(),
            new Yaml('.env.yml')
        );
    }

    protected function _after()
    {
    }

    /**
    * 測試 handle 回傳陣列裡的 class 是否屬於 BasicTask
    */
    public function testHandle()
    {
        $expected = \App\Tasks\BasicTask::class;
        $actuals = $this->cliSetUp->handle();

        foreach ($actuals as $actual) {
            $this->assertInstanceOf($expected, $actual);
        }
    }
}