<x-app-layout>
    <div class="flex justify-center">
        <div class="note-container single-note bg-yellow-300 p-8 rounded-lg shadow-md max-w-2xl w-full">
            <h1 class="text-3xl text-center font-semibold mb-8">Edycja elementu</h1>
            <form action="{{ route('note.update', $note) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Note Title -->
                <div class="form-group">
                    <label for="title" class="block font-medium mb-1">Nazwa elementu</label>
                    <input type="text" name="title"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        value="{{ $note->title }}" required>
                </div>

                <!-- Dropdown do wyboru RAM -->
                <div class="form-group">
                    <label for="ram">RAM</label>
                    <br>
                    <select name="ram" class="form-control">
                        <option value="" disabled selected>Select RAM</option>
                        <option value="4 GB">4 GB</option>
                        <option value="6 GB">6 GB</option>
                        <option value="8 GB">8 GB</option>
                        <option value="12 GB">12 GB</option>
                        <option value="16 GB">16 GB</option>
                        <option value="24 GB">24 GB</option>
                        <option value="32 GB">32 GB</option>
                        <option value="48 GB">48 GB</option>
                        <option value="64 GB">64 GB</option>
                    </select>
                </div>
                <!-- CPU -->
                <div class="form-group">
                    <label for="cpu">CPU</label>
                    <input type="text" name="cpu"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter CPU">
                </div>

                <!-- GPU -->
                <div class="form-group">
                    <label for="gpu">GPU</label>
                    <input type="text" name="gpu"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter GPU">
                </div>

                <!-- Disk -->
                <div class="form-group">
                    <label for="disk">Dysk</label>
                    <input type="text" name="disk"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter Disk Capacity">
                </div>

                <!-- Note Content -->
                <div class="form-group">
                    <label for="note" class="block font-medium mb-1">Notatka do elementu</label>
                    <textarea name="note" rows="5"
                        class="note-body w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter your note here">{{ $note->note }}</textarea>
                </div>


                <!-- Select Room -->
                <div class="form-group">
                    <label for="room" class="block font-medium mb-1">Wybór Sali</label>
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
                    <label for="date" class="block font-medium mb-1">Wybór daty</label>
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
