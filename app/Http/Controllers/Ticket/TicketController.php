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
    public function __construct(){
        $this->middleware(['auth:api']);
        $this->middleware(['role:admin'])->only('index');
    }

    public function index()
    {
        $tickets = Ticket::with('user','beverages','showtime')->get();
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
        if($request->has('beverages')) $ticket->beverages()->attach($request->input('beverages'));
        return response()->json([
            'status' => true,
            'message' => 'Your ticket has been reserved successfully',
            'result' => new TicketResource($ticket->load('user','beverages','showtime'))
        ]);
    }

    

    public function show(Ticket $ticket)
    {
        return response()->json([
            'status' => true,
            'message' => 'Your ticket has been reserved successfully',
            'result' => new TicketResource($ticket->load('beverages'))
        ]);
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
