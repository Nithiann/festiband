<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Festivals</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($festivals as $festival)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105 cursor-pointer">
                    <a href="{{route('festivals.details', $festival->id)}}">
                        <img src="{{ $festival->getLogo() }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold">{{ $festival->name }}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
