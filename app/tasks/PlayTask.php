<?php
declare(strict_types=1);

namespace App\Tasks;

use Exception;

/**
* Play List 任務類別
*
*/
class PlayTask extends BasicTask
{
    const COMMAND_COLUMN_LEN = 16;

    /**
    * cli 執行主要入口
    *
    * @param array $params
    */
    public function mainAction(array $params)
    {
        print('Hello, World !!! ' . $params[0]) . PHP_EOL;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'name' => 'your name'
        ];
    }

    /**
     * Returns the command identifier.
     *
     * @return array
     */
    public function getCommands()
    {
        return ['play'];
    }

    /**
     * Prints help on the usage of the command.
     *
     * @return void
     */
    public function getHelp()
    {
        print('Help:') . PHP_EOL;
        print('  Play a say hello') . PHP_EOL . PHP_EOL;

        print('Usage:') . PHP_EOL;
        print('  play [name] ') . PHP_EOL . PHP_EOL;

        print('Argumen./composerts:') . PHP_EOL;
        print('  play');
        print("\tsay hello") . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
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
