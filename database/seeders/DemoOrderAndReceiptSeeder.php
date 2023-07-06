<?php

namespace Database\Seeders;

use App\Actions\Order\CreateDemoOrdersAndReceipts as CreateDemoOrdersAndReceiptsAction;
use Illuminate\Database\Seeder;

class DemoOrderAndReceiptSeeder extends Seeder
{
    /**
     * 検証用注文データを作成。
     *
     * @return void
     */
    public function run(CreateDemoOrdersAndReceiptsAction $action)
    {
        $action->execute();
    }
}
