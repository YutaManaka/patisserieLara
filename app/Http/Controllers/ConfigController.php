<?php

namespace App\Http\Controllers;

use App\Actions\Config\DeleteConfig;
use App\Actions\Config\GetConfigs;
use App\Actions\Config\StoreConfig;
use App\Actions\Config\UpdateConfig;
use App\Http\Requests\Config\StoreConfigRequest;
use App\Http\Requests\Config\UpdateConfigRequest;
use App\Models\Config;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ConfigController extends Controller
{
    public function __construct()
    {
        Inertia::share([
            // 'permission'   => User::PERMISSION_,
            // 'ConfigLabels' => Config::_CONFIG_LABELS,
            'userPermission' => auth()->user()->permission,
        ]);
    }

    public function index(GetConfigs $action)
    {
        return Inertia::render(
            'Config/Index',
            [
                'configs' => $action->execute(request()->all())->paginate(),
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Config/Form',
            [
                'isNew' => true,
            ]
        );
    }

    public function store(StoreConfig $action, StoreConfigRequest $request)
    {
        $action->execute($request->all());

        return Redirect::route('config')->with('success', '作成しました。');
    }

    public function show(string $configKey)
    {
        return Inertia::render(
            'Config/Form',
            [
                'config'         => Config::findOrFail($configKey),
                'userPermission' => auth()->user()->permission,
            ]
        );
    }

    public function update(string $configKey, UpdateConfig $action, UpdateConfigRequest $request)
    {
        $config = Config::findOrFail($configKey);
        $action->execute($config, $request->all());

        return Redirect::route('config')->with('success', '更新しました。');
    }

    public function destroy(string $configKey, DeleteConfig $action)
    {
        $config = Config::findOrFail($configKey);
        $action->execute($config);

        return Redirect::route('config')->with('success', '削除しました。');
    }
}
