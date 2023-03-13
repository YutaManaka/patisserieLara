<?php

namespace App\Actions\Config;

use App\Models\Config;

class DeleteConfig
{
    public function execute(Config $model): bool
    {
        return (bool) $model->delete();
    }
}
