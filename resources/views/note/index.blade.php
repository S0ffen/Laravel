<x-app-layout>


    <div class=" p-16  w-3/4  ml-32">
        <a href="{{ route('note.create') }}" class="new-note-btn">
            Nowy element
        </a>


        <!-- Add a table for DataTables -->
        <table id="your-table-id" class="min-w-full divide-y divide-gray-200">
            <!-- Table Head -->
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tytuł
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sala</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akcje
                    </th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($notes as $note)
                    <tr>

                        <td class="px-6 py-4 whitespace-nowrap">{{ $note->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $note->room }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $note->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap  h-14">
                            <!-- Action buttons (hidden by default) -->
                            <div class="note-buttons flex">
                                <form action="{{ route('note.copy', $note) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">Copy</button>
                                </form>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="p-6">
        {{ $notes->links() }}
    </div>

</x-app-layout>
