<x-app-layout>


    <div class=" p-16  w-3/4  ml-32">
        <a href="{{ route('note.create') }}" class="new-note-btn">
            New PC
        </a>


        <!-- Add a table for DataTables -->
        <table id="your-table-id" class="min-w-full divide-y divide-gray-200">
            <!-- Table Head -->
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox" id="select-all" onclick="toggleAll(this)">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($notes as $note)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="note-checkbox" onclick="toggleButtons()">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $note->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $note->room }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $note->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap  h-14">
                            <!-- Action buttons (hidden by default) -->
                            <div class="note-buttons hidden">
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

    <script>
        function toggleAll(source) {
            const checkboxes = document.querySelectorAll('.note-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
            toggleButtons();
        }

        function toggleButtons() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const checkbox = row.querySelector('.note-checkbox');
                const buttons = row.querySelector('.note-buttons');
                if (checkbox.checked) {
                    buttons.classList.remove('hidden');
                    buttons.classList.add('flex')
                } else {
                    buttons.classList.add('hidden');
                }
            });
        }
    </script>


</x-app-layout>
