<?php

namespace App\Console\Commands\MakeActions;

use Illuminate\Support\Str;

class MakeGetModelsAction extends ActionsGeneratorCommand
{
    protected $signature = 'make:actions-get-models {name}';

    protected string $stubFile = 'get-models.stub';

    protected $type = 'Get Model Action';

    protected function getClassName($name): string
    {
        $names = Str::plural($name);

        return "Get$names";
    }
}
