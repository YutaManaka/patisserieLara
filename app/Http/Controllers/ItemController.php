<?php

namespace App\Http\Controllers;

use App\Actions\Category\GetCategories;
use App\Actions\Item\DeleteItem;
use App\Actions\Item\GetUncategorizedItems;
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
            'itemLabels'   => Item::ITEM_LABELS,
        ]);
    }

    public function index(GetUncategorizedItems $action, GetCategories $getCategoryAction)
    {
        $categories = $getCategoryAction->execute()
            ->get()
            ->load(['items' => function ($query) {
                return $query->orderBy('sort_order');
            }]);
        $categories = collect($categories)->prepend([
            'name'  => '未分類',
            'items' => $action->execute(),
        ]);

        return Inertia::render(
            'Item/Index',
            [
                'categories' => $categories,
            ]
        );
    }

    public function create(GetCategories $action)
    {
        return Inertia::render(
            'Item/Form',
            [
                'isNew'      => true,
                'categories' => $action->execute()->get(),
            ]
        );
    }

    public function store(StoreItem $action, StoreItemRequest $request)
    {
        $action->execute($request->all());

        return Redirect::route('item')->with('success', '作成しました。');
    }

    public function show(Item $Item, GetCategories $action)
    {
        return Inertia::render(
            'Item/Form',
            [
                'item'       => $Item->load(['categories']),
                'categories' => $action->execute()->get(),
            ]
        );
    }

    public function update(Item $Item, UpdateItem $action, UpdateItemRequest $request)
    {
        $action->execute($Item, $request->all());

        return Redirect::route('item')->with('success', '更新しました。');
    }

    public function destroy(Item $Item, DeleteItem $action)
    {
        $action->execute($Item);

        return Redirect::route('item')->with('success', '削除しました。');
    }
}
