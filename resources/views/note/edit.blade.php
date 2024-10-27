<x-app-layout>
    <div class="flex justify-center">
        <div class="note-container single-note bg-yellow-300 p-8 rounded-lg shadow-md max-w-2xl w-full">
            <h1 class="text-3xl text-center font-semibold mb-8">Edit your note</h1>
            <form action="{{ route('note.update', $note) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Note Title -->
                <div class="form-group">
                    <label for="title" class="block font-medium mb-1">Note Title</label>
                    <input type="text" name="title"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        value="{{ $note->title }}" required>
                </div>

                <!-- Note Content -->
                <div class="form-group">
                    <label for="note" class="block font-medium mb-1">Note Content</label>
                    <textarea name="note" rows="5"
                        class="note-body w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter your note here">{{ $note->note }}</textarea>
                </div>

                <!-- Select Room -->
                <div class="form-group">
                    <label for="room" class="block font-medium mb-1">Select Room</label>
                    <select name="room"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        required>
                        <option value="" disabled>Select a room</option>
                        @for ($i = 1; $i <= 50; $i++)
                            <option value="Room {{ $i }}"
                                {{ $note->room == 'Room ' . $i ? 'selected' : '' }}>Sala {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Select Date -->
                <div class="form-group w-40">
                    <label for="date" class="block font-medium mb-1">Select Date</label>
                    <input type="date" name="date"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        value="{{ $note->date }}" required>
                </div>

                <!-- Scrapped Status -->
                <div class="form-group">
                    <label for="scrapped" class="block font-medium mb-1">Czy element jest zezłomowany?</label>
                    <select name="scrapped" id="scrapped"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="no" {{ $note->scrapped == 'no' ? 'selected' : '' }}>Nie</option>
                        <option value="yes" {{ $note->scrapped == 'yes' ? 'selected' : '' }}>Tak</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="note-buttons flex justify-end space-x-3 mt-6">
                    <a href="{{ route('note.index') }}"
                        class="note-cancel-button bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                    <button type="submit"
                        class="note-submit-button bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
