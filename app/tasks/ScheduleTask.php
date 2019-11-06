<?php
declare(strict_types=1);

namespace App\Tasks;

use Exception;

/**
* Schedule 任務類別 (排程)
*
*/
class ScheduleTask extends BasicTask
{
    /**
    * schedule 主要入口
    *
    * @param array $params
    */
    public function mainAction(array $params)
    {
        /**
        * 若需訪問 cron 輸出可使用 ->runInForeground()
        * ->runInBackground() 返回 Process instances.陣列
        * ->runInForeground() 返回 輸出陣列
        */
        $this->cron->runInBackground();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [];
    }

    /**
     * Returns the command identifier.
     *
     * @return array
     */
    public function getCommands()
    {
        return ['schedule'];
    }

    /**
     * Prints help on the usage of the command.
     *
     * @return void
     */
    public function getHelp()
    {
        print('Help:') . PHP_EOL;
        print('  run schedule') . PHP_EOL . PHP_EOL;

        print('Usage:') . PHP_EOL;
        print('  schedule ') . PHP_EOL . PHP_EOL;
    }

    /**
     * Return required parameters.
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 0;
    }
}
