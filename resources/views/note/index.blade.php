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

            <!-- Sortowanie po ilości RAM-u -->
            <select id="filter_ram" name="filter_ram" class="px-4 py-2 border rounded-md">
                <option value="" selected>Wybierz RAM</option>
                <option value="4" {{ request('filter_ram') == '4' ? 'selected' : '' }}>4 GB</option>
                <option value="6" {{ request('filter_ram') == '6' ? 'selected' : '' }}>6 GB</option>
                <option value="8" {{ request('filter_ram') == '8' ? 'selected' : '' }}>8 GB</option>
                <option value="12" {{ request('filter_ram') == '12' ? 'selected' : '' }}>12 GB</option>
                <option value="16" {{ request('filter_ram') == '16' ? 'selected' : '' }}>16 GB</option>
                <option value="24" {{ request('filter_ram') == '24' ? 'selected' : '' }}>24 GB</option>
                <option value="32" {{ request('filter_ram') == '32' ? 'selected' : '' }}>32 GB</option>
                <option value="48" {{ request('filter_ram') == '48' ? 'selected' : '' }}>48 GB</option>
                <option value="64" {{ request('filter_ram') == '64' ? 'selected' : '' }}>64 GB</option>
            </select>

            <!-- Przycisk wyszukiwania -->
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Search
            </button>
        </form>
    </div>

    <!-- Container for displaying notes -->
    <div class="note-container flex flex-col items-center space-y-4">
        <!-- Przycisk New PC na środku -->
        <a href="{{ route('note.create') }}" class="new-note-btn mb-4">
            New PC
        </a>

        <!-- Kontener dla notatek -->
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
