@php
    $mobileNumber = preg_replace('/\D+/', '', $business->mobile_number ?? '');
    $alternateMobile = preg_replace('/\D+/', '', $business->alternate_mobile ?? '');

    $whatsappNumber = preg_replace(
        '/\D+/',
        '',
        $business->watsapp_url ?: $business->mobile_number ?: ''
    );

    if (strlen($whatsappNumber) === 10) {
        $whatsappNumber = '91' . $whatsappNumber;
    }

    $description = $business->tagline
        ?: $business->description
        ?: 'Connect with us for more information about our products and services.';
@endphp

@php
    $template = $business->template;

    $primaryColor = $template?->primary_color
        ?: '#047857';

    $secondaryColor = $template?->secondary_color
        ?: '#0f172a';

    $accentColor = $template?->accent_color
        ?: '#f59e0b';

    $backgroundColor = $template?->background_color
        ?: '#ecfdf5';
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta name="theme-color" content="#09090b">

    <title>{{ $business->bussiness_name }}</title>

    <meta
        name="description"
        content="{{ Str::limit(strip_tags($description), 155) }}"
    >

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#d4af37',
                            600: '#b68a17',
                            700: '#8a6812'
                        }
                    },

                    boxShadow: {
                        luxury: '0 30px 90px rgba(0, 0, 0, 0.55)',
                        gold: '0 14px 35px rgba(212, 175, 55, 0.18)'
                    }
                }
            }
        };
    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            -webkit-tap-highlight-color: transparent;
        }

        .luxury-background {
            background:
                radial-gradient(circle at 15% 10%, rgba(212, 175, 55, 0.12), transparent 25%),
                radial-gradient(circle at 85% 85%, rgba(180, 131, 20, 0.10), transparent 25%),
                linear-gradient(145deg, #050505, #111111 50%, #050505);
        }

        .gold-text {
            background: linear-gradient(
                110deg,
                #8a6812,
                #f8e7a1,
                #d4af37,
                #fff0ad,
                #9b7417
            );

            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .gold-border {
            border-color: rgba(212, 175, 55, 0.28);
        }

        .luxury-card {
            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.055),
                    rgba(255, 255, 255, 0.015)
                );

            backdrop-filter: blur(16px);
        }

        .shine-button {
            position: relative;
            overflow: hidden;
        }

        .shine-button::after {
            position: absolute;
            top: -100%;
            left: -60%;
            width: 40%;
            height: 300%;
            content: '';
            background: rgba(255, 255, 255, 0.28);
            transform: rotate(25deg);
            transition: left 0.6s ease;
        }

        .shine-button:hover::after {
            left: 130%;
        }
    </style>
</head>

