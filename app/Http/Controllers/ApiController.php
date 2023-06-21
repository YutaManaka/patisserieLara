<?php

namespace App\Http\Controllers;

use App\Actions\Order\StoreOrder;
use App\Actions\Receipt\getReceipt;

class ApiController extends Controller
{
    public function storeOrder(StoreOrder $action)
    {
        return $action->execute(request()->only(['items']));
    }
}
