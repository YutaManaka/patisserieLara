<?php

namespace App\Http\Controllers;

use App\Actions\Item\DeleteItem;
use App\Actions\Item\GetItemGroupKeys;
use App\Actions\Item\GetItems;
use App\Actions\Item\StoreItem;
use App\Actions\Item\UpdateItem;
use App\Consts\Common;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function __construct()
    {
        Inertia::share([
            'commonLabels' => Common::COMMON_LABELS,
            'ItemLabels'   => Item::Item_LABELS,
        ]);
    }

    public function index(GetItems $action)
    {
        return Inertia::render(
            'Item/Index',
            [
                'Items' => $action->execute()->paginate(),
            ]
        );
    }

    public function create(GetItemGroupKeys $action)
    {
        return Inertia::render(
            'Item/Form',
            [
                'isNew'     => true,
                'groupKeys' => $action->execute(),
            ]
        );
    }

    public function store(StoreItem $action, StoreItemRequest $request)
    {
        $action->execute($request->all());

        return Redirect::route('Item')->with('success', '作成しました。');
    }

    public function show(Item $Item, GetItemGroupKeys $action)
    {
        return Inertia::render(
            'TableOrder/Item/Form',
            [
                'Item'      => $Item,
                'groupKeys' => $action->execute(),
            ]
        );
    }

    public function update(Item $Item, UpdateItem $action, UpdateItemRequest $request)
    {
        $action->execute($Item, $request->all());

        return Redirect::route('Item')->with('success', '更新しました。');
    }

    public function destroy(Item $Item, DeleteItem $action)
    {
        $action->execute($Item);

        return Redirect::route('Item')->with('success', '削除しました。');
    }
}
