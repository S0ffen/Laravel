<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Add jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            let perPage = {{ request()->input('per_page', 15) }}; // Aktualna liczba elementów na stronę

            let table = $('#your-table-id').DataTable({
                "pageLength": perPage, // Zainicjalizuj tabelę z poprawną wartością
                "lengthMenu": [10, 25, 50, 100], // Opcje wyboru liczby rekordów
                "paging": true, // Włącz paginację
            });

            $('#your-table-id_length select').val(perPage); // Ustaw poprawną wartość w dropdownie

            // Obsługa zmiany liczby rekordów na stronę
            $('#your-table-id_length select').on('change', function() {
                let selectedPerPage = $(this).val(); // Pobierz nową wartość
                updatePerPage(selectedPerPage); // Zaktualizuj parametr w backendzie
            });

            function updatePerPage(selectedPerPage) {
                let url = new URL(window.location.href);
                url.searchParams.set('per_page', selectedPerPage); // Zaktualizuj parametr w URL
                window.location.href = url.toString(); // Odśwież stronę
            }
        });
    </script>


</body>

</html>
