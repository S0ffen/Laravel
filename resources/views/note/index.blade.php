<x-app-layout>

    <div class="flex justify-center mb-3 py-4">
        <!-- Form for searching by query (title) -->
        <form action="{{ route('note.index') }}" method="GET" class="flex space-x-2">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}"
                class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Search</button>
        </form>
    </div>

    <div class="flex justify-center mb-3 py-4">
        <!-- Form for searching by room -->
        <form action="{{ route('notes.searchRoom') }}" method="GET" class="flex space-x-2">
            <select id="room" name="room" class="px-4 py-2 border rounded-md">
                <option value="" selected>Wszystkie Sale</option>
                @for ($i = 1; $i <= 50; $i++)
                    <option value="{{ $i }}" {{ request('room') == $i ? 'selected' : '' }}>Sala
                        {{ $i }}</option>
                @endfor
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Search by
                Room</button>
        </form>
    </div>

    <!-- Container for displaying notes -->
    <div class="note-container flex flex-wrap justify-center">
        <a href="{{ route('note.create') }}" class="new-note-btn">
            New PC
        </a>

        <div class="notes grid grid-cols-3 gap-4">
            @foreach ($notes as $note)
                <div class="note p-4" style="background-color: {{ $note->scrapped == 'yes' ? 'red' : 'green' }}">
                    <div class="note-body">
                        <!-- Display note title, room, and date -->
                        <h4><strong>Title:</strong> {{ $note->title }}</h4>
                        <p><strong>Sala:</strong> {{ $note->room }}</p>
                        <p><strong>Date:</strong> {{ $note->date }}</p>

                        <!-- Display the note content (snippet) -->
                        <p>{{ Str::words($note->note, 30) }}</p>
                    </div>
                    <div class="note-buttons">
                        <a href="{{ route('note.show', $note) }}" class="note-edit-button">View</a>
                        <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                        <form action="{{ route('note.destroy', $note) }}" method="POST" class="delete-note-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="note-delete-button">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-6">
            {{ $notes->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-note-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const confirmed = confirm('Are you sure you want to delete this note?');
                    if (confirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
