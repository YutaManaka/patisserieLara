<?php

namespace App\Actions\Config;

use App\Models\Config;

class UpdateConfig
{
    public function execute(Config $model, array $attributes): Config
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
        $model->update($attributes);

        return $model->refresh();
    }
}
