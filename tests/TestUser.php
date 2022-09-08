<?php

namespace tests;

use tests\BaseTest;

class TestUser extends BaseTest
{
    public function testUserCreate()
    {
        self::markTestSkipped();

        $suc = $this->zinc->user_create('test', 'test user', '123456');
        self::assertTrue($suc);
    }

    public function testUserDelete()
    {
        self::markTestSkipped();

        $suc = $this->zinc->user_delete('test');
        self::assertTrue($suc);
    }

    public function testUserList()
    {
        self::markTestSkipped();

        $users = $this->zinc->user_list();
        self::assertIsArray($users);
        var_dump($users);
    }

    public function testUserLogin()
    {
        // self::markTestSkipped();

        $ok = $this->zinc->user_login('admin', '123456');
        self::assertTrue($ok);
    }
}
