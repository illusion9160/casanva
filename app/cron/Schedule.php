<?php
declare(strict_types=1);
namespace App\Cron;

use App\Cron\Job\Callback as CronCallback;
use App\Cron\Job\Phalcon as CronPhalcon;
use App\Cron\Job\System as CronSystem;
use Phalcon\DiInterface;

/**
* 排程定義類別
*/
class Schedule
{
    const CRON_INITIAL = '* * * * *';

    /**
    * @var 依賴注入物件
    */
    protected $di;

    /**
    * @var 事件
    */
    protected $events = [];

    /**
    * @var 閉包
    */
    protected $cronCallback = [];

    /**
    * @var Phalcon 命令
    */
    protected $cronPhalcon = [];

    /**
    * @var 系統命令
    */
    protected $cronSystem = [];

    public function __construct(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
    * 註冊 cron 服務
    *
    * @return \Phalcon\DiInterface
    */
    public function cron()
    {
        $events = $this->events;
        $this->di->set(
            'cron',
            function () use ($events) {
                $cron = new Manager();

                foreach ($events as $event) {
                    $cron->add($event);
                }

                return $cron;
            }
        );

        return $this->di;
    }

    /**
    * 使用 callback
    */
    public function call(callable $callback, array $params = [])
    {
        $this->events[] = $event = new CronCallback(
            self::CRON_INITIAL,
            $callback
        );

        return $event;
    }

    /**
    * 使用 command call
    */
    public function command($command, array $params = [])
    {
        if (empty($params)) {
            $paramList = explode(' ', trim($command));
            if (count($paramList) !== 1) {
                $command = array_shift($paramList);
                $params = $paramList;
            }
        }

        $this->events[] = $event = new CronPhalcon(
            self::CRON_INITIAL,
            [
                'task'   => $command,
                'params' => $params
            ]
        );

        return $event;
    }

    /**
    * 使用 系統命令
    */
    public function exec($command, array $params = [])
    {
        $this->events[] = $event = new CronSystem(
            self::CRON_INITIAL,
            $command
        );

        return $event;
    }
}
