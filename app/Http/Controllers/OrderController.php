<?php

namespace App\Http\Controllers;

use App\Actions\Order\GetOrders;
use App\Actions\Order\GetTotalPrice;
use App\Actions\Order\SetOrdersDelivered;
use App\Consts\Common;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
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

    public function setOrdersDelivered(
        Order $order,
        SetOrdersDelivered $action
    ) {
        $action->execute($order);

        return Redirect::route('order', ['page' => request()->query('previous_page')])
            ->with('success', '提供済にしました。');
    }
}
