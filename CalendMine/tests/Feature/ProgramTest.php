<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Program;
use App\Models\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ProgramTest extends TestCase
{
    use RefreshDatabase;

    private $faker;
    private $user;
    private $category;


    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create('fr_FR');
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();

    }

    public function  testRouteStoreProgramValid() {

        $data = [
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,

        ];
        $response = $this->actingAs($this->user)->postJson(route('program.store', $data));
        $response ->assertStatus(200);
    }

    public function  testStoreProgramValidWithRecurrence() {
        $data = [
            'id' => 1,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'type' =>'year',
            'nbr_time' => 2,
        ];
        $response = $this->actingAs($this->user)->postJson(route('program.store', $data));
        $this ->assertDatabaseMissing('programs',$data);
    }

    public function  testStoreProgramValid() {

        $data = [
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'type' => null,
            'nbr_time' => null,
        ];
        $response = $this->actingAs($this->user)->postJson(route('program.store', $data));
        $this ->assertDatabaseHas('programs',$data);
    }

    public function  testStoreProgramValidNoConnected() {

        $data = [
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
        ];
        $response = $this->postJson(route('program.store', $data));
        $this ->assertDatabaseMissing('programs',$data);
    }

    public function  testStoreProgramInvalid() {

        $data = [
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'description' => $this->faker->name,
        ];
        $response = $this->actingAs($this->user)->postJson(route('program.store', $data));
        $this ->assertDatabaseMissing('programs',$data);
    }

    public function  testRouteUpdateProgramValid() {
        $data = [
            'id' => 1,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
        ];
        $response = $this->actingAs($this->user)->postJson(route('program.update',$data['id']), $data);
        $response ->assertStatus(200);
    }

    public function  testUpdateProgramValidWithRecurrence() {
        $data = [
            'id' => 1,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'type' =>'year',
            'nbr_time' => 2,
        ];
        $response = $this->actingAs($this->user)->postJson(route('program.update',$data['id']), $data);
        $this ->assertDatabaseMissing('programs',$data);
    }
    
    public function  testUpdateProgramValid() {
        $data = [
            'id' => 1,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
        ];
        $response = $this->actingAs($this->user)->postJson(route('program.update',$data['id']), $data);
        $this ->assertDatabaseMissing('programs',$data);
    }

    public function  testUpdateProgramInvalid() {
        $data = [
            'id' => 1,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'description' => $this->faker->name,
        ];
        $response = $this->actingAs($this->user)->postJson(route('program.update',$data['id']), $data);
        $this ->assertDatabaseMissing('programs',$data);
    }

    public function  testUpdateProgramValidNoConnected() {
        $data = [
            'id' => 1,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
        ];
        $response = $this->postJson(route('program.update',$data['id']), $data);
        $this ->assertDatabaseMissing('programs',$data);
    }

    public function testDeletePresta()
    {
        $id = ['id' => 1];
 
        $response = $this->actingAs($this->user)->postJson(route('program.delete', $id));

        $this->assertDatabaseMissing('programs',  $id);
    }
}