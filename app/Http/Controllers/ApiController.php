<?php

namespace App\Http\Controllers;

use App\Actions\Order\StoreOrder;

class ApiController extends Controller
{
    public function createOrder(StoreOrder $action)
    {
        return $action->execute(request()->only(['items']));
    }
}
