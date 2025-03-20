<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('Business Reviews') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto px-4 py-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-3xl font-semibold mb-6 text-gray-700 border-b pb-3">
                        Negative Reviews for <span class="text-blue-600">{{ $business->bussiness_name }}</span>
                    </h2>

                    @if ($business->reviews->isEmpty())
                        <p class="text-gray-500 text-lg text-center py-6">No negative reviews found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse rounded-lg overflow-hidden shadow-lg">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-lg">Name</th>
                                        <th class="px-6 py-3 text-left text-lg">Email</th>
                                        <th class="px-6 py-3 text-left text-lg">Review</th>
                                        <th class="px-6 py-3 text-center text-lg">Rating</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($business->reviews as $review)
                                        <tr class="hover:bg-gray-100 transition">
                                            <td class="px-6 py-4 text-gray-700 font-medium">{{ $review->name }}</td>
                                            <td class="px-6 py-4 text-gray-600">{{ $review->email }}</td>
                                            <td class="px-6 py-4 text-gray-600">{{ $review->review }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="text-red-500 text-lg font-semibold flex justify-center items-center space-x-1">
                                                    {{ $review->rating }} 
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927C9.346 2.08 10.654 2.08 10.951 2.927l1.434 4.344a1 1 0 00.95.69h4.565c.969 0 1.372 1.24.588 1.81l-3.688 2.683a1 1 0 00-.364 1.118l1.434 4.344c.297.847-.755 1.548-1.54 1.118l-3.688-2.683a1 1 0 00-1.176 0l-3.688 2.683c-.785.43-1.837-.271-1.54-1.118l1.434-4.344a1 1 0 00-.364-1.118L2.412 9.771c-.785-.57-.381-1.81.588-1.81h4.565a1 1 0 00.95-.69l1.434-4.344z" />
                                                    </svg>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
