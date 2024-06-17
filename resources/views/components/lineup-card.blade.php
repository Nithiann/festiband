@props(['artist', 'lineup'])

@if ($artist)
<div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105 cursor-pointer">
    <a href="{{route('artists.details', $artist->id)}}" class="text-decoration-none text-black">
        <img src="{{ $artist->getImage() }}" alt="{{ $artist->name }}" class="h-64 w-64 object-fit">
        <div class="p-4 text-center">
            <h2 class="text-xl font-semibold no-underline">{{ $artist->name }}</h2>
        </div>
    </a>
</div>
@endif
