<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user->role->name;

        return match ($role) {
            'admin' => view('dashboard.admin'),
            'client' => view('dashboard.client'),
            'agent' => view('dashboard.agent'),
            default => view('dashboard.client'),
        };
    }
} 