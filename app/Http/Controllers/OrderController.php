<?php

namespace App\Http\Controllers;

use App\Actions\Order\GetOrders;
use App\Consts\Common;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function __construct()
    {
        Inertia::share([
            'commonLabels' => Common::COMMON_LABELS,
            'itemLabels'   => Order::ORDER_LABELS,
        ]);
    }

    public function index(
        GetOrders $action,
    ) {
        $orders = $action->execute([
            'date' => now(),
        ])->with(['items']);

        return Inertia::render(
            'TableOrder/Transaction/Index',
            [
                'orders' => $orders->paginate(30),
            ]
        );
    }
}
