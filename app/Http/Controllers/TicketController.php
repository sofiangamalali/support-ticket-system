<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return response()->json(TicketResource::collection(Ticket::Where('created_by', auth()->id())->get()));
    }
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'created_by' => auth()->id(),
        ] + $request->validated());

        return response()->json([
            'message' => 'Ticket created successfully',
            'data' => TicketResource::make($ticket),
        ], 201);

    }
    public function show(Ticket $ticket)
    {
        if (auth()->id() !== $ticket->created_by) {
            return response()->json([
                'message' => 'Unauthorized to view this ticket.'
            ], 403);
        }
        $ticket->load('messages');
        return response()->json([
            TicketResource::make($ticket),
        ]);

    }
}
