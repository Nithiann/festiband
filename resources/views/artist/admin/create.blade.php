<x-app-layout class="">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-bold mb-6 text-center">Store an Artist</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.artist.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Artist Name</label>
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
                    <label for="image" class="block text-gray-700">Picture</label>
                    <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded mt-1" onchange="previewImage(event, 'profilePreview')">
                    <img id="profilePreview" src="#" alt="Cover Photo Preview" class="mt-2 hidden w-32 h-32 object-cover">
                    @error('logo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 w-full">Save Artist</button>
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

