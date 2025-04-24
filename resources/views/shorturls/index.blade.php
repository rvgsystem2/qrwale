<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('Short URL Management') }}
            </h2>
            @can('create shorturl')
                <div class="flex items-center space-x-4">
                    <a href="{{ route('shorturls.create') }}" 
                       class="px-4 py-2 bg-gradient-to-r from-[#c21108] to-[#000308] text-white font-semibold rounded-lg shadow-md hover:from-[#000308] hover:to-[#c21108] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c21108] transition duration-300 ease-in-out">
                        + Create Short URL
                    </a>
                </div>
                
            @endcan
            {{-- <a href="{{ route('shorturls.create') }}" 
               class="px-5 py-2 bg-gradient-to-r from-[#c21108] to-[#000308] text-white font-semibold rounded-lg shadow-md hover:from-[#000308] hover:to-[#c21108] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c21108] transition duration-300 ease-in-out">
                + Create Short URL
            </a> --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flex items-center bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-md">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Shortened URLs</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gradient-to-r from-blue-50 to-blue-100 text-gray-700 uppercase font-semibold text-xs">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Original URL</th>
                                <th class="px-6 py-4">Short Code</th>
                                <th class="px-6 py-4">Short URL</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($urls as $url)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-800 font-medium">{{ $url->id }}</td>
                                    <td class="px-6 py-4 break-all text-blue-600">
                                        <a href="{{ $url->original_url }}" target="_blank" class="hover:underline">{{ $url->original_url }}</a>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-indigo-600">{{ $url->short_code }}</td>
                                    <td class="px-6 py-4 break-all">
                                        <a href="{{ route('shorturls.redirect', $url->short_code) }}" 
                                           target="_blank" 
                                           class="text-blue-600 hover:underline">
                                           {{ route('shorturls.redirect', $url->short_code) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-3">
                                            @can('edit shorturl')
                                                <a href="{{ route('shorturls.edit', $url->id) }}"
                                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold transition shadow">
                                                   👁️ Edit
                                                </a>
                                                
                                            @endcan
                                         @can('delete shorturl')
                                         <a href="{{ route('shorturls.delete', $url->id) }}"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-semibold transition shadow">
                                            🗑️ Delete
                                         </a>   
                                         @endcan
                                          
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-400 text-base">
                                        No short URLs found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
