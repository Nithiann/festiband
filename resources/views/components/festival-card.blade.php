@props(['festival'])
@if ($festival)
<div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105 cursor-pointer">
    <a href="{{route('festivals.details', $festival->id)}}">
        <img src="{{ $festival->getLogo() }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h2 class="text-xl font-semibold">{{ $festival->name }}</h2>
        </div>
    </a>
</div>
@endif
