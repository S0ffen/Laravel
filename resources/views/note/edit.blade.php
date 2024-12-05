<x-app-layout>
    <div class="flex justify-center">
        <div class="note-container single-note bg-yellow-300 p-8 rounded-lg shadow-md max-w-2xl w-full">
            <h1 class="text-3xl text-center font-semibold mb-8">Edycja elementu</h1>
            <form action="{{ route('note.update', $note) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Typ Elementu -->
                <div class="form-group">
                    <label for="elementType" class="block font-medium mb-1">Typ Elementu</label>
                    <select id="elementType" name="element_type"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        required>
                        <option value="" disabled>Wybierz typ elementu</option>
                        <option value="laptop" {{ $note->element_type == 'laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="monitor" {{ $note->element_type == 'monitor' ? 'selected' : '' }}>Monitor
                        </option>
                        <option value="speaker" {{ $note->element_type == 'speaker' ? 'selected' : '' }}>Głośnik
                        </option>
                        <option value="computer" {{ $note->element_type == 'computer' ? 'selected' : '' }}>Komputer
                        </option>
                    </select>
                </div>

                <!-- Dynamiczne pola -->
                <div id="dynamicFields">
                    <!-- Pola dynamiczne będą dodane tutaj -->
                </div>

                <!-- Note Content -->
                <div class="form-group">
                    <label for="note" class="block font-medium mb-1">Notatka do elementu</label>
                    <textarea id="note" name="note" rows="5"
                        class="note-body w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" required>{{ $note->note }}</textarea>
                </div>

                <!-- Select Room -->
                <div class="form-group">
                    <label for="room" class="block font-medium mb-1">Wybór Sali</label>
                    <select id="room" name="room"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        required>
                        <option value="" disabled>Wybór Sali</option>
                        @for ($i = 1; $i <= 50; $i++)
                            <option value="{{ $i }}" {{ $note->room == $i ? 'selected' : '' }}>Sala
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Select Date -->
                <div class="form-group">
                    <label for="date">Wybór Daty</label>
                    <input type="date" id="date" name="date"
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const elementType = document.getElementById('elementType');
            const dynamicFields = document.getElementById('dynamicFields');

            // Szablony dla różnych typów
            const templates = {
                laptop: `
                    <div class="form-group">
                        <label for="ram">RAM</label>
                        <select id="ram" name="ram" class="form-control">
                            <option value="" disabled selected>Select RAM</option>
                            <option value="4 GB" {{ $note->ram == '4 GB' ? 'selected' : '' }}>4 GB</option>
                            <option value="8 GB" {{ $note->ram == '8 GB' ? 'selected' : '' }}>8 GB</option>
                            <option value="16 GB" {{ $note->ram == '16 GB' ? 'selected' : '' }}>16 GB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cpu">CPU</label>
                        <input id="cpu" type="text" name="cpu" value="{{ $note->cpu }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gpu">GPU</label>
                        <input id="gpu" type="text" name="gpu" value="{{ $note->gpu }}" class="form-control" placeholder="Enter GPU">
                    </div>
                `,
                monitor: `
                    <div class="form-group">
                        <label for="resolution">Rozdzielczość</label>
                        <input type="text" name="resolution" class="form-control" value="{{ $note->resolution }}">
                    </div>
                    <div class="form-group">
                        <label for="size">Rozmiar (cale)</label>
                        <input type="number" name="size" class="form-control" value="{{ $note->size }}">
                    </div>
                `,
                speaker: `
                    <div class="form-group">
                        <label for="loudness">Głośność (dB)</label>
                        <input type="number" name="loudness" class="form-control" value="{{ $note->loudness }}">
                    </div>
                `,
                computer: `
                    <div class="form-group">
                        <label for="ram">RAM</label>
                        <select name="ram" class="form-control">
                            <option value="8 GB" {{ $note->ram == '8 GB' ? 'selected' : '' }}>8 GB</option>
                            <option value="16 GB" {{ $note->ram == '16 GB' ? 'selected' : '' }}>16 GB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cpu">CPU</label>
                        <input type="text" name="cpu" value="{{ $note->cpu }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gpu">GPU</label>
                        <input type="text" name="gpu" value="{{ $note->gpu }}" class="form-control">
                    </div>
                `
            };

            // Obsługa zmian w polu select
            const updateFields = () => {
                const selectedType = elementType.value;
                dynamicFields.innerHTML = templates[selectedType] || '';
            };

            elementType.addEventListener('change', updateFields);

            // Wczytaj aktualne pola na starcie
            updateFields();
        });
    </script>
</x-app-layout>
