<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {

        $tickets = Ticket::query();

        if ($request->status) {
            $tickets->where('status', $request->status);
        }

        if ($request->created_by) {
            $tickets->where('created_by', $request->created_by);
        }

        if ($request->search) {
            $tickets->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->start_date && $request->end_date) {
            $tickets->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        return response()->json(
            $tickets->simplePaginate(10),
        );
    }
    public function storeMessage(StoreMessageRequest $request, Ticket $ticket)
    {
        $ticket->messages()->create($request->validated() + ['sender_id' => auth()->id()]);
        return response()->json([
            'message' => 'Message added successfully.',
            'ticket' => TicketResource::make($ticket->load('messages')), // Return the ticket with its messages
        ], 201);
    }
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        return response()->json(['message' => 'Ticket updated successfully']);
    }
}
