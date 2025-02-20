<?php

namespace App\Http\Controllers;

use App\Models\Ticket; // Make sure to import the Ticket model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch tickets with their related user and agent data
        $tickets = Ticket::with(['user', 'agent',])->get();

        // Pass tickets to the view
        return view('dashboard.admin', compact('tickets'));
    }
}