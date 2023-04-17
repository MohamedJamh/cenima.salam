<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketRequest;
use App\Http\Resources\Ticket\TicketCollection;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    

    public function index()
    {
        $tickets = Ticket::with('user','beverages')->get();
        return response()->json([
            'status' => true,
            'result' => new TicketCollection($tickets)
        ]);
    }

    

    public function store(TicketRequest $request)
    {
        $ticket = Ticket::create($request->only([
            'seats',
            'price',
            'user_id',
            'showtime_id'
        ]));
        if(!$request->input('beverages')) $ticket->beverages()->attach($request->input('beverages'));
        return response()->json([
            'status' => true,
            'message' => 'Your ticket has been reserved successfully',
            'result' => new TicketResource($ticket)
        ]);
    }

    

    public function show($id)
    {
        //
    }

    

    public function update(Request $request, $id)
    {
        //
    }

   
    

    public function destroy($id)
    {
        //
    }
}
