<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('label.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabelRequest $request)
    {
        $label = new Label();
        $label->name = $request->name;
        $label->save();
        return redirect()->route('label.index')->with('create', 'New label is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $label = Label::findOrfail($id);
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabelRequest $request, $id)
    {
        $label = Label::findOrfail($id);
        $label->name = $request->name;
        $label->update();
        return redirect()->route('label.index')->with('update', 'Label is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $label = Label::findOrfail($id);
        if ($label) {
            $label->delete();
        }
        return redirect()->route('label.index')->with('delete', 'Label is deleted successfully');
    }
}
