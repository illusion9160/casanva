<?php
declare(strict_types=1);

namespace App\Tests\Unit\Models;

use App\Models\Users;
use Codeception\Test\Unit;

class UsersTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $users;
    
    protected function _before()
    {
        $this->users = new Users;
    }

    protected function _after()
    {
    }

    /**
    * 練習取代 class 裡回傳的 method
    */
    public function testMake()
    {
        $userRepository = $this->make(Users::class, ['save' => $this->users]);
        $act = $userRepository->save(1);

        $this->assertEquals($this->users, $act);

    }

    /**
    * 測試 從資料取出的資料是否真實存在
    */
    public function testUser()
    {
        $user = $this->users->findFirst(1);
        $this->tester->seeInDatabase(
            'users',
            ['name' => $user->name, 'username' => $user->username]
        );
    }
}