<?php
declare(strict_types=1);

namespace App\Tasks;

use Exception;
use Phalcon\Cli\Task;

/**
* 基本任務列別
*
*/
abstract class BasicTask extends Task implements TaskInterface
{
    /**
     * Prints the available options in the script
     *
     * @param array $parameters
     */
    public function printParameters($parameters)
    {
        $length = 0;
        foreach ($parameters as $parameter => $description) {
            if ($length == 0) {
                $length = strlen($parameter);
            }
            if (strlen($parameter) > $length) {
                $length = strlen($parameter);
            }
        }

        print('Options:') . PHP_EOL;
        foreach ($parameters as $parameter => $description) {
            print ' --' . $parameter . str_repeat(' ', $length - strlen($parameter));
            print "    " . $description . PHP_EOL;
        }
    }
}
