<x-app-layout>
    <div class="flex justify-center">
        <div class="container mx-auto max-w-lg bg-white shadow-lg rounded-lg p-8 m-10">
            <h1 class="text-3xl font-semibold text-center mb-8">Note Details</h1>

            <!-- Note details -->
            <div class="text-lg space-y-4">
                <p class="text-2xl"><strong>Title:</strong> {{ $note->title }}</p>
                <p class="text-2xl"><strong>Room:</strong> {{ $note->room }}</p>
                <p class="text-2xl"><strong>RAM:</strong> {{ $note->ram }}</p>
                <p class="text-2xl"><strong>CPU:</strong> {{ $note->cpu }}</p>
                <p class="text-2xl"><strong>GPU:</strong> {{ $note->gpu }}</p>
                <p class="text-2xl"><strong>Disk:</strong> {{ $note->disk }}</p>
                <p class="text-2xl"><strong>Date:</strong> {{ $note->date }}</p>
                <p class="text-2xl"><strong>Created At:</strong> {{ $note->created_at }}</p>
                <p class="text-2xl break-words"><strong>Content:</strong> {{ $note->note }}</p>
                <p class="text-2xl">
                    <strong>Scrapped:</strong>
                    <span
                        class="{{ $note->scrapped == 'yes' ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">
                        {{ $note->scrapped == 'yes' ? 'Yes' : 'No' }}
                    </span>
                </p>
            </div>

            <!-- Action buttons -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('note.edit', $note) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                <form action="{{ route('note.destroy', $note) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
