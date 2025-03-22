<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('Business Management') }}
            </h2>
            @can('create business')
                <a href="{{ route('business.create') }}"
                    class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    + Create
                </a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if (session('success'))
                <div class="flex items-center bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-md">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="flex items-center bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-md">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-x-auto bg-white shadow-md rounded-lg ">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-4 text-left">UserName</th>
                            <th class="py-3 px-4 text-left">Business Name</th>
                            <th class="py-3 px-4 text-left">Mobile</th>
                            <th class="py-3 px-4 text-left">Website</th>
                            <th class="py-3 px-4 text-left">Social Links</th>
                            <th class="py-3 px-4 text-left">Rating</th>
                            <th class="py-3 px-4 text-left">QR</th>


                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($businesses as $business)
                            <tr class="border-b hover:bg-gray-100 mb-4">
                                <td class="py-3 px-4">{{ $business->user->name ?? 'N/A' }}</td>
                                <td class="py-3 px-4">{{ $business->bussiness_name }}</td>
                                <td class="py-3 px-4">{{ $business->mobile_number ?? 'N/A' }}</td>
                                <td class="py-3 px-4">
                                    @if ($business->website_url)
                                        <a href="{{ $business->website_url }}" class="text-blue-500 hover:underline" target="_blank">Visit</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-3 text-lg">
                                        @if ($business->fb_url)
                                            <a href="{{ $business->fb_url }}" class="text-blue-600 hover:text-blue-800" target="_blank">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        @endif
                                        @if ($business->insta_url)
                                            <a href="{{ $business->insta_url }}" class="text-pink-600 hover:text-pink-800" target="_blank">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        @endif
                                        @if ($business->linkden_url)
                                            <a href="{{ $business->linkden_url }}" class="text-blue-700 hover:text-blue-900" target="_blank">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        @endif
                                        @if ($business->twiter_url)
                                            <a href="{{ $business->twiter_url }}" class="text-blue-400 hover:text-blue-600" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif
                                        @if ($business->watsapp_url)
                                            <a href="{{ $business->watsapp_url }}" class="text-green-500 hover:text-green-700" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">{{ $business->rating ?? 'N/A' }}</td>
                    
                                <!-- Unique QR Code -->
                                <td class="">
                                    <div id="qr-code-{{ $business->id }}" class="mt-2 mb-2">
                                        {!! QrCode::size(200)
                                            ->backgroundColor(255, 255, 255)
                                            ->gradient(255, 0, 0, 0, 0, 255, 'diagonal')
                                            ->generate(route('business.qr', $business->custum_url ?? $business->id)) !!}
                                    </div>
                                    <button onclick="printQRCode({{ $business->id }})" class="mt-2 mb-2 px-3 py-1 text-white bg-gradient-to-r from-red-500 to-blue-500 hover:from-blue-500 hover:to-red-500 w-full">Print QR Code</button>
                                </td>
                    
                                <td class="py-3 px-4">
                                    @can('edit business')
                                        <a href="{{ route('business.edit', $business->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                                    @endcan
                                    @can('delete business')
                                        <form action="{{ route('business.delete', $business->id) }}" method="get" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endcan
                                    @can('rating business')
                                        <a href="{{ route('business.rating', $business->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Rating</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                    <!-- JavaScript to Print the QR Code -->
                    <script>
                        function printQRCode(id) {
                            var qrCodeContent = document.getElementById('qr-code-' + id).innerHTML;
                            var printWindow = window.open('', '_blank');
                    
                            printWindow.document.write('<html><head><title>Print QR Code</title></head><body>');
                            printWindow.document.write(qrCodeContent);
                            printWindow.document.write('</body></html>');
                            printWindow.document.close();
                    
                            // Ensure the QR code is fully loaded before printing
                            setTimeout(function () {
                                printWindow.print();
                                printWindow.close();
                            }, 500); // Delay of 500ms
                        }
                    </script>
                    
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
