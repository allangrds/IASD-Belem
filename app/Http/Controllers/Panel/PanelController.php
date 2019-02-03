<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\User;

class PanelController extends Controller
{
    public function index()
    {
        $usersCount = User::all()->count();

        return view('panel.home')
            ->with('usersCount', $usersCount);
    }
}
