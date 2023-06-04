<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedController extends Controller
{
    public function index() {
        $title="Trashed Note";
        $notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(10);
        return view('trashed.index',compact('notes','title'));
    }

    public function update(Note $note) {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $note->restore();
        return to_route('notes.show', $note)->with('success', 'Note restored successfully');
    }

    public function destroy(Note $note) {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $note->forceDelete();
        return to_route('trashed.index')->with('success', 'Note deleted forever');
    }
}
