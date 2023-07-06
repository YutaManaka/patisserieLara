<?php

namespace App\Console\Commands;

use App\Actions\Order\CreateDemoOrdersAndReceipts as CreateDemoOrdersAndReceiptsAction;
use Illuminate\Console\Command;

class CreateDemoOrdersAndReceipts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-demo-orders-and-receipts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create dummy data for orders and receipts.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CreateDemoOrdersAndReceiptsAction $action)
    {
        $action->execute();
        $this->info('Database seeding completed successfully.');
    }
}
