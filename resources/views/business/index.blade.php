<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('Business Management') }}
            </h2>
            @can('create business')
                <a href="{{ route('business.create') }}"
                    class="px-5 py-2 bg-gradient-to-r from-[#c21108] to-[#000308] text-white font-semibold rounded-lg shadow-md hover:from-[#000308] hover:to-[#c21108] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c21108] transition duration-300 ease-in-out">
                    + Create
                </a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
            <!-- ✅ Success Message -->
            @if (session('success'))
                <div class="flex items-center bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-md">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
    
            <!-- ✅ Error Messages -->
            @if ($errors->any())
                <div class="flex items-start bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-md">
                    <svg class="w-6 h-6 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <ul class="text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="mb-1">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <!-- ✅ Business Table -->
            <div class="overflow-x-auto bg-white shadow-xl rounded-xl p-6 border border-gray-200">
                <table class="w-full text-sm text-left text-gray-800">
                    <thead class="bg-gray-100 uppercase text-gray-700 font-semibold text-xs">
                        <tr>
                            <th class="px-4 py-3">QR Count</th>
                            <th class="px-4 py-3">User Name</th>
                            <th class="px-4 py-3">Business Name</th>
                            <th class="px-4 py-3">Mobile</th>
                            <th class="px-4 py-3">Website</th>
                            <th class="px-4 py-3">Social Links</th>
                            <th class="px-4 py-3">Rating</th>
                            <th class="px-4 py-3">QR Code</th>
                            <th class="px-4 py-3">Created At</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($businesses as $business)
                            @php
                                $clicks = json_decode($business->social_clicks, true);
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium">Scans: {{ $business->qr_scan_count }}</td>
                                <td class="px-4 py-3">{{ $business->user->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $business->bussiness_name }}</td>
                                <td class="px-4 py-3">{{ $business->mobile_number ?? 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    @if ($business->website_url)
                                        <a href="{{ $business->website_url }}" class="text-blue-500 hover:underline" target="_blank">Visit</a>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
    
                                <!-- ✅ Social Clicks -->
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2 text-lg">
                                        @foreach (['fb_url' => 'facebook', 'insta_url' => 'instagram', 'linkden_url' => 'linkedin', 'twiter_url' => 'twitter', 'watsapp_url' => 'whatsapp'] as $key => $platform)
                                            @if ($business->$key)
                                                <a href="{{ $business->$key }}" target="_blank"
                                                    class="hover:scale-110 transition transform"
                                                    onclick="trackClick({{ $business->id }}, '{{ $key }}')">
                                                    <i class="fab fa-{{ $platform }} text-{{ $platform === 'whatsapp' ? 'green' : ($platform === 'instagram' ? 'pink' : ($platform === 'linkedin' ? 'blue-800' : 'blue-600')) }}"></i>
                                                    <span class="text-sm text-gray-500">({{ $clicks[$key] ?? 0 }})</span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
    
                                <!-- ✅ Rating -->
                                <td class="px-4 py-3">{{ $business->rating ?? 'N/A' }}</td>
    
                                <!-- ✅ QR Code -->
                                <td class="px-4 py-3 text-center">
                                    @can('show qr')
                                        <div id="qr-code-{{ $business->id }}" class="mb-2">
                                            {!! QrCode::size(150)->backgroundColor(255,255,255)->gradient(255,0,0,0,0,255,'diagonal')->generate(route('business.qr', $business->custum_url ?? $business->id)) !!}
                                        </div>
    
                                        <button onclick="printQRCode({{ $business->id }})"
                                            class="px-3 py-1 text-white bg-gradient-to-r from-red-500 to-blue-500 hover:from-blue-600 hover:to-red-600 rounded w-full text-xs">
                                            Print QR
                                        </button>
                                    @endcan
                                </td>
    
                                <!-- ✅ Created At -->
                                <td class="px-4 py-3 text-gray-600 text-sm">
                                    {{ $business->created_at->format('d M Y, h:i A') }}
                                </td>
    
                                <!-- ✅ Actions -->
                                <td class="px-4 py-3 text-center">
                                    <div class="flex flex-wrap justify-center gap-2">
                                        @can('edit business')
                                            <a href="{{ route('business.edit', $business->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded shadow">
                                                ✏️ Edit
                                            </a>
                                        @endcan
                                        @can('delete business')
                                            <form action="{{ route('business.delete', $business->id) }}" method="get" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded shadow"
                                                    onclick="return confirm('Are you sure?')">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        @endcan
                                        @can('rating business')
                                            <a href="{{ route('business.rating', $business->id) }}"
                                                class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded shadow">
                                                ⭐ Rating
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <!-- ✅ QR Print Script -->
            <script>
                function printQRCode(id) {
                    var qrCodeContent = document.getElementById('qr-code-' + id).innerHTML;
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write('<html><head><title>Print QR Code</title></head><body>');
                    printWindow.document.write(qrCodeContent);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    setTimeout(() => {
                        printWindow.print();
                        printWindow.close();
                    }, 500);
                }
            </script>
        </div>
    </div>
    
</x-app-layout>
