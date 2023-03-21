<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Models\Ninja;


class ninjaControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ninjaController(): void
    {
       
        $response = $this->post('/api/ninjas/store',[
            "name"=>"felipe",
            "skills"=>"trpar arlboles",
            "rank"=>"Novato",
            "state"=>"Retirado",
        ]);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('ninjas',["name"=>"felipe"]);
        

    }
}
