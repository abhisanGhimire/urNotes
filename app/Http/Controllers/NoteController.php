<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="List Note";
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(10);
        return view('notes.index',compact('notes','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Create note";

        return view('notes.create',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'title'=>'required',
        ]);
        Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'note' => $request->note
        ]);
        return to_route('notes.index')->with('success','Note created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $title="View note";

        return view('notes.show',compact(['note','title']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $title="Edit note";

        return view('notes.edit',compact('note','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $request->validate([
            'note' => 'required',
            'title'=>'required',
        ]);
        $note->update([
            'title' => $request->title,
            'note' => $request->note
        ]);

        return to_route('notes.index')->with('success','Note Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $note->delete();
        return redirect()->route('notes.index')->with('success','Note deleted successfully');
    }
}
