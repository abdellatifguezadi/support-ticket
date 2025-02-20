<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('dashboard.client', [
            'tickets' => auth()->user()->tickets
        ]);
    }

    public function createTicket(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'open',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Ticket créé avec succès.');
    }

    public function updateTicket(Request $request, $id)
    {
        $ticket = Ticket::where('user_id', auth()->id())
            ->where('status', 'open')
            ->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Ticket mis à jour avec succès.');
    }

    public function destroyTicket($id)
    {
        $ticket = Ticket::where('user_id', auth()->id())
            ->where('status', 'open')
            ->findOrFail($id);
        
        $ticket->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Ticket supprimé avec succès.');
    }

    public function closeTicket($id)
    {
        $ticket = Ticket::where('user_id', auth()->id())
            ->where('status', 'open')
            ->findOrFail($id);
        
        $ticket->update(['status' => 'closed']);

        return redirect()->route('dashboard')
            ->with('success', 'Ticket fermé avec succès.');
    }
} 