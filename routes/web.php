<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewTabController;


Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::redirect("/", "/note")->name("dashboard");
Route::get("/search", [NoteController::class, "search"])->name("search");

Route::get('/new-tab', [NewTabController::class, 'index'])->name('new-tab.index'); // Zmiana tutaj
Route::post('/new-tab/create-sample-notes', [NewTabController::class, 'createSampleNotes'])->name('new-tab.create-sample-notes');


Route::middleware(["auth", "verified"])->group(function () {
    // Route::get('/note', [NoteController::class,'index'])->name('note.index');
    // Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    // route::post('/note',[NoteController::class,'store'])->name('note.store');
    // Route::get('/note/{id}',[NoteController::class,'show'])->name('note.show');
    // Route::get('/note/{id}/edit',[NoteController:: class,'edit'])->name('note.edit');
    // Route::put('/note/{id}',[NoteController::class,'update'])->name('note.update');
    // Route::delete('/note/{id}',[NoteController::class,'destroy'])->name('note.destroy'); 

    Route::resource("note", NoteController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notes/searchRoom', [NoteController::class, 'searchByRoom'])->name('notes.searchRoom');
});

require __DIR__ . '/auth.php';
