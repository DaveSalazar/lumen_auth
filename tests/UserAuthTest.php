<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserAuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $user = factory('App\User')->create();
        echo $user->name;
        $this->post('/auth/login', ['email' => $user->email, 'password' => '12345'])
        ->seeStatusCode(200)
        ->seeJsonStructure([
            'token',
        ]);
    }
}
