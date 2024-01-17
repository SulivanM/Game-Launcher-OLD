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
        return view('tickets.index', compact('user'));
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
        // Assuming you have an 'is_admin' column in your users table to check if the user is an admin
        if (Auth::user()->is_admin) {
            $ticket->update(['status' => 'closed']);
            return redirect()->route('tickets.index')->with('success', 'Ticket closed successfully.');
        } else {
            return redirect()->route('tickets.index')->with('error', 'You do not have permission to close this ticket.');
        }
    }
}