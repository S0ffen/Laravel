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

        for ($i = 1; $i <= 10; $i++) {
            Note::create([
                'user_id' => $user->id,
                'title' => fake()->sentence, // Dodanie tytułu
                'note' => fake()->realText(20),
                'room' => 'Room ' . rand(1, 50), // Dodanie przykładowego numeru pokoju
                'date' => now(), // Dodanie przykładowej daty
                'scrapped' => rand(0, 1) ? 'yes' : 'no', // Losowe ustawienie scrapped
            ]);
        }

        return redirect()->route('new-tab.index')->with('success', '10 sample notes created successfully.');
    }
}
