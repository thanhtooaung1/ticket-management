<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        $user = Auth::user();
        if (!$user->isAdmin()) {
            $tickets = Ticket::where('user_id', $user->id)->orwhere('assigned_user_id', $user->id)->get();
        }
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $labels = Label::all();
        $categories = Category::all();
        return view('ticket.create', compact('labels', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {

        // return $request;
        $ticket = Ticket::create($request->all());

        $ticket->labels()->attach($request->labels);
        $ticket->categories()->attach($request->categories);

        $images = $request->images;
        foreach ($images as $image) {
            $imageName = uniqid("ticket_") . "." . $image->extension();
            $image->storeAs('public/tickets', $imageName);
            $image = new Image();
            $image->ticket_id = $ticket->id;
            $image->image = $imageName;
            $image->save();
        }


        return redirect()->route('ticket.index')->with('create', 'New ticket is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $ticket = Ticket::findOrfail($id);
        if (!($this->checkRouteAccess($ticket))) {
            return redirect()->route('ticket.index');
        }
        return view('ticket.detail', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrfail($id);
        if (!($this->checkRouteAccess($ticket))) {
            return redirect()->route('ticket.index');
        }
        $labels = Label::all();
        $categories = Category::all();
        $agents = User::where('role', '1')->get();
        return view('ticket.edit', compact('labels', 'categories', 'ticket', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $ticket = Ticket::findOrfail($id);
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        if ($request->assigned_user_id) {
            $ticket->assigned_user_id = $request->assigned_user_id;
        }
        $ticket->update();

        $ticket->labels()->sync($request->labels);
        $ticket->categories()->sync($request->categories);

        $images = $request->images;
        if ($images) {
            foreach ($ticket->images as $image) {
                Image::find($image->id)->delete();
                Storage::disk('public')->delete('tickets/' . $image->image);
            }

            foreach ($images as $image) {
                $imageName = uniqid("ticket_") . "." . $image->extension();
                $image->storeAs('public/tickets', $imageName);
                $image = new Image();
                $image->ticket_id = $ticket->id;
                $image->image = $imageName;
                $image->save();
            }
        }


        return redirect()->route('ticket.index')->with('update', 'Ticket is updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrfail($id);
        if (!($this->checkRouteAccess($ticket))) {
            return redirect()->route('ticket.index');
        }
        if ($ticket) {
            foreach ($ticket->images as $image) {
                Storage::disk('public')->delete('tickets/' . $image->image);
            }
            $ticket->delete();
        }
        return redirect()->route('ticket.index')->with('delete', 'Ticket is deleted successfully');
    }

    function checkRouteAccess($ticket)
    {
        $user = Auth::user();
        if (!$user->isAdmin() && !($user->id == $ticket->user->id || $user->id == ($ticket->assignedAgent->id ?? 0))) {
            return false;
        }
        return true;
    }
}
