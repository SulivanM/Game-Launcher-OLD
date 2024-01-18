<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets;
        return view('support', compact('user', 'tickets'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required|string',
        ]);

        Auth::user()->tickets()->create([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function close(Ticket $ticket)
    {
        // Vérifie si l'utilisateur authentifié est le propriétaire du ticket
        if (Auth::user()->id === $ticket->user_id) {
            // Marque le ticket comme "closed"
            $ticket->update(['status' => 'closed']);

            // Redirige vers la vue des tickets avec un message de succès
            return redirect()->route('tickets.index')->with('success', 'Ticket closed successfully.');
        } else {
            // Redirige vers la vue des tickets avec un message d'erreur
            return redirect()->route('tickets.index')->with('error', 'You do not have permission to close this ticket.');
        }
    }
}