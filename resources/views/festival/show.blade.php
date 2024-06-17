<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Festivals</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($festivals as $festival)
                <x-festival-card :festival="$festival" />
            @endforeach
        </div>
    </div>
</x-app-layout>
