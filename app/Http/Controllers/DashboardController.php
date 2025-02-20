<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user->role->name;

        return match ($role) {
            'admin' => view('dashboard.admin', [
                'tickets' => Ticket::with(['user', 'agent'])->get()
            ]),
            'client' => view('dashboard.client', [
                'tickets' => Ticket::with(['agent'])
                    ->where('user_id', $user->id)
                    ->get()
            ]),
            'agent' => view('dashboard.agent', [
                'tickets' => Ticket::with(['user'])
                    ->where('agent_id', $user->id)
                    ->get()
            ]),
            default => view('dashboard.client', [
                'tickets' => collect()
            ]),
        };
    }
} 