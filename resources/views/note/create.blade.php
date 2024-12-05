<x-app-layout>
    <div class="flex justify-center">
        <div class="note-container single-note bg-yellow-300 p-8 rounded-lg shadow-md max-w-2xl w-full">
            <h1 class="text-3xl text-center font-semibold mb-8">Stworzenie nowego elementu do bazy danych</h1>
            <form action="{{ route('note.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="form-group">
                    <label for="title" class="block font-medium mb-1">Nazwa Elementu</label>
                    <input id="title" type="text" name="title"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter note title" required>
                </div>


                <!-- Typ Elementu -->
                <div class="form-group">
                    <label for="elementType" class="block font-medium mb-1">Typ Elementu</label>
                    <select id="elementType" name="element_type"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        required>
                        <option value="" disabled selected>Wybierz typ elementu</option>
                        <option value="laptop">Laptop</option>
                        <option value="monitor">Monitor</option>
                        <option value="speaker">Głośnik</option>
                        <option value="computer">Komputer</option>
                    </select>
                </div>

                <!-- Dynamiczne pola -->
                <div id="dynamicFields">
                    <!-- Pola dynamiczne będą dodawane tutaj -->
                </div>

                <!-- Note Content -->
                <div class="form-group">
                    <label for="note" class="block font-medium mb-1">Notatka do elementu</label>
                    <textarea id="note" name="note" rows="5"
                        class="note-body w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter your note here" required></textarea>
                </div>

                <!-- Select Room -->
                <div class="form-group">
                    <label for="room" class="block font-medium mb-1">Select Room</label>
                    <select id="room" name="room"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        required>
                        <option value="" disabled selected>Wybór Sali</option>
                        @for ($i = 1; $i <= 50; $i++)
                            <option value="{{ $i }}">Sala {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Wybór Daty</label>
                    <input type="date" id="date" name="date"
                        class="form-control w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                        required>
                </div>

                <select id="scrapped" name="scrapped" required>
                    <option value="no">Nie</option>
                    <option value="yes">Tak</option>
                </select>

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
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


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
                            <option value="4 GB">4 GB</option>
                            <option value="8 GB">8 GB</option>
                            <option value="16 GB">16 GB</option>
                            <option value="32 GB">32 GB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cpu">CPU</label>
                        <input  id="cpu" type="text" name="cpu" class="form-control" placeholder="Enter CPU">
                    </div>
                    <div class="form-group">
                        <label for="gpu">GPU</label>
                        <input type="text" name="gpu" class="form-control" placeholder="Enter GPU">
                    </div>
                `,
                monitor: `
                    <div class="form-group">
                        <label for="resolution">Rozdzielczość</label>
                        <input type="text" name="resolution" class="form-control" placeholder="1920x1080">
                    </div>
                    <div class="form-group">
                        <label for="size">Rozmiar (cale)</label>
                        <input type="number" name="size" class="form-control" placeholder="Enter size in inches">
                    </div>
                `,
                speaker: `
                    <div class="form-group">
                        <label for="loudness">Głośność (dB)</label>
                        <input type="number" name="loudness" class="form-control" placeholder="Enter loudness in dB">
                    </div>
                `,
                computer: `
                    <div class="form-group">
                        <label for="ram">RAM</label>
                        <select name="ram" class="form-control">
                            <option value="" disabled selected>Select RAM</option>
                            <option value="8 GB">8 GB</option>
                            <option value="16 GB">16 GB</option>
                            <option value="32 GB">32 GB</option>
                            <option value="64 GB">64 GB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cpu">CPU</label>
                        <input type="text" name="cpu" class="form-control" placeholder="Enter CPU">
                    </div>
                    <div class="form-group">
                        <label for="gpu">GPU</label>
                        <input type="text" name="gpu" class="form-control" placeholder="Enter GPU">
                    </div>
                    <div class="form-group">
                        <label for="storage">Pojemność Dysku</label>
                        <input type="text" name="storage" class="form-control" placeholder="Enter storage size">
                    </div>
                `
            };

            // Obsługa zmian w polu select
            elementType.addEventListener('change', (e) => {
                const selectedType = e.target.value;
                dynamicFields.innerHTML = templates[selectedType] || '';
            });
        });
    </script>
</x-app-layout>
