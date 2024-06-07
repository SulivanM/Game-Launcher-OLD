<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    /**
     * Display the chat messages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $messages = Message::latest()->limit(50)->get();
        return view('tchat', compact('messages'));
    }

    /**
     * Send a new chat message.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Filter bad words in the message
        $filteredMessage = $this->filterBadWords($validatedData['message']);

        // Check if the message is empty after filtering
        if (empty(trim(strip_tags($filteredMessage)))) {
            return back()->withErrors(['message' => 'Your message contains inappropriate content. Please revise it.']);
        }

        // Create a new message for the authenticated user
        auth()->user()->messages()->create(['message' => $filteredMessage]);

        // Append the new message to the existing messages
        $newMessage = new Message();
        $newMessage->user_id = auth()->id();
        $newMessage->message = $filteredMessage;

        $messages = Message::latest()->limit(50)->get()->prepend($newMessage);

        // Return to the chat view with the updated messages
        return view('tchat', compact('messages'));
    }


    /**
     * Filter bad words in a given message.
     *
     * @param string $message
     * @return string
     */
    public function filterBadWords($message)
    {
        // Define your list of bad words or use an external source
        $badWords = [
            'ass',
            'bastard',
            'bitch',
            'bollocks',
            'bugger',
            'clit',
            'cock',
            'crap',
            'cunt',
            'damn',
            'dick',
            'fanny',
            'feck',
            'fuck',
            'goddamn',
            'hell',
            'horseshit',
            'jesus',
            'motherfucker',
            'nigger',
            'piss',
            'prick',
            'shit',
            'slut',
            'son of a bitch',
            'twat',
            'whore',
        ];


        // Replace bad words with asterisks
        $filteredMessage = str_ireplace($badWords, '****** | Warn (Bad Words)', $message);

        return $filteredMessage;
    }
}
