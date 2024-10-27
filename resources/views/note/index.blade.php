<x-app-layout>

    <div class="flex justify-center mb-3 py-4">
        <!-- Formularz dla wyszukiwania tytułu i statusu "zezłomowany" -->
        <form action="{{ route('note.index') }}" method="GET" class="flex space-x-2">
            <!-- Wyszukiwanie po tytule -->
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}"
                class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">

            <!-- Wyszukiwanie po statusie "zezłomowany" -->
            <select id="scrapped" name="scrapped" class="px-4 py-2 border rounded-md">
                <option value="" selected>Wszystkie</option>
                <option value="yes" {{ request('scrapped') == 'yes' ? 'selected' : '' }}>Zezłomowany</option>
                <option value="no" {{ request('scrapped') == 'no' ? 'selected' : '' }}>Nie zezłomowany</option>
            </select>

            <!-- Przycisk wyszukiwania -->
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Search
            </button>
        </form>
    </div>

    <!-- Container for displaying notes -->
    <div class="note-container flex flex-wrap justify-center">
        <a href="{{ route('note.create') }}" class="new-note-btn">
            New PC
        </a>

        <div class="notes grid grid-cols-3 gap-4">
            @foreach ($notes as $note)
                @php
                    $backgroundClass = $note->scrapped == 'yes' ? ' bg-red-400' : ' bg-green-400';
                @endphp
                <div class="note p-4 {{ $backgroundClass }} relative rounded-md shadow-md">
                    <div class="note-body ">
                        <!-- Display note title, room, and date -->
                        <h4><strong>Title:</strong> {{ $note->title }}</h4>
                        <p><strong>Sala:</strong> {{ $note->room }}</p>
                        <p><strong>Date:</strong> {{ $note->date }}</p>

                        {{-- <!-- Display the note content (snippet) -->
                        <p>{{ Str::words($note->note, 10) }}</p> --}}
                    </div>
                    <!-- Przyciski -->
                    <div class="note-buttons absolute bottom-2 right-2 flex space-x-2">
                        <a href="{{ route('note.show', $note) }}"
                            class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">View</a>
                        <a href="{{ route('note.edit', $note) }}"
                            class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">Edit</a>
                        <form action="{{ route('note.destroy', $note) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-6">
            {{ $notes->links() }}
        </div>
    </div>

</x-app-layout>
