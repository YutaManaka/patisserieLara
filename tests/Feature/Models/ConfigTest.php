<?php

namespace Tests\Feature\Models;

use App\Models\Config;
use Tests\TestCase;
use Tests\WithDb;

class ConfigTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testFillable()
    {
        $attributes = [
            'key'         => 'hoge',
            'type'        => 'string',
            'value'       => 'hogehoge',
            'description' => 'hogehogehoge',
        ];
        $config = Config::create($attributes);
        $config->refresh();

        collect($attributes)
            ->each(fn ($val, $key) => $this->assertEquals($val, $config->$key));
    }

    public function testCreate()
    {
        $attributes = [
            'key'         => 'hoge2',
            'type'        => 'string',
            'value'       => 'hogehoge2',
            'description' => 'hogehogehoge2',
        ];
        Config::create($attributes);
        $configs = Config::get();
        $this->assertSame(1, $configs->count());
    }

    public function testDelete()
    {
        $attributes = [
            'key'         => 'hoge3',
            'type'        => 'string',
            'value'       => 'hogehoge3',
            'description' => 'hogehogehoge3',
        ];
        $config = Config::create($attributes);

        $config->delete();
        $config->refresh();

        $this->assertSoftDeleted($config);
    }
}
