<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 rounded-2xl bg-white px-5 py-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">
                    {{ __('Dashboard') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    QR scans aur business profile clicks ki report
                </p>
            </div>

            @can('create business')
                <a
                    href="{{ route('business.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-red-700 to-slate-950 px-5 py-3 text-sm font-bold text-white shadow-md transition hover:-translate-y-0.5 hover:shadow-lg"
                >
                    + Create Business
                </a>
            @endcan
        </div>
    </x-slot>

    @php
        /*
         * Controller se ye variables mil rahe hain:
         * $totalBusinesses
         * $totalScans
         * $totalSocialClicks
         * $businesses
         */
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 font-semibold text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Overall statistics --}}
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 to-slate-700 p-6 text-white shadow-lg">
                    <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-white/10"></div>

                    <div class="relative">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-2xl">
                            🏢
                        </div>

                        <p class="mt-5 text-sm font-semibold text-slate-300">
                            Total Businesses
                        </p>

                        <p class="mt-1 text-4xl font-black">
                            {{ number_format($totalBusinesses ?? $businesses->count()) }}
                        </p>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-700 to-indigo-900 p-6 text-white shadow-lg">
                    <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-white/10"></div>

                    <div class="relative">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-2xl">
                            ▦
                        </div>

                        <p class="mt-5 text-sm font-semibold text-blue-100">
                            Total QR Scans
                        </p>

                        <p class="mt-1 text-4xl font-black">
                            {{ number_format($totalScans ?? 0) }}
                        </p>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 to-teal-900 p-6 text-white shadow-lg sm:col-span-2 lg:col-span-1">
                    <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-white/10"></div>

                    <div class="relative">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-2xl">
                            ↗
                        </div>

                        <p class="mt-5 text-sm font-semibold text-emerald-100">
                            Total Profile Clicks
                        </p>

                        <p class="mt-1 text-4xl font-black">
                            {{ number_format($totalSocialClicks ?? 0) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-6 mt-10 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-red-700">
                        Analytics
                    </p>

                    <h3 class="mt-1 text-2xl font-black text-slate-900">
                        Business-wise report
                    </h3>
                </div>

                <p class="text-sm text-slate-500">
                    {{ $businesses->count() }} business records
                </p>
            </div>

            <div class="space-y-6">
                @forelse ($businesses as $business)
                    @php
                        /*
                         * social_clicks kabhi JSON string aur kabhi array ho sakta hai.
                         * Yeh code dono formats ko support karta hai.
                         */
                        $rawClicks = $business->social_clicks;

                        if (is_array($rawClicks)) {
                            $clicks = $rawClicks;
                        } elseif (is_string($rawClicks) && filled($rawClicks)) {
                            $clicks = json_decode($rawClicks, true);

                            if (!is_array($clicks)) {
                                $clicks = [];
                            }
                        } else {
                            $clicks = [];
                        }

                        /*
                         * New aur old tracking keys ko support karna.
                         * Purane clients ke existing analytics bhi show honge.
                         */
                        $clickCount = function (array $keys) use ($clicks) {
                            return collect($keys)->sum(function ($key) use ($clicks) {
                                return (int) ($clicks[$key] ?? 0);
                            });
                        };

                        $facebookClicks = $clickCount(['facebook', 'fb_url']);
                        $instagramClicks = $clickCount(['instagram', 'insta_url']);
                        $linkedinClicks = $clickCount(['linkedin', 'linkden_url']);
                        $twitterClicks = $clickCount(['twitter', 'twiter_url']);
                        $whatsappClicks = $clickCount(['whatsapp', 'watsapp_url']);
                        $websiteClicks = $clickCount(['website', 'website_url']);
                        $googleClicks = $clickCount(['google', 'google_map_url']);
                        $youtubeClicks = $clickCount(['youtube', 'youtube_url']);
                        $reviewClicks = $clickCount(['review', 'review_url']);
                        $callClicks = $clickCount(['call', 'mobile_number']);

                        $businessTotalClicks =
                            $facebookClicks +
                            $instagramClicks +
                            $linkedinClicks +
                            $twitterClicks +
                            $whatsappClicks +
                            $websiteClicks +
                            $googleClicks +
                            $youtubeClicks +
                            $reviewClicks +
                            $callClicks;

                        $identifier = filled($business->custum_url)
                            ? $business->custum_url
                            : $business->id;
                    @endphp

                    <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg">

                        {{-- Business heading --}}
                        <div class="border-b border-slate-100 bg-gradient-to-r from-red-50 via-white to-amber-50 p-5 sm:p-6">
                            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                                <div class="flex min-w-0 items-center gap-4">
                                    @if ($business->logo_url)
                                        <img
                                            src="{{ $business->logo_url }}"
                                            alt="{{ $business->bussiness_name }}"
                                            class="h-16 w-16 flex-none rounded-2xl border border-slate-200 bg-white object-contain p-1 shadow-sm"
                                        >
                                    @else
                                        <div class="flex h-16 w-16 flex-none items-center justify-center rounded-2xl bg-gradient-to-br from-red-700 to-slate-950 text-2xl font-black text-white shadow-sm">
                                            {{ strtoupper(substr($business->bussiness_name ?? 'B', 0, 1)) }}
                                        </div>
                                    @endif

                                    <div class="min-w-0">
                                        <h4 class="truncate text-xl font-black text-slate-900 sm:text-2xl">
                                            {{ $business->bussiness_name }}
                                        </h4>

                                        <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-500">
                                            <span>ID: #{{ $business->id }}</span>

                                            @if ($business->template)
                                                <span>•</span>
                                                <span>
                                                    Template: {{ $business->template->name }}
                                                </span>
                                            @endif

                                            @if ($business->business_category)
                                                <span>•</span>
                                                <span>{{ $business->business_category }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <a
                                        href="{{ route('business.qr', $identifier) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-red-700 to-slate-950 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5"
                                    >
                                        View QR Profile ↗
                                    </a>

                                    @can('edit business')
                                        <a
                                            href="{{ route('business.edit', $business) }}"
                                            class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 transition hover:border-red-700 hover:text-red-700"
                                        >
                                            Edit Business
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="p-5 sm:p-6">

                            {{-- {{-- Business statistics --}}
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                                <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-500">
                                                QR Scans
                                            </p>

                                            <p class="mt-1 text-3xl font-black text-blue-700">
                                                {{ number_format($business->qr_scan_count ?? 0) }}
                                            </p>
                                        </div>

                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-xl text-white">
                                            ▦
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-500">
                                                Profile Clicks
                                            </p>

                                            <p class="mt-1 text-3xl font-black text-emerald-700">
                                                {{ number_format($businessTotalClicks) }}
                                            </p>
                                        </div>

                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-xl text-white">
                                            ↗
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-violet-100 bg-violet-50 p-5 sm:col-span-2 lg:col-span-1">
                                    <div class="flex items-center justify-between">
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-slate-500">
                                                Managed By
                                            </p>

                                            <p class="mt-1 truncate text-lg font-black text-slate-800">
                                                {{ $business->user?->name ?? 'N/A' }}
                                            </p>
                                        </div>

                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-600 text-xl text-white">
                                            👤
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Platform breakdown --}}
                            <div class="mt-7">
                                <div class="mb-4 flex items-center justify-between">
                                    <h5 class="font-black text-slate-900">
                                        Platform click breakdown
                                    </h5>

                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                                        {{ number_format($businessTotalClicks) }} total
                                    </span>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

                                    @if ($business->mobile_number)
                                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                            <p class="text-sm font-bold text-slate-700">☎ Call</p>
                                            <p class="mt-2 text-2xl font-black text-slate-900">
                                                {{ number_format($callClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->watsapp_url)
                                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                                            <p class="text-sm font-bold text-emerald-700">WhatsApp</p>
                                            <p class="mt-2 text-2xl font-black text-emerald-800">
                                                {{ number_format($whatsappClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->website_url)
                                        <div class="rounded-2xl border border-cyan-200 bg-cyan-50 p-4">
                                            <p class="text-sm font-bold text-cyan-700">🌐 Website</p>
                                            <p class="mt-2 text-2xl font-black text-cyan-800">
                                                {{ number_format($websiteClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->google_map_url)
                                        <div class="rounded-2xl border border-red-200 bg-red-50 p-4">
                                            <p class="text-sm font-bold text-red-700">📍 Location</p>
                                            <p class="mt-2 text-2xl font-black text-red-800">
                                                {{ number_format($googleClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->fb_url)
                                        <div class="rounded-2xl border border-blue-200 bg-blue-50 p-4">
                                            <p class="text-sm font-bold text-blue-700">Facebook</p>
                                            <p class="mt-2 text-2xl font-black text-blue-800">
                                                {{ number_format($facebookClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->insta_url)
                                        <div class="rounded-2xl border border-pink-200 bg-pink-50 p-4">
                                            <p class="text-sm font-bold text-pink-700">Instagram</p>
                                            <p class="mt-2 text-2xl font-black text-pink-800">
                                                {{ number_format($instagramClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->linkden_url)
                                        <div class="rounded-2xl border border-sky-200 bg-sky-50 p-4">
                                            <p class="text-sm font-bold text-sky-700">LinkedIn</p>
                                            <p class="mt-2 text-2xl font-black text-sky-800">
                                                {{ number_format($linkedinClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->twiter_url)
                                        <div class="rounded-2xl border border-slate-300 bg-slate-50 p-4">
                                            <p class="text-sm font-bold text-slate-700">X / Twitter</p>
                                            <p class="mt-2 text-2xl font-black text-slate-900">
                                                {{ number_format($twitterClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->youtube_url)
                                        <div class="rounded-2xl border border-red-200 bg-red-50 p-4">
                                            <p class="text-sm font-bold text-red-700">YouTube</p>
                                            <p class="mt-2 text-2xl font-black text-red-800">
                                                {{ number_format($youtubeClicks) }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($business->review_url)
                                        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4">
                                            <p class="text-sm font-bold text-amber-700">★ Reviews</p>
                                            <p class="mt-2 text-2xl font-black text-amber-800">
                                                {{ number_format($reviewClicks) }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border-2 border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                        <div class="text-5xl">🏢</div>

                        <h3 class="mt-5 text-xl font-black text-slate-900">
                            No business found
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Analytics dekhne ke liye pehle ek business create karein.
                        </p>

                        @can('create business')
                            <a
                                href="{{ route('business.create') }}"
                                class="mt-6 inline-flex rounded-xl bg-red-700 px-5 py-3 font-bold text-white"
                            >
                                Create Business
                            </a>
                        @endcan
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
