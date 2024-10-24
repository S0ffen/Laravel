<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $notes = Note::query()
            ->where('user_id', $request->user()->id)
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where(function ($subQuery) use ($query) {
                    $subQuery->where('title', 'LIKE', "%{$query}%")
                        ->orWhere('room', 'LIKE', "%{$query}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate();
        return view('note.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Dodanie walidacji dla nowych pól
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'note' => ['required', 'string'],
            'room' => ['required', 'string'],
            'date' => ['required', 'date'],
            'scrapped' => ['required', 'in:yes,no'],
        ]);

        $data['user_id'] = $request->user()->id;



        // Tworzenie nowej notki z danymi
        $note = Note::create($data);
        $note->refresh();

        return to_route('note.show', $note)->with('message', 'Note was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if ($note->user_id != request()->user()->id) {
            abort(403);
        }

        // Wyświetlanie pojedynczej notki
        return view('note.show', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id != $request->user()->id) {
            abort(403);
        }

        // Walidacja nowych pól
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'note' => ['required', 'string'],
            'room' => ['required', 'string'],
            'date' => ['required', 'date'],
            'scrapped' => ['required', 'in:yes,no'], // Dodanie walidacji dla scra
        ]);



        $note->update($data);


        return to_route('note.show', $note)->with('message', 'Note was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id != request()->user()->id) {
            abort(403);
        }
        $note->delete();

        return to_route('note.index')->with('message', 'Note was deleted');
    }
    public function edit(Note $note)
    {
        if ($note->user_id != request()->user()->id) {
            abort(403); // Sprawdzenie, czy użytkownik jest właścicielem notatki
        }

        return view('note.edit', ['note' => $note]); // Przekazanie notatki do widoku
    }

    public function searchByRoom(Request $request)
    {
        $query = Note::query();

        // Filtrowanie notatek na podstawie wybranej sali
        if ($request->has('room') && $request->room != '') {
            $query->where('room', $request->room);
        }

        $notes = $query->paginate(10); // Paginate results if needed

        return view('note.index', compact('notes'));
    }
}
