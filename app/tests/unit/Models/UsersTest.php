<?php
declare(strict_types=1);

namespace Test\Unit\Models;

use App\Models\Users;

class UsersTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $users;

    protected function _before()
    {
        $this->users = new Users;
    }

    protected function _after()
    {
    }

    /**
    * 測試是否使用 namespace 取得 Users Models 物件
    */
    public function testModel()
    {
        $this->assertEquals(new \App\Models\Users, $this->users);
    }
}