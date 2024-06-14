<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Update Lineup for {{ $festival->name }}</h1>

        <div class="flex space-x-4">
            <div class="w-1/2 bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-4">Available Artists</h2>
                <ul id="available-artists" class="space-y-2">
                    @foreach($allArtists as $artist)
                        @unless($currentLineup->contains('artist_id', $artist->id))
                            <li class="flex items-center justify-between cursor-pointer" data-id="{{ $artist->id }}" onclick="addToLineup(this)">
                                {{ $artist->name }}
                            </li>
                        @endunless
                    @endforeach
                </ul>
            </div>

            <div class="w-1/2 bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-4">Current Lineup</h2>
                <ul id="current-lineup" class="space-y-2">
                    @foreach($currentLineup as $lineup)
                        <li class="flex items-center justify-between" data-id="{{ $lineup->artist_id }}">
                            <span>
                                {{ $lineup->artist_name }}
                                <div>
                                    <input type="text" placeholder="Set Name" value="{{ $lineup->set_name }}" class="set-name">
                                    <input type="time" placeholder="Start Time" value="{{ $lineup->start_time }}" class="start-time">
                                    <input type="time" placeholder="End Time" value="{{ $lineup->end_time }}" class="end-time">
                                </div>
                            </span>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeFromLineup(this)">Remove</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <form id="lineup-form" method="POST" action="{{ route('admin.festivals.lineup', $festival) }}">
            @csrf
            <input type="hidden" name="lineup" id="lineup-input">
            <button type="submit" class="btn btn-primary mt-4" onclick="saveLineup()">Save Lineup</button>
        </form>
    </div>

    <script>
        function addToLineup(element) {
            const id = element.getAttribute('data-id');
            const name = element.textContent.trim();

            // Remove from available artists
            element.remove();

            // Add to current lineup
            const currentLineup = document.getElementById('current-lineup');
            const li = document.createElement('li');
            li.setAttribute('data-id', id);
            li.setAttribute('class', 'flex items-center justify-between');
            li.innerHTML = `<span>${name}
                                <div>
                                    <input type="text" placeholder="Set Name" class="set-name">
                                    <input type="time" placeholder="Start Time" class="start-time">
                                    <input type="time" placeholder="End Time" class="end-time">
                                </div>
                            </span>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeFromLineup(this)">Remove</button>`;
            currentLineup.appendChild(li);
        }

        function removeFromLineup(button) {
            const li = button.parentElement;
            const id = li.getAttribute('data-id');
            const name = li.querySelector('span').firstChild.textContent.trim();

            // Remove from current lineup
            li.remove();

            // Add to available artists
            const availableArtists = document.getElementById('available-artists');
            const newLi = document.createElement('li');
            newLi.textContent = name;
            newLi.setAttribute('data-id', id);
            newLi.setAttribute('class', 'flex items-center justify-between cursor-pointer');
            newLi.setAttribute('onclick', 'addToLineup(this)');
            availableArtists.appendChild(newLi);
        }

        function saveLineup() {
            const lineup = [];
            document.querySelectorAll('#current-lineup li').forEach(function (element) {
                lineup.push({
                    festival_id: '{{ $festival->id }}',
                    artist_id: element.getAttribute('data-id'),
                    set_name: element.querySelector('.set-name').value,
                    start_time: element.querySelector('.start-time').value,
                    end_time: element.querySelector('.end-time').value
                });
            });
            document.getElementById('lineup-input').value = JSON.stringify(lineup);
        }
    </script>
</x-app-layout>
