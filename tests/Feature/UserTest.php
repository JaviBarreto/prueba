<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
//use PHPUnit\Fram

class UserTest extends TestCase
{
    // use RefreshDatabase
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /**
     * B basic test example.
     */
    public function testCrearUsuario(): void
    {
        
        User::factory(10)->create();

        $response = DB::table("users")->get()->toArray();

        // dd($response);

        // $this->assertEquals(1,$response->id);
        // $this->assertArrayHasKey(9,$response);
        // $this->assertCount(10, $response);
    }

    // public function test_user_exist(): void 
    // {
    //     User::factory(1)->create(
    //     );

    //     User::factory(9)->create();

    //     $response = DB::table("users")->where("name","javier")->get();

    //     // $this->assertEquals(10,conunt($response));
    //     // $this-AssertTrue($response->contains(function($item,$key){
    //     //     return $item->name == "javier";
    //     // }));
    //     // $this->assertObjectHasProperty("name",$response->toObject());

    // }
    

}
