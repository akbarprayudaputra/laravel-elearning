<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    public function test_user_service_singelton()
    {
        $userService1 = $this->app->make(UserService::class);
        $userService2 = $this->app->make(UserService::class);

        self::assertSame($userService1, $userService2);
    }
}
