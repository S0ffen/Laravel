<x-app-layout>
    <div class="note-container single-note">
        <h1>Create new note</h1>
        <form action="{{ route('note.store') }}" method="POST" class="note">
            @csrf

            <!-- Pole do wprowadzenia tytułu notki -->
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter note title" required>
            </div>

            <!-- Pole tekstowe dla treści notki -->
            <div class="form-group">
                <label for="note">Note Content</label>
                <textarea name="note" rows="5" class="note-body" placeholder="Enter your note here" required></textarea>
            </div>

            <!-- Dropdown do wyboru sali -->
            <div class="form-group">
                <label for="room">Select Room</label>
                <select name="room" class="form-control" required>
                    <option value="" disabled selected>Select a room</option>
                    @for ($i = 1; $i <= 50; $i++)
                        <option value=" {{ $i }}">Sala {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <!-- Pole do wprowadzenia daty -->
            <div class="form-group">
                <label for="date">Select Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <!-- Pole wyboru scrapped -->
            <div class="form-group">
                <label for="scrapped">Czy element jest zezłomowany?</label>
                <select name="scrapped" id="scrapped" class="form-control">
                    <option value="no">Nie</option>
                    <option value="yes">Tak</option>
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
