<?php

namespace App\Console\Commands\MakeActions;

use Illuminate\Console\Command;

class MakeActions extends Command
{
    protected $signature = 'make:actions {name}';

    public function handle()
    {
        $name = trim($this->argument('name'));

        $this->call('make:actions-get-models', ['name' => $name]);
        $this->call('make:actions-filter-model', ['name' => $name]);
        $this->call('make:actions-store-model', ['name' => $name]);
        $this->call('make:actions-update-model', ['name' => $name]);
        $this->call('make:actions-delete-model', ['name' => $name]);
    }
}
