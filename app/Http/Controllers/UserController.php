<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'User/Index',
            [
                'users' => User::get(),
            ]
        );
    }
}
