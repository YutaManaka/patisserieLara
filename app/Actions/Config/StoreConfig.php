<?php

namespace App\Actions\Config;

use App\Models\Config;

class StoreConfig
{
    public function execute(array $attributes): Config
    {
        switch ($attributes['type']) {
            case 'int':
                $attributes['value'] = (int) $attributes['value'];
                break;
            case 'string':
            case 'url':
            case 'time':
                $attributes['value'] = (string) $attributes['value'];
                break;
        }

        return Config::create($attributes);
    }
}
