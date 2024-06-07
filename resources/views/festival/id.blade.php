<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100"><div class="bg-white p-8 rounded-lg shadow-lg w-3/4">
            <div class="grid grid-cols-3 gap-4">
                <div class="border-2 border-black h-64 flex items-center justify-center">
                    <!-- Dynamic main image -->
                    <img src="{{ asset($data['main_image']) }}" alt="Main Image" class="h-full w-full object-cover">
                </div>
                <div class="col-span-2 space-y-4">
                    <div><strong>Naam:</strong> {{ $data['name'] }}</div>
                    <div><strong>Beschrijving:</strong> {{ $data['description'] }}</div>
                    <div><strong>Datum:</strong> {{ $data['date'] }}</div>
                    <div><strong>Locatie:</strong> {{ $data['location'] }}</div>
                    <div><strong>Prijs:</strong> {{ $data['price'] }}</div>
                </div>
            </div>
            <div class="mt-8">
                <strong>Line-up:</strong>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    @foreach ($artists as $image)
                        <div class="border-2 border-black h-32 flex items-center justify-center">
                            <!-- Dynamic lineup images -->
                            <img src="{{ asset($image) }}" alt="Line-up Image" class="h-full w-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
