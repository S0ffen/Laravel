<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth; 
class NewTabController extends Controller
{
    public function index()
    {
        return view('new-tab.index');
    }

    public function createSampleNotes()
    {
        $user = Auth::user();

        for ($i = 1; $i <= 50; $i++) {
            Note::create([
                'user_id' => $user->id,
                'note' => fake()->realText(200)
            ]);
        }

        return redirect()->route('new-tab.index')->with('success', '50 sample notes created successfully.');
    }
}
