<?php

namespace Tests\Feature;

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
        $this->visit('/')
        ->see('BBAPP');
    }

    public function testPage()
    {
        $this->visit('/')
        ->click('About')
        ->seePageIs('/about');
    }

}
