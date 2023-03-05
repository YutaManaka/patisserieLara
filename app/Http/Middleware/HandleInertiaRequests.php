<?php

namespace App\Http\Middleware;

use App\Actions\Menu\GetPermittedMenu;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        // 管理画面の場合
        return array_merge(parent::share($request), [
        'menuItems' => auth()->guest() ? [] : app(GetPermittedMenu::class)->execute(auth()->user()),
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error'   => $request->session()->get('error'),
                ];
            },
        ]);

        // ショップ画面の場合
        return parent::share($request);
    }
}
