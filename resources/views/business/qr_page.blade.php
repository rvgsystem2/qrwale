@php
    $t = $business->template;
    $primary = $t?->primary_color ?? '#991b1b';
    $secondary = $t?->secondary_color ?? '#0f172a';
    $accent = $t?->accent_color ?? '#f59e0b';
    $background = $t?->background_color ?? '#fff7ed';
    $layout = $t?->layout ?? 'split';
    $card = $t?->card_style ?? 'soft';
    $mobile = preg_replace('/\D+/', '', $business->mobile_number ?? '');
    $links = array_filter(['website' => ['Website', $business->website_url, '🌐'], 'google' => ['Location', $business->google_map_url, '📍'], 'instagram' => ['Instagram', $business->insta_url, '◎'], 'facebook' => ['Facebook', $business->fb_url, 'f'], 'linkedin' => ['LinkedIn', $business->linkden_url, 'in'], 'twitter' => ['X / Twitter', $business->twiter_url, '𝕏'], 'youtube' => ['YouTube', $business->youtube_url, '▶'], 'review' => ['Review us', $business->review_url, '★']], fn($v) => filled($v[1]));
    $detail = ['contact_person' => 'Contact person', 'mobile_number' => 'Mobile', 'alternate_mobile' => 'Alternate mobile', 'email' => 'Email', 'address' => 'Address', 'opening_hours' => 'Opening hours', 'gstin' => 'GSTIN / UIN', 'msme_number' => 'MSME Reg. No.'];
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="{{ $primary }}">
    <title>{{ $business->bussiness_name }}</title>
    <meta name="description" content="{{ $business->tagline ?: Str::limit($business->description, 150) }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            -webkit-tap-highlight-color: transparent
        }

        .glass {
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(18px)
        }
    </style>
</head>

<body class="min-h-screen text-slate-800" style="background:{{ $background }}">
    <main class="mx-auto flex min-h-screen max-w-6xl items-center justify-center p-4 sm:p-7">
        <section class="glass w-full overflow-hidden rounded-[2rem] border border-white/70 shadow-2xl">
            <div class="h-2" style="background:linear-gradient(90deg,{{ $primary }},{{ $accent }})"></div>
            <div class="{{ $layout === 'split' ? 'lg:grid lg:grid-cols-[.9fr_1.1fr]' : '' }}">
                <header
                    class="relative overflow-hidden px-6 py-10 text-center text-white sm:px-10 {{ $layout === 'split' ? 'lg:flex lg:flex-col lg:justify-center' : ' ' }}"
                    style="background:linear-gradient(135deg,{{ $primary }},{{ $secondary }})">
                    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full opacity-20 blur-3xl"
                        style="background:{{ $accent }}"></div>
                    <div class="relative">
                        @if ($business->logo_url)
                            <img src="{{ $business->logo_url }}"
                                class="mx-auto h-32 w-32 rounded-full border-4 border-white bg-white object-contain shadow-2xl"
                                alt="Logo">
                            @endif @if ($business->business_category)
                                <p class="mt-5 text-xs font-bold uppercase tracking-[.25em]"
                                    style="color:{{ $accent }}">{{ $business->business_category }}</p>
                            @endif
                            <h1 class="mt-2 text-3xl font-black sm:text-4xl">
                                {{ $business->bussiness_name }}</h1>
                            @if ($business->tagline)
                                <p class="mx-auto mt-3 max-w-lg text-sm text-white/80">{{ $business->tagline }}</p>
                                @endif @if ($business->description)
                                    <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-white/70">
                                        {{ $business->description }}</p>
                                @endif
                                <div class="mx-auto mt-7 grid max-w-md grid-cols-2 gap-3">
                                    @if ($mobile)
                                        <a data-track="call" href="tel:+{{ $mobile }}"
                                            class="rounded-2xl bg-white px-3 py-3.5 font-bold"
                                            style="color:{{ $primary }}">☎ Call now</a>
                                        @endif @if ($business->whatsapp_number)
                                            <a data-track="whatsapp"
                                                href="https://wa.me/{{ $business->whatsapp_number }}" target="_blank"
                                                class="rounded-2xl bg-emerald-500 px-3 py-3.5 font-bold text-white">WhatsApp</a>
                                        @endif
                                </div>
                    </div>
                </header>
                <div class="p-5 sm:p-9">
                    <h2 class="text-xl font-black">Business details</h2>
                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        @foreach ($detail as $field => $label)
                            @if (filled($business->{$field}))
                                <div
                                    class="rounded-2xl p-4 {{ $card === 'bordered' ? 'border-2 bg-white' : ($card === 'glass' ? 'border bg-white/80 shadow-sm' : 'bg-slate-50') }} {{ $field === 'address' ? 'sm:col-span-2' : '' }}">
                                    <p class="text-xs font-bold uppercase tracking-wider"
                                        style="color:{{ $primary }}">{{ $label }}</p>
                                    @if ($field === 'email')
                                        <a href="mailto:{{ $business->{$field} }}"
                                        class="mt-1.5 block break-all text-sm font-bold">{{ $business->{$field} }}</a>@else
                                        <p class="mt-1.5 break-words text-sm font-semibold leading-6">
                                            {{ $business->{$field} }}</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @if (count($links))
                        <h2 class="mt-7 text-lg font-black">Connect with us</h2>
                        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            @foreach ($links as $platform => [$label, $url, $icon])
                                <a data-track="{{ $platform }}" href="{{ $url }}" target="_blank"
                                    rel="noopener"
                                    class="rounded-2xl border bg-white p-4 text-center shadow-sm transition hover:-translate-y-1"><span
                                        class="mx-auto grid h-10 w-10 place-items-center rounded-full text-lg font-black text-white"
                                        style="background:{{ $primary }}">{{ $icon }}</span><b
                                        class="mt-2 block text-sm">{{ $label }}</b></a>
                            @endforeach
                        </div>
                        @endif @if ($business->rating)
                            <p class="mt-6 text-center font-black" style="color:{{ $accent }}">★★★★★ <span
                                    class="text-slate-700">{{ number_format($business->rating, 1) }}/5</span></p>
                        @endif
                        <button onclick="shareBusiness()" class="mt-6 w-full rounded-2xl border-2 px-5 py-3.5 font-bold"
                            style="border-color:{{ $primary }};color:{{ $primary }}">
                            Share business profile</button>
                </div>
            </div>
            <footer class="border-t bg-white/60 p-4 text-center text-xs text-slate-500">© {{ date('Y') }}
                {{ $business->bussiness_name }}</footer>
        </section>
    </main>
    @unless ($previewMode ?? false)
        <script>
            document.querySelectorAll('[data-track]').forEach(a => a.addEventListener('click', () => fetch(
                @json(route('business.trackClick', $business->id)), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': @json(csrf_token())
                    },
                    body: JSON.stringify({
                        platform: a.dataset.track
                    }),
                    keepalive: true
                }).catch(() => {})));
            async function shareBusiness() {
                let d = {
                    title: @json($business->bussiness_name),
                    text: @json($business->tagline ?: 'View our business profile'),
                    url: location.href
                };
                if (navigator.share) {
                    try {
                        await navigator.share(d)
                    } catch (e) {}
                } else {
                    await navigator.clipboard.writeText(location.href);
                    alert('Profile link copied!')
                }
            }
        </script>
    @endunless
</body>

</html>
