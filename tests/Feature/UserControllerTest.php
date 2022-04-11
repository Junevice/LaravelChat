<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_usersList()
    {
        $response = $this->get('/api/users');
        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_userShow()
    {
        $response = $this->get('/api/users/12');
        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_userUpdate()
    {
        $data=['password' => 'passtest', 'name'=>'Mr patate'];
        $response = $this->put('/api/users/12', $data);
        $response->assertOk();
    }
}
