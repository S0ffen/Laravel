<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-semibold mb-6">Note Details</h1>

            <!-- Wyświetlanie szczegółów notatki -->
            <div class="text-lg">
                <p><strong>Title:</strong> {{ $note->title }}</p>
                <p><strong>Room:</strong> {{ $note->room }}</p>
                <p><strong>Date:</strong> {{ $note->date }}</p>
                <p><strong>Created At:</strong> {{ $note->created_at }}</p>
                <p><strong>Content:</strong> {{ $note->note }}</p>
            </div>

            <!-- Przyciski akcji -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('note.edit', $note) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                <form action="{{ route('note.destroy', $note) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
