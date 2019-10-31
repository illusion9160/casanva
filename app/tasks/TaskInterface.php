<?php
declare(strict_types=1);
/*
  +------------------------------------------------------------------------+
  | Phalcon Task Interface                                                 |
  +------------------------------------------------------------------------+
*/

namespace App\Tasks;

/**
 * Task Interface
 *
 * This interface must be implemented by all task
 *
 * @package App\Task
 */
interface TaskInterface
{
    /**
     * Returns the command identifier.
     *
     * @return array
     */
    public function getCommands();

    /**
     * Prints help on the usage of the command.
     *
     * @return void
     */
    public function getHelp();

    /**
     * Return required parameters.
     *
     * @return integer
     */
    public function getRequiredParams();

    /**
     * Gets possible command parameters.
     *
     * This method returns a list of available parameters for the current command.
     * The list must be represented as pairs key-value.
     * Where key is the parameter name and value is the short description.
     *
     * @return array
     */
    public function getPossibleParams();
}
