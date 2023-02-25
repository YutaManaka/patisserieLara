<?php

namespace App\Console\Commands\MakeActions;

class MakeUpdateModelAction extends ActionsGeneratorCommand
{
    protected $signature = 'make:actions-update-models {name}';

    protected string $stubFile = 'update-model.stub';

    protected $type = 'Update Model Action';

    protected function getClassName($name): string
    {
        return "Update$name";
    }
}
