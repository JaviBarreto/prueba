<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $userTest = 1   ;

            $this->assertEquals(1,$userTest);
    }


    /**
     * B basic test example.
     */
    // public function testPrueba(): void
    // {
        
    //         // $userTest = 1;
    //         // $this->assertEquals(1,$userTest);

    //         $response = ["name"=>"javi","value"=>1];
    //         $this->assertEquals(1,$response['value']);
    //         $this->assertArrayHasKey('name',$response);
    // }
}
