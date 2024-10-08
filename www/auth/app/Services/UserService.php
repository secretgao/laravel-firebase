<?php
namespace App\Services;

class UserService {
    private $users;

    public function __construct() {
        // 模拟数据库user表  key：username ，value ：password
        $this->users = [
        'user1' => '1234567',
        'user2' => '1234567'
        ];
    }

    public function authenticate($username, $password) {
        if (isset($this->users[$username]) && $this->users[$username] === $password) {
            return true;
        }
        return false;
    }
}
