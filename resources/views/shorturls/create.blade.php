<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($shorturl) ? 'Edit Short URL' : 'Create Short URL' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    {{ isset($shorturl) ? 'Edit URL' : 'Create New Short URL' }}
                </h2>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ isset($shorturl) ? route('shorturls.update', $shorturl->id) : route('shorturls.store') }}">
                    @csrf
                    @if(isset($shorturl))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Original URL</label>
                        <input type="url" name="original_url"
                               value="{{ old('original_url', $shorturl->original_url ?? '') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                               placeholder="https://example.com" required>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                            {{ isset($shorturl) ? 'Update' : 'Generate Short URL' }}
                        </button>
                        <a href="{{ route('shorturls.index') }}"
                           class="ml-4 text-sm text-gray-600 hover:text-gray-800 underline">Back to list</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
