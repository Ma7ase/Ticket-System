<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\sedEmail_toUser;
use Illuminate\Support\Facades\DB;

class CreateTicket extends Controller
{

    public function addTicket(Request $request)
    {
        // Validate request
        $request->validate([
            'priority' => 'required|string',
            'title' => 'required|string|max:255',
            'issue_type' => 'required|string|max:100',
            'date' => 'required|string',
            'issue_description' => 'required|string|max:100',
            'documents' => 'required|file|max:15360', // 15MB max
        ]);
    
        // Generate the custom ticket ID
        $ticketId = $this->generateTicketId();
    
        // Store the data
        $data = [
            'id' => $ticketId, // Add the custom ID
            'priority' => $request->priority,
            'title' => $request->title,
            'issue_type' => $request->issue_type,
            'date' => $request->date,
            'issue_description' => $request->issue_description,
            'documents' => $request->file('documents')->store('documents', 'public'),
            'email' => $request->session()->get('email'), // ← get it from session
        ];
    
        try {
            // Create the ticket
            Ticket::create($data);
    
            // Send email
            Mail::to('m.ali@tabayyun.com.sa')->send(new sedEmail_toUser($data));
    
            return response()->json(['message' => 'Form submitted successfully!'], 201);
        } catch (\Exception $e) {
            Log::error('Error creating ticket: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Generate a custom ticket ID.
     *
     * @return string
     */
    
    private function generateTicketId()
    {
        $block1 = "T";
        $block2 = date('dmY'); // Example: 16032025
    
        // Fetch last ticket with the same date pattern
        $lastTicket = DB::table('tickets')
            ->where('id', 'like', "{$block1}_{$block2}_%")
            ->orderBy('id', 'desc')
            ->first();
    
        $counter = 1;
        if ($lastTicket && isset($lastTicket->id)) {
            $lastIdParts = explode('_', $lastTicket->id);
            $lastCounter = isset($lastIdParts[2]) ? (int) $lastIdParts[2] : 0;
            $counter = $lastCounter + 1;
        }
    
        return "{$block1}_{$block2}_{$counter}";
    }
    
}