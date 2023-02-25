<?php

namespace App\Console\Commands\MakeActions;

class MakeStoreModelAction extends ActionsGeneratorCommand
{
    protected $signature = 'make:actions-store-models {name}';

    protected string $stubFile = 'store-model.stub';

    protected $type = 'Store Model Action';

    protected function getClassName($name): string
    {
        return "Store$name";
    }
}
