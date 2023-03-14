<?php

namespace Tests\Feature\Controllers;

use App\Models\Config;
use App\Models\User;
use Tests\TestCase;
use Tests\WithDb;

class ConfigControllerTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->post('/login', [
            'email'    => $this->user->email,
            'password' => 'password',
        ]);
    }

   public function testIndexConfig()
   {
       $config = Config::create([
            'key'         => 'test1',
            'type'        => 'string',
            'value'       => 'testValue1',
            'description' => 'test1',
        ]);
       $config2 = Config::create([
            'key'         => 'test2',
            'type'        => 'string',
            'value'       => 'testValue2',
            'description' => 'test2',
        ]);

       $response = $this->get(route('config'));
       $response->assertStatus(200);
       $response->assertSeeInOrder([
            $config->description,
            $config->value,
            $config2->description,
            $config2->value,
       ]);
   }

   public function testCreateConfig()
   {
       $response = $this->get(route('config.create'));
       $response->assertStatus(200);
   }

   public function testStoreConfig()
   {
       $data = [
        'key'         => 'test3',
        'type'        => 'string',
        'value'       => 'testValue3',
        'description' => 'test3',
       ];
       $response = $this->post(route('config.store'), $data);
       $response->assertStatus(302);
       $response->assertRedirect('configs');

       $this->assertDatabaseHas(
           'configs',
           [
            'key'         => 'test3',
            'type'        => 'string',
            'value'       => '"testValue3"',
            'description' => 'test3',
           ],
       );
   }

   public function testShowConfig()
   {
       $config4 = Config::create([
        'key'         => 'test4',
        'type'        => 'string',
        'value'       => 'testValue4',
        'description' => 'test4',
       ]);
       $response = $this->get(route('config.show', $config4->key));
       $response->assertStatus(200);
       $response->assertSeeInOrder([
           $config4->key,
           $config4->type,
           $config4->order_end_time,
           $config4->value,
           $config4->description,
       ]);
   }

   public function testUpdateConfig()
   {
       $config5 = Config::create([
        'key'         => 'test5',
        'type'        => 'string',
        'value'       => 'testValue5',
        'description' => 'test5',
       ]);
       $data = [
        'key'         => 'test5',
        'type'        => 'url',
        'value'       => 'testValue5Updated',
        'description' => 'test5Updated',
       ];
       $response = $this->put(route('config.update', $config5->key), $data);
       $response->assertStatus(302);
       $response->assertRedirect('configs');

       $this->assertDatabaseHas(
           'configs',
           [
               'key'         => 'test5',
               'type'        => 'url',
               'value'       => '"testValue5Updated"',
               'description' => 'test5Updated',
           ]
       );
   }

   public function testDestroyConfig()
   {
       $config6 = Config::create([
        'key'         => 'test6',
        'type'        => 'string',
        'value'       => 'testValue6',
        'description' => 'test6',
       ]);
       $response = $this->delete(route('config.destroy', ['config' => $config6->key]));
       $response->assertStatus(302);
       $response->assertRedirect('configs');
       $this->assertSoftDeleted($config6);
   }
}
