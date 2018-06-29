<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        factory(\App\UserInfo::class, 50)->create();
        factory(\App\Thread::class, 50)->create();
        factory(\App\Message::class, 200)->create();
        $this->assertTrue(true);
    }
}
