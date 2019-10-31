<?php
declare(strict_types=1);

namespace App\Tasks;

use Exception;

/**
* Help List 任務類別
*
*/
class HelpTask extends BasicTask
{
    const COMMAND_COLUMN_LEN = 16;

    /**
    * cli 執行主要入口
    *
    * @param array $params
    */
    public function mainAction(array $params)
    {
        print ('Available commands:') . PHP_EOL;
        foreach ($params as $task) {
            $providedCommands = $task->getCommands();
            $commandLen = strlen($providedCommands[0]);
            print($providedCommands[0]);
            if (count($providedCommands)) {
                $spacer = str_repeat(' ', self::COMMAND_COLUMN_LEN - $commandLen);
                print $spacer.' (alias of: ' . join(', ', $providedCommands) . ')';
            }
            print PHP_EOL;
        }
        print PHP_EOL;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'help' => 'Shows this help [optional]'
        ];
    }

    /**
     * Returns the command identifier.
     *
     * @return array
     */
    public function getCommands()
    {
        return ['help'];
    }

    /**
     * Prints help on the usage of the command.
     *
     * @return void
     */
    public function getHelp()
    {
        print ('Help:') . PHP_EOL;
        print ('Lists the commands available in Phalcon') . PHP_EOL;
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
