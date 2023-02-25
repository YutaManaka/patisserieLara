<?php

namespace App\Console\Commands\MakeActions;

class MakeDeleteModelAction extends ActionsGeneratorCommand
{
    protected $signature = 'make:actions-delete-models {name}';

    protected string $stubFile = 'delete-model.stub';

    protected $type = 'Delete Model Action';

    protected function getClassName($name): string
    {
        return "Delete$name";
    }
}
