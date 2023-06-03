<?php

namespace App\Http\Controllers;

use App\Actions\Order\GetOrders;
use App\Actions\Order\GetTotalPrice;
use App\Consts\Common;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function __construct()
    {
        Inertia::share([
            'commonLabels' => Common::COMMON_LABELS,
            'orderLabels'  => Order::ORDER_LABELS,
        ]);
    }

    public function index(
        GetOrders $action,
        GetTotalPrice $getTotalPriceAction
    ) {
        $orders = $action->execute([
            'date' => now(),
        ])->with(['item']);

        $totalPrice = $getTotalPriceAction->execute([
            'date' => now(),
        ]);

        return Inertia::render(
            'Order/Index',
            [
                'orders'     => $orders->paginate(20),
                'totalPrice' => $totalPrice,
            ]
        );
    }
}
