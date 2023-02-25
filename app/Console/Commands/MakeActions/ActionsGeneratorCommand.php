<?php

namespace App\Console\Commands\MakeActions;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

abstract class ActionsGeneratorCommand extends GeneratorCommand
{
    protected string $stubFile;

    protected function getStub()
    {
        return __DIR__ . "/stubs/$this->stubFile";
    }

    abstract protected function getClassName($name): string;

    protected function getDefaultNamespace($rootNamespace)
    {
        $name = $this->argument('name');

        return "$rootNamespace\\Actions\\$name";
    }

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = $this->getClassName($name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name
        );
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
        $name  = $this->getNameInput();
        $names = Str::plural($this->getNameInput());

        return str_replace(
            ['{{ class }}', '{{ name }}', '{{ names }}'],
            [$class, $name, $names],
            $stub
        );
    }
}
