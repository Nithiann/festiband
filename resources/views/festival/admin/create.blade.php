<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-2xl font-bold mb-6 text-center">Create Festival</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('festival.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Festival Name</label>
                            <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded mt-1" rows="5" required></textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="start" class="block text-gray-700">Start Date</label>
                            <input type="date" id="start" name="start" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                            @error('start')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="end" class="block text-gray-700">End Date</label>
                            <input type="date" id="end" name="end" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                            @error('end_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-gray-700">Location</label>
                            <input type="text" id="location" name="location" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                            @error('location')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="ticketPrice" class="block text-gray-700">Ticket Price</label>
                            <input type="number" step="0.01" id="ticketPrice" name="ticketPrice" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                            @error('ticket_price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="mb-4">
                            <label for="logo" class="block text-gray-700">Logo</label>
                            <input type="file" id="logo" name="logo" class="w-full p-2 border border-gray-300 rounded mt-1" onchange="previewImage(event, 'logoPreview')">
                            <img id="logoPreview" src="#" alt="Logo Preview" class="mt-2 hidden w-32 h-32 object-cover">
                            @error('logo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="cover" class="block text-gray-700">Cover Photo</label>
                            <input type="file" id="cover" name="cover" class="w-full p-2 border border-gray-300 rounded mt-1" onchange="previewImage(event, 'coverPreview')">
                            <img id="coverPreview" src="#" alt="Cover Photo Preview" class="mt-2 hidden w-32 h-32 object-cover">
                            @error('cover')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 w-full mt-4">Create Festival</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
                output.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
