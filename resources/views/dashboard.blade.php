<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white bg-gradient-to-r from-[#c21108] to-[#000308] px-4 py-2 rounded-md shadow-md inline-block">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mt-10bg-red-400 px-32">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">📊 Business-wise Analytics</h3>
    
        @foreach ($businesses as $business)
            @php
                $clicks = json_decode($business->social_clicks, true) ?? [];
            @endphp
    
            <div class="bg-white  rounded-2xl shadow-md p-6 mb-6 border border-gray-100 w-full">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                      <!-- Go to QR Link -->
        <a href="{{ route('business.qr', $business->custum_url ?? $business->id) }}"
            target="_blank"
            class="inline-block bg-gradient-to-r from-red-600 to-blue-800 text-white px-4 py-2 rounded-md shadow hover:opacity-90 transition duration-200">
             🔗 Go to QR Page
         </a>
                    <h4 class="text-2xl font-semibold text-gray-800">{{ $business->bussiness_name }}</h4>
                    <div class="mt-2 md:mt-0 text-sm text-gray-500">Business ID: #{{ $business->bussiness_name }}</div>
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- QR SCANS -->
                    <div class="bg-blue-50 p-4 rounded-lg text-center shadow-sm">
                        <div class="text-gray-600 text-sm mb-1">Total QR Scans</div>
                        <div class="text-3xl font-bold text-blue-600">{{ $business->qr_scan_count }}</div>
                    </div>
    
                    <!-- Total Social Clicks -->
                    <div class="bg-green-50 p-4 rounded-lg text-center shadow-sm">
                        <div class="text-gray-600 text-sm mb-1">Total Social Clicks</div>
                        <div class="text-3xl font-bold text-green-600">
                            {{ array_sum($clicks) }}
                        </div>
                    </div>
    
                    <!-- Linked User -->
                    <div class="bg-gray-50 p-4 rounded-lg text-center shadow-sm">
                        <div class="text-gray-600 text-sm mb-1">Managed By</div>
                        <div class="text-lg font-medium text-gray-800">{{ $business->user->name ?? 'N/A' }}</div>
                    </div>
                </div>
    
                <!-- Social Click Breakdown -->
                <div class="mt-6">
                    <div class="text-sm text-gray-600 mb-2">Social Platform Clicks:</div>
                    <div class="flex flex-wrap gap-5 text-sm">
                        @if ($business->fb_url)
                            <div class="flex items-center gap-2 text-blue-600">
                                <i class="fab fa-facebook fa-lg"></i>
                                Facebook ({{ $clicks['fb_url'] ?? 0 }})
                            </div>
                        @endif
    
                        @if ($business->insta_url)
                            <div class="flex items-center gap-2 text-pink-600">
                                <i class="fab fa-instagram fa-lg"></i>
                                Instagram ({{ $clicks['insta_url'] ?? 0 }})
                            </div>
                        @endif
    
                        @if ($business->linkden_url)
                            <div class="flex items-center gap-2 text-blue-800">
                                <i class="fab fa-linkedin fa-lg"></i>
                                LinkedIn ({{ $clicks['linkden_url'] ?? 0 }})
                            </div>
                        @endif
    
                        @if ($business->twiter_url)
                            <div class="flex items-center gap-2 text-blue-400">
                                <i class="fab fa-twitter fa-lg"></i>
                                Twitter ({{ $clicks['twiter_url'] ?? 0 }})
                            </div>
                        @endif
    
                        @if ($business->watsapp_url)
                            <div class="flex items-center gap-2 text-green-600">
                                <i class="fab fa-whatsapp fa-lg"></i>
                                WhatsApp ({{ $clicks['watsapp_url'] ?? 0 }})
                            </div>
                        @endif

                        @if ($business->website_url)
                        <div class="flex items-center gap-2 text-green-600">
                            <i class="fas fa-globe fa-lg"></i>
                            Website ({{ $clicks['website_url'] ?? 0 }})
                        </div>
                    @endif
                    
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</x-app-layout>
