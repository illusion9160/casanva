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
    /**
    * 依賴注入物件
    */
    protected $di;

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
        $this->di->set(
            'cron',
            function () {
                $cron = new Manager();

                $cron->add(
                    new CronCallback(
                        "* * * * *",
                        function () {
                            // ...
                            echo 'callback';
                        }
                    )
                );

                $cron->add(
                    new CronPhalcon(
                        "* * * * *",
                        [
                            'task'   => 'play',
                            'params' => ['casanova']
                        ]
                    )
                );

                // $cron->add(
                //     new CronSystem(
                //         "* 0 * * *",
                //         "sh backup.sh"
                //     )
                // );

                return $cron;
            }
        );

        return $this->di;
    }

    public function command()
    {
        $this->di->get('console');
    }
}
