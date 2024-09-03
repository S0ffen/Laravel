<x-app-layout>
    <h1>Welcome to the New Tab</h1>
    <form action="{{ route('new-tab.create-sample-notes') }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Create 50 Sample Notes
        </button>
    </form>
</x-app-layout>
