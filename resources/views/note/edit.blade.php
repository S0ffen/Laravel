<x-app-layout>
    <div class="note-container single-note">
        <h1 class="text-3xl py-4">Edit your note</h1>
        <form action="{{ route('note.update', $note) }}" method="POST" class="note">
            @csrf
            @method('PUT')

            <!-- Pole do edycji tytułu notatki -->
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" name="title" class="form-control" value="{{ $note->title }}" required>
            </div>

            <!-- Pole tekstowe do edycji treści notatki -->
            <div class="form-group">
                <label for="note">Note Content</label>
                <textarea name="note" rows="10" class="note-body" placeholder="Enter your note here">{{ $note->note }}</textarea>
            </div>

            <!-- Dropdown do wyboru sali -->
            <div class="form-group">
                <label for="room">Select Room</label>
                <select name="room" class="form-control" required>
                    <option value="" disabled>Select a room</option>
                    @for ($i = 1; $i <= 50; $i++)
                        <option value="Room {{ $i }}" {{ $note->room == 'Room ' . $i ? 'selected' : '' }}>
                            Sala {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <!-- Pole do edycji daty -->
            <div class="form-group">
                <label for="date">Select Date</label>
                <input type="date" name="date" class="form-control" value="{{ $note->date }}" required>
            </div>

            <!-- Pole wyboru scrapped -->
            <div class="form-group">
                <label for="scrapped">Czy element jest zezłomowany?</label>
                <select name="scrapped" id="scrapped" class="form-control">
                    <option value="no" {{ $note->scrapped == 'no' ? 'selected' : '' }}>Nie</option>
                    <option value="yes" {{ $note->scrapped == 'yes' ? 'selected' : '' }}>Tak</option>
                </select>
            </div>

            <!-- Przyciski formularza -->
            <div class="note-buttons">
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <button type="submit" class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
