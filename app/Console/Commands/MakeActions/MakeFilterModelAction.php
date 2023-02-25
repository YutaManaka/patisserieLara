<?php

namespace App\Console\Commands\MakeActions;

use Illuminate\Support\Str;

class MakeFilterModelAction extends ActionsGeneratorCommand
{
    protected $signature = 'make:actions-filter-model {name}';

    protected string $stubFile = 'filter-model.stub';

    protected $type = 'Filter Action';

    protected function getClassName($name): string
    {
        $names = Str::plural($name);

        return "Filter$names";
    }
}
