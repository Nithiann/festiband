<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100"><div class="bg-white p-8 rounded-lg shadow-lg w-3/4">
            <div class="grid grid-cols-3 gap-4">
                <div class="border-2 border-black h-64 flex items-center justify-center">
                    <!-- Dynamic main image -->
                    <img src="{{ $festival->getCover() }}" alt="Main Image" class="h-full w-full object-cover">
                </div>
                <div class="col-span-2 space-y-4">
                    <div><strong>Naam:</strong> {{ $festival->name }}</div>
                    <div><strong>Beschrijving:</strong> {{ $festival->description }}</div>
                    <div><strong>Datum:</strong> {{ $festival->date }}</div>
                    <div><strong>Locatie:</strong> {{ $festival->location }}</div>
                    <div><strong>Prijs:</strong> {{ $festival->price }}</div>
                </div>
            </div>
            <div class="mt-8">
                <div class="text-center text-lg">
                    <strong>Line-up:</strong>
                </div>
                <div class="grid grid-cols-5 gap-4 mt-4">
                    @foreach ($artists as $artist)
                        <x-lineup-card :artist="$artist" :lineup="$lineup" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