<body class="luxury-background min-h-screen text-zinc-200">

    <main class="mx-auto min-h-screen max-w-5xl px-4 py-6 sm:px-6 sm:py-10">

        <section
            class="relative overflow-hidden rounded-[2rem] border gold-border bg-zinc-950/95 shadow-luxury"
        >
            {{-- Decorative background --}}
            <div
                class="pointer-events-none absolute -right-32 -top-32 h-80 w-80 rounded-full bg-gold-500/10 blur-3xl"
            ></div>

            <div
                class="pointer-events-none absolute -bottom-32 -left-32 h-80 w-80 rounded-full bg-amber-700/10 blur-3xl"
            ></div>

            {{-- Top golden border --}}
            <div
                class="h-1.5 bg-gradient-to-r from-transparent via-gold-400 to-transparent"
            ></div>

            {{-- Header --}}
            <header
                class="relative overflow-hidden border-b gold-border px-5 py-10 text-center sm:px-10 sm:py-14"
            >
                <div
                    class="absolute inset-0 bg-gradient-to-br from-black via-zinc-900/90 to-amber-950/40"
                ></div>

                <div class="relative z-10">

                    @if($business->logo_url)
                        <div class="relative mx-auto w-fit">
                            <div
                                class="absolute -inset-3 rounded-full bg-gold-400/20 blur-xl"
                            ></div>

                            <img
                                src="{{ $business->logo_url }}"
                                alt="{{ $business->bussiness_name }} logo"
                                class="relative mx-auto h-28 w-28 rounded-full border-4 border-gold-400 bg-white object-contain p-1 shadow-gold sm:h-36 sm:w-36"
                            >
                        </div>
                    @else
                        <div
                            class="mx-auto grid h-28 w-28 place-items-center rounded-full border-4 border-gold-400 bg-zinc-900 text-4xl font-black text-gold-400 shadow-gold sm:h-36 sm:w-36"
                        >
                            {{ Str::upper(Str::substr($business->bussiness_name, 0, 1)) }}
                        </div>
                    @endif

                    @if($business->business_category)
                        <p
                            class="mt-7 text-xs font-black uppercase tracking-[0.32em] text-gold-400"
                        >
                            {{ $business->business_category }}
                        </p>
                    @endif

                    <h1
                        class="gold-text mx-auto mt-3 max-w-3xl text-3xl font-black leading-tight sm:text-5xl"
                    >
                        {{ $business->bussiness_name }}
                    </h1>

                    @if($business->tagline)
                        <div class="mx-auto mt-4 flex max-w-xl items-center gap-3">
                            <span
                                class="h-px flex-1 bg-gradient-to-r from-transparent to-gold-500/60"
                            ></span>

                            <p class="text-sm font-bold text-amber-100 sm:text-base">
                                {{ $business->tagline }}
                            </p>

                            <span
                                class="h-px flex-1 bg-gradient-to-l from-transparent to-gold-500/60"
                            ></span>
                        </div>
                    @endif

                    @if($business->description)
                        <p
                            class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-zinc-400 sm:text-base"
                        >
                            {{ $business->description }}
                        </p>
                    @endif

                    {{-- Primary action buttons --}}
                    <div
                        class="mx-auto mt-8 grid max-w-xl gap-3 sm:grid-cols-2"
                    >
                        @if($mobileNumber)
                            <a
                                href="tel:+{{ $mobileNumber }}"
                                data-track="call"
                                class="shine-button flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-gold-600 via-gold-400 to-amber-500 px-5 py-4 font-black text-black shadow-gold transition hover:-translate-y-1"
                            >
                                <span class="text-xl">☎</span>
                                <span>Call Now</span>
                            </a>
                        @endif

                        @if($whatsappNumber)
                            <a
                                href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello '.$business->bussiness_name.', I would like to know more about your products and services.') }}"
                                target="_blank"
                                rel="noopener"
                                data-track="whatsapp"
                                class="shine-button flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-5 py-4 font-black text-white shadow-lg transition hover:-translate-y-1 hover:bg-emerald-600"
                            >
                                <span class="text-xl">◉</span>
                                <span>WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>
            </header>

            <div class="relative z-10 px-5 py-7 sm:px-8 sm:py-10">

                {{-- Business details --}}
                <section>
                    <div class="mb-5 flex items-center gap-3">
                        <div
                            class="grid h-10 w-10 place-items-center rounded-xl border gold-border bg-gold-500/10 text-xl"
                        >
                            ◆
                        </div>

                        <div>
                            <p
                                class="text-xs font-black uppercase tracking-[0.2em] text-gold-400"
                            >
                                Information
                            </p>

                            <h2 class="text-xl font-black text-white">
                                Business Details
                            </h2>
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">

                        @if($business->contact_person)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    Contact Person
                                </p>

                                <p class="mt-2 font-bold text-white">
                                    {{ $business->contact_person }}
                                </p>
                            </div>
                        @endif

                        @if($business->mobile_number)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    Mobile Number
                                </p>

                                <a
                                    href="tel:{{ $business->mobile_number }}"
                                    data-track="call"
                                    class="mt-2 block font-bold text-white hover:text-gold-400"
                                >
                                    {{ $business->mobile_number }}
                                </a>
                            </div>
                        @endif

                        @if($business->alternate_mobile)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    Alternate Mobile
                                </p>

                                <a
                                    href="tel:{{ $business->alternate_mobile }}"
                                    data-track="call"
                                    class="mt-2 block font-bold text-white hover:text-gold-400"
                                >
                                    {{ $business->alternate_mobile }}
                                </a>
                            </div>
                        @endif

                        @if($business->email)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    Email Address
                                </p>

                                <a
                                    href="mailto:{{ $business->email }}"
                                    class="mt-2 block break-all font-bold text-white hover:text-gold-400"
                                >
                                    {{ $business->email }}
                                </a>
                            </div>
                        @endif

                        @if($business->opening_hours)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    Opening Hours
                                </p>

                                <p class="mt-2 font-bold text-white">
                                    {{ $business->opening_hours }}
                                </p>
                            </div>
                        @endif

                        @if($business->rating)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    Customer Rating
                                </p>

                                <div class="mt-2 flex items-center gap-2">
                                    <span class="tracking-wider text-gold-400">
                                        ★★★★★
                                    </span>

                                    <strong class="text-white">
                                        {{ number_format((float) $business->rating, 1) }}/5
                                    </strong>
                                </div>
                            </div>
                        @endif

                        @if($business->gstin)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    GSTIN / UIN
                                </p>

                                <p class="mt-2 break-all font-bold text-white">
                                    {{ $business->gstin }}
                                </p>
                            </div>
                        @endif

                        @if($business->msme_number)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-gold-400"
                                >
                                    MSME Registration No.
                                </p>

                                <p class="mt-2 break-all font-bold text-white">
                                    {{ $business->msme_number }}
                                </p>
                            </div>
                        @endif

                        @if($business->address)
                            <div
                                class="luxury-card rounded-2xl border gold-border p-5 md:col-span-2"
                            >
                                <div
                                    class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                                >
                                    <div>
                                        <p
                                            class="text-xs font-black uppercase tracking-wider text-gold-400"
                                        >
                                            Business Address
                                        </p>

                                        <p class="mt-2 leading-7 text-zinc-200">
                                            {{ $business->address }}
                                        </p>
                                    </div>

                                    @if($business->google_map_url)
                                        <a
                                            href="{{ $business->google_map_url }}"
                                            target="_blank"
                                            rel="noopener"
                                            data-track="google"
                                            class="shrink-0 rounded-xl border border-gold-500/40 bg-gold-500/10 px-4 py-3 text-center text-sm font-bold text-gold-300 transition hover:bg-gold-500 hover:text-black"
                                        >
                                            📍 Get Directions
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </section>


                @if($business->products->isNotEmpty())
    <section class="mt-10">
        <div class="mb-6 text-center">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-gold-400">
                Our Collection
            </p>

            <h2 class="gold-text mt-2 text-3xl font-black">
                Featured Products
            </h2>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($business->products as $product)
                <article
                    class="group overflow-hidden rounded-2xl border gold-border bg-zinc-900/80 shadow-gold"
                >
                    <div class="relative aspect-square overflow-hidden bg-white">
                        <img
                            src="{{ $product->image_url }}"
                            alt="{{ $product->name }}"
                            loading="lazy"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >

                        @if($product->offer_price)
                            <span
                                class="absolute left-3 top-3 rounded-full bg-red-600 px-3 py-1 text-xs font-black text-white"
                            >
                                Special Offer
                            </span>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-black text-white">
                            {{ $product->name }}
                        </h3>

                        @if($product->description)
                            <p class="mt-2 line-clamp-3 text-sm leading-6 text-zinc-400">
                                {{ $product->description }}
                            </p>
                        @endif

                        @if($product->price || $product->offer_price)
                            <div class="mt-4 flex items-center gap-3">
                                @if($product->offer_price)
                                    <span class="text-xl font-black text-gold-400">
                                        ₹{{ number_format($product->offer_price, 2) }}
                                    </span>

                                    @if($product->price)
                                        <span class="text-sm text-zinc-500 line-through">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-xl font-black text-gold-400">
                                        ₹{{ number_format($product->price, 2) }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        @php
                            $productButtonUrl = $product->button_url;

                            if (!$productButtonUrl && $business->whatsapp_number) {
                                $productButtonUrl =
                                    'https://wa.me/' .
                                    $business->whatsapp_number .
                                    '?text=' .
                                    urlencode(
                                        'Hello ' .
                                        $business->bussiness_name .
                                        ', I am interested in ' .
                                        $product->name
                                    );
                            }
                        @endphp

                        @if($productButtonUrl)
                            <a
                                href="{{ $productButtonUrl }}"
                                target="_blank"
                                rel="noopener"
                                data-track="whatsapp"
                                class="mt-5 block rounded-xl bg-gradient-to-r from-gold-600 to-gold-400 px-4 py-3 text-center text-sm font-black text-black"
                            >
                                {{ $product->button_text ?: 'Enquire Now' }}
                            </a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endif

                {{-- Social links --}}
                @if(
                    $business->website_url ||
                    $business->google_map_url ||
                    $business->insta_url ||
                    $business->fb_url ||
                    $business->linkden_url ||
                    $business->twiter_url ||
                    $business->youtube_url ||
                    $business->review_url
                )
                    <section class="mt-10">
                        <div class="mb-5 text-center">
                            <p
                                class="text-xs font-black uppercase tracking-[0.2em] text-gold-400"
                            >
                                Stay Connected
                            </p>

                            <h2 class="mt-1 text-2xl font-black text-white">
                                Connect With Us
                            </h2>
                        </div>

                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">

                            @if($business->website_url)
                                <a
                                    href="{{ $business->website_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="website"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-blue-500/15 text-2xl"
                                    >
                                        🌐
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        Website
                                    </span>
                                </a>
                            @endif

                            @if($business->google_map_url)
                                <a
                                    href="{{ $business->google_map_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="google"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-red-500/15 text-2xl"
                                    >
                                        📍
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        Location
                                    </span>
                                </a>
                            @endif

                            @if($business->insta_url)
                                <a
                                    href="{{ $business->insta_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="instagram"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-gradient-to-br from-purple-600 via-pink-500 to-amber-400 text-xl font-black text-white"
                                    >
                                        ◎
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        Instagram
                                    </span>
                                </a>
                            @endif

                            @if($business->fb_url)
                                <a
                                    href="{{ $business->fb_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="facebook"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-blue-600 text-xl font-black text-white"
                                    >
                                        f
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        Facebook
                                    </span>
                                </a>
                            @endif

                            @if($business->linkden_url)
                                <a
                                    href="{{ $business->linkden_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="linkedin"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-blue-700 text-sm font-black text-white"
                                    >
                                        in
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        LinkedIn
                                    </span>
                                </a>
                            @endif

                            @if($business->twiter_url)
                                <a
                                    href="{{ $business->twiter_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="twitter"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-white text-xl font-black text-black"
                                    >
                                        𝕏
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        X / Twitter
                                    </span>
                                </a>
                            @endif

                            @if($business->youtube_url)
                                <a
                                    href="{{ $business->youtube_url }}"
                                    target="_blank"
                                    rel="noopener"
                                   data-track="youtube"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-red-600 text-lg font-black text-white"
                                    >
                                        ▶
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        YouTube
                                    </span>
                                </a>
                            @endif

                            @if($business->review_url)
                                <a
                                    href="{{ $business->review_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="review"
                                    class="luxury-card group rounded-2xl border gold-border p-4 text-center transition hover:-translate-y-1 hover:border-gold-400"
                                >
                                    <span
                                        class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-gold-500 text-xl font-black text-black"
                                    >
                                        ★
                                    </span>

                                    <span class="mt-3 block text-sm font-bold text-white">
                                        Review Us
                                    </span>
                                </a>
                            @endif
                        </div>
                    </section>
                @endif

                {{-- Bottom buttons --}}
                <section class="mt-10 grid gap-3 sm:grid-cols-2">
                    <button
                        type="button"
                        onclick="shareBusiness()"
                        class="rounded-2xl border border-gold-500/50 bg-gold-500/10 px-5 py-4 font-black text-gold-300 transition hover:bg-gold-500 hover:text-black"
                    >
                        ↗ Share Business Profile
                    </button>

                    @if($business->review_url)
                        <a
                            href="{{ $business->review_url }}"
                            target="_blank"
                            rel="noopener"
                            data-track="review"
                            class="rounded-2xl bg-white px-5 py-4 text-center font-black text-black transition hover:bg-gold-400"
                        >
                            ★ Give Your Review
                        </a>
                    @else
                        <a
                            href="{{ route('business.rating', $business->id) }}"
                            class="rounded-2xl bg-white px-5 py-4 text-center font-black text-black transition hover:bg-gold-400"
                        >
                            ★ Give Your Review
                        </a>
                    @endif
                </section>
            </div>

            <footer
                class="relative z-10 border-t gold-border bg-black/50 px-5 py-5 text-center"
            >
                <p class="text-xs text-zinc-500">
                    © {{ date('Y') }}
                    <span class="font-bold text-gold-400">
                        {{ $business->bussiness_name }}
                    </span>
                    · All rights reserved
                </p>
            </footer>
        </section>
    </main>

    <div
        id="shareMessage"
        class="fixed bottom-5 left-1/2 hidden -translate-x-1/2 rounded-xl bg-emerald-500 px-5 py-3 text-sm font-bold text-white shadow-2xl"
    >
        Profile link copied successfully!
    </div>

    <script>
        document.querySelectorAll('[data-track]').forEach((element) => {
            element.addEventListener('click', function () {
                fetch(@json(route('business.trackClick', $business->id)), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json/json',
                        'X-CSRF-TOKEN': @json(csrf_token())
                    },
                    body: JSON.stringify({
                        platform: element.dataset.track
                    }),
                    keepalive: true
                }).catch(() => {});
            });
        });

        async function shareBusiness() {
            const shareData = {
                title: @json($business->bussiness_name),
                text: @json($business->tagline ?: 'View our business profile'),
                url: window.location.href
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                    return;
                }

                await navigator.clipboard.writeText(window.location.href);

                const message = document.getElementById('shareMessage');

                message.classList.remove('hidden');

                setTimeout(() => {
                    message.classList.add('hidden');
                }, 2500);
            } catch (error) {
                // User cancelled share dialog.
            }
        }
    </script>
</body>

</html>
