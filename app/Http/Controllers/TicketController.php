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

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        $user = Auth::user();
        if ($user->role != 0) {
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


        return redirect()->route('ticket.index');
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
        $labels = Label::all();
        $categories = Category::all();
        $agents = User::where('role', '1')->get();
        $ticket = Ticket::findOrfail($id);
        return view('ticket.edit', compact('labels', 'categories', 'ticket', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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


        return redirect()->route('ticket.index');
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
        if ($ticket) {
            foreach ($ticket->images as $image) {
                Storage::disk('public')->delete('tickets/' . $image->image);
            }
            $ticket->delete();
        }
        return redirect()->route('ticket.index');
    }
}
