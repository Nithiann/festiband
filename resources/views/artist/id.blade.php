<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100"><div class="bg-white p-8 rounded-lg shadow-lg w-3/4">
            <div class="grid grid-cols-3 gap-4">
                <div class="border-2 border-black h-64 flex items-center justify-center">
                    <!-- Dynamic main image -->
                    <img src="{{ $artist->getImage() }}" alt="Main Image" class="h-full w-full object-cover">
                </div>
                <div class="col-span-2 space-y-4">
                    <div><strong>Naam:</strong> {{ $artist->name }}</div>
                    <div><strong>Beschrijving:</strong> {{ $artist->description }}</div>
                </div>
            </div>
            <div class="mt-8">
                <strong>Line-up:</strong>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    @foreach ($festivals as $festival)
                        <div class="border-2 border-black h-32 flex items-center justify-center">
                            <div><strong>Naam:</strong> {{ $festival->name }}</div>
                            <!-- Dynamic lineup images -->
                            <img src="{{ $festival->getLogo() }}" alt="Line-up Image" class="h-full w-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
