<x-app-layout>
    <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Festival</h1>
            <a href="{{ route('admin.festivals.create') }}" class="btn btn-primary">Add Festival</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($festivals as $festival)
                <tr>
                    <td>{{ $festival->name }}</td>
                    <td>{{ $festival->date }}</td>
                    <td>{{ $festival->location }}</td>
                    <td>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        Actions
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link class="dropdown-item hover:scale-105 transition duration-300" href="{{ route('festivals.details', $festival->id) }}">Goto</x-dropdown-link>
                                <x-dropdown-link class="dropdown-item hover:scale-105 transition duration-300" href="{{ route('admin.festivals.edit', $festival->id) }}">Update</x-dropdown-link>
                                <form action="{{ route('admin.festivals.destroy', $festival->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-dropdown-link type="submit" class="dropdown-item hover:scale-105 transition duration-300">Delete</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
