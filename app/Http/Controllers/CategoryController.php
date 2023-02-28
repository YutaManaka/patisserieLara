<?php

namespace App\Http\Controllers;

use App\Actions\Category\GetCategories;
use App\Actions\Category\StoreCategory;
use App\Actions\Category\UpdateCategory;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __construct()
    {
        Inertia::share([
            'categoryLabels' => Category::CATEGORY_LABELS,
        ]);
    }

    public function index(GetCategories $action)
    {
        return Inertia::render(
            'Category/Index',
            [
                'categories' => $action->execute()->paginate(),
            ]
        );
    }

    public function create(GetCategories $action)
    {
        return Inertia::render(
            'Category/Form',
            [
                'isNew'      => true,
                'categories' => $action->execute()->get(),
            ]
        );
    }

    public function store(StoreCategory $action, StoreCategoryRequest $request)
    {
        $action->execute($request->all(), $request->image);

        return Redirect::route('category');
    }

    public function show(Category $category, GetCategories $action)
    {
        return Inertia::render(
            'Category/Form',
            [
                'category'   => $category,
                'categories' => $action->execute()->get(),
            ]
        );
    }

    public function update(Category $category, UpdateCategory $action, UpdateCategoryRequest $request)
    {
        $action->execute($category, $request->all(), $request->image);

        return Redirect::route('category')->with('success', '更新しました。');
    }

    public function destroy(Category $category, DeleteCategory $action)
    {
        $action->execute($category);

        return Redirect::route('category')->with('success', '削除しました。');
    }

    public function disabled(Category $category, UpdateCategory $action)
    {
        $inputs = ['disabled' => (int) !$category->disabled];
        $action->execute($category, $inputs);

        return Redirect::route('category');
    }
}
