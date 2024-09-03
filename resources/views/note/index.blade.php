<x-app-layout>

    <div class="flex justify-center mb-3 py-4">
        <form action="{{ route('note.index') }}" method="GET" class="flex">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}" class="px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Search</button>
        </form>
    </div>
    <div class="note-container">
        <a href="{{ route('note.create') }}" class="new-note-btn">
            New PC
        </a>
        <div class="notes">
            @foreach ($notes as $note )
            <div class="note">
                <div class="note-body">
                    {{ Str::words($note->note, 30)}}
                </div>
                <div class="note-buttons">
                    <a href="{{ route('note.show', $note) }}" class="note-edit-button">View</a>
                    <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                    <form action="{{route('note.destroy', $note)}}" method="POST" class="delete-note-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="note-delete-button">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach

        </div>
        <div class="p-6">
            {{$notes -> links() }}
        </div>  
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-note-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
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
