@php
    $mobileNumber = preg_replace(
        '/\D+/',
        '',
        $business->mobile_number ?? ''
    );

    $whatsappNumber = preg_replace(
        '/\D+/',
        '',
        $business->watsapp_url
            ?: $business->mobile_number
            ?: ''
    );

    if (strlen($whatsappNumber) === 10) {
        $whatsappNumber = '91' . $whatsappNumber;
    }

    $initial = Str::upper(
        Str::substr($business->bussiness_name ?? 'S', 0, 1)
    );

    $products = $business->relationLoaded('products')
        ? $business->products
        : collect();

    $pageDescription = $business->tagline
        ?: $business->description
        ?: 'Professional solar energy solutions for homes and businesses.';
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

    <meta name="theme-color" content="#047857">

    <title>{{ $business->bussiness_name }}</title>

    <meta
        name="description"
        content="{{ Str::limit(strip_tags($pageDescription), 155) }}"
    >

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        solar: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b'
                        },

                        sun: {
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706'
                        }
                    },

                    boxShadow: {
                        premium: '0 30px 90px rgba(6, 78, 59, 0.18)',
                        solar: '0 16px 40px rgba(5, 150, 105, 0.18)'
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

        .solar-page-bg {
            background:
                radial-gradient(
                    circle at 10% 5%,
                    rgba(251, 191, 36, 0.18),
                    transparent 22%
                ),
                radial-gradient(
                    circle at 90% 85%,
                    rgba(16, 185, 129, 0.18),
                    transparent 25%
                ),
                linear-gradient(
                    145deg,
                    #ecfdf5,
                    #ffffff 48%,
                    #eff6ff
                );
        }

        .hero-background {
            background:
                radial-gradient(
                    circle at 85% 10%,
                    rgba(251, 191, 36, 0.3),
                    transparent 25%
                ),
                linear-gradient(
                    135deg,
                    #064e3b,
                    #047857 55%,
                    #0284c7
                );
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(18px);
        }

        .sun-glow {
            box-shadow:
                0 0 0 12px rgba(251, 191, 36, 0.09),
                0 0 55px rgba(251, 191, 36, 0.38);
        }

        .shine-button {
            position: relative;
            overflow: hidden;
        }

        .shine-button::after {
            position: absolute;
            top: -100%;
            left: -60%;
            width: 38%;
            height: 300%;
            content: '';
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(25deg);
            transition: left 0.6s ease;
        }

        .shine-button:hover::after {
            left: 130%;
        }
    </style>
</head>

{{-- <body class="solar-page-bg min-h-screen text-slate-800"> --}}

    <body
    style="
        --primary: {{ $primaryColor }};
        --secondary: {{ $secondaryColor }};
        --accent: {{ $accentColor }};
        --page-bg: {{ $backgroundColor }};
    "
>

    <main class="mx-auto max-w-6xl px-4 py-6 sm:px-6 sm:py-10">

        <section
            class="glass-card overflow-hidden rounded-[2rem] border border-white shadow-premium"
        >
            {{-- Top color bar --}}
            <div
                class="h-2 bg-gradient-to-r from-solar-800 via-solar-500 to-sun-400"
            ></div>

            {{-- Hero section --}}
            <header class="hero-background relative overflow-hidden text-white">

                {{-- Decorative sun --}}
                <div
                    class="sun-glow absolute -right-16 -top-20 h-52 w-52 rounded-full bg-sun-400/30 blur-sm sm:h-72 sm:w-72"
                ></div>

                {{-- Decorative circles --}}
                <div
                    class="absolute -bottom-24 -left-20 h-64 w-64 rounded-full bg-cyan-400/10 blur-3xl"
                ></div>

                <div
                    class="relative z-10 grid items-center gap-8 px-6 py-10 sm:px-10 sm:py-14 lg:grid-cols-[1fr_.75fr]"
                >
                    <div class="text-center lg:text-left">

                        @if($business->business_category)
                            <div
                                class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-emerald-100 backdrop-blur"
                            >
                                <span class="text-sun-300">☀</span>
                                {{ $business->business_category }}
                            </div>
                        @else
                            <div
                                class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-emerald-100 backdrop-blur"
                            >
                                <span class="text-sun-300">☀</span>
                                Clean Energy Solutions
                            </div>
                        @endif

                        <h1
                            class="text-3xl font-black leading-tight sm:text-5xl lg:text-6xl"
                        >
                            {{ $business->bussiness_name }}
                        </h1>

                        @if($business->tagline)
                            <p
                                class="mt-4 text-lg font-bold text-sun-300 sm:text-xl"
                            >
                                {{ $business->tagline }}
                            </p>
                        @endif

                        @if($business->description)
                            <p
                                class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-emerald-50/80 sm:text-base lg:mx-0"
                            >
                                {{ $business->description }}
                            </p>
                        @endif

                        {{-- CTA buttons --}}
                        <div
                            class="mt-8 grid gap-3 sm:grid-cols-2 lg:max-w-xl"
                        >
                            @if($mobileNumber)
                                <a
                                    href="tel:+{{ $mobileNumber }}"
                                    data-track="call"
                                    class="shine-button flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-4 font-black text-solar-800 shadow-xl transition hover:-translate-y-1"
                                >
                                    <span class="text-xl">☎</span>
                                    Call Now
                                </a>
                            @endif

                            @if($whatsappNumber)
                                <a
                                    href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello '.$business->bussiness_name.', I would like to know more about your solar solutions.') }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="whatsapp"
                                    class="shine-button flex items-center justify-center gap-2 rounded-2xl bg-sun-400 px-5 py-4 font-black text-slate-950 shadow-xl transition hover:-translate-y-1 hover:bg-sun-300"
                                >
                                    <span class="text-xl">◉</span>
                                    Get Solar Quote
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Logo --}}
                    <div class="flex justify-center lg:justify-end">
                        <div class="relative">
                            <div
                                class="absolute -inset-6 rounded-full bg-sun-400/20 blur-2xl"
                            ></div>

                            @if($business->logo_url)
                                <img
                                    src="{{ $business->logo_url }}"
                                    alt="{{ $business->bussiness_name }} logo"
                                    class="relative h-40 w-40 rounded-full border-4 border-white bg-white object-contain p-2 shadow-2xl sm:h-52 sm:w-52"
                                >
                            @else
                                <div
                                    class="relative grid h-40 w-40 place-items-center rounded-full border-4 border-white bg-gradient-to-br from-sun-300 to-sun-500 text-6xl font-black text-solar-900 shadow-2xl sm:h-52 sm:w-52"
                                >
                                    {{ $initial }}
                                </div>
                            @endif

                            <div
                                class="absolute -bottom-3 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-full bg-white px-4 py-2 text-xs font-black uppercase tracking-wider text-solar-800 shadow-lg"
                            >
                                Go Green · Go Solar
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Solar benefits --}}
            <section
                class="grid border-b border-slate-100 sm:grid-cols-3"
            >
                <div
                    class="border-b border-slate-100 p-5 text-center sm:border-b-0 sm:border-r"
                >
                    <div
                        class="mx-auto grid h-12 w-12 place-items-center rounded-2xl bg-amber-50 text-2xl"
                    >
                        ☀️
                    </div>

                    <h3 class="mt-3 font-black text-slate-900">
                        Clean Energy
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Power your future with sunlight
                    </p>
                </div>

                <div
                    class="border-b border-slate-100 p-5 text-center sm:border-b-0 sm:border-r"
                >
                    <div
                        class="mx-auto grid h-12 w-12 place-items-center rounded-2xl bg-emerald-50 text-2xl"
                    >
                        🌱
                    </div>

                    <h3 class="mt-3 font-black text-slate-900">
                        Eco Friendly
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Reduce electricity costs and carbon
                    </p>
                </div>

                <div class="p-5 text-center">
                    <div
                        class="mx-auto grid h-12 w-12 place-items-center rounded-2xl bg-blue-50 text-2xl"
                    >
                        ⚡
                    </div>

                    <h3 class="mt-3 font-black text-slate-900">
                        Reliable Power
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Smart solar solutions for every need
                    </p>
                </div>
            </section>

            <div class="px-5 py-8 sm:px-9 sm:py-10">

                {{-- Business details --}}
                <section>
                    <div class="mb-6">
                        <p
                            class="text-xs font-black uppercase tracking-[0.22em] text-solar-700"
                        >
                            Contact Information
                        </p>

                        <h2 class="mt-1 text-2xl font-black text-slate-900">
                            Business Details
                        </h2>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">

                        @if($business->contact_person)
                            <div
                                class="rounded-2xl border border-emerald-100 bg-emerald-50/70 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-solar-700"
                                >
                                    Contact Person
                                </p>

                                <p class="mt-2 font-bold text-slate-900">
                                    {{ $business->contact_person }}
                                </p>
                            </div>
                        @endif

                        @if($business->mobile_number)
                            <div
                                class="rounded-2xl border border-blue-100 bg-blue-50/70 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-blue-700"
                                >
                                    Mobile Number
                                </p>

                                <a
                                    href="tel:{{ $business->mobile_number }}"
                                    data-track="call"
                                    class="mt-2 block font-bold text-slate-900 hover:text-solar-700"
                                >
                                    {{ $business->mobile_number }}
                                </a>
                            </div>
                        @endif

                        @if($business->alternate_mobile)
                            <div
                                class="rounded-2xl border border-blue-100 bg-blue-50/70 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-blue-700"
                                >
                                    Alternate Mobile
                                </p>

                                <a
                                    href="tel:{{ $business->alternate_mobile }}"
                                    data-track="call"
                                    class="mt-2 block font-bold text-slate-900 hover:text-solar-700"
                                >
                                    {{ $business->alternate_mobile }}
                                </a>
                            </div>
                        @endif

                        @if($business->email)
                            <div
                                class="rounded-2xl border border-violet-100 bg-violet-50/70 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-violet-700"
                                >
                                    Email Address
                                </p>

                                <a
                                    href="mailto:{{ $business->email }}"
                                    class="mt-2 block break-all font-bold text-slate-900 hover:text-solar-700"
                                >
                                    {{ $business->email }}
                                </a>
                            </div>
                        @endif

                        @if($business->opening_hours)
                            <div
                                class="rounded-2xl border border-amber-100 bg-amber-50/70 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-amber-700"
                                >
                                    Opening Hours
                                </p>

                                <p class="mt-2 font-bold text-slate-900">
                                    {{ $business->opening_hours }}
                                </p>
                            </div>
                        @endif

                        @if($business->rating)
                            <div
                                class="rounded-2xl border border-amber-100 bg-amber-50/70 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-amber-700"
                                >
                                    Customer Rating
                                </p>

                                <div class="mt-2 flex items-center gap-2">
                                    <span class="tracking-wider text-sun-500">
                                        ★★★★★
                                    </span>

                                    <strong class="text-slate-900">
                                        {{ number_format(
                                            (float) $business->rating,
                                            1
                                        ) }}/5
                                    </strong>
                                </div>
                            </div>
                        @endif

                        @if($business->gstin)
                            <div
                                class="rounded-2xl border border-slate-200 bg-slate-50 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-slate-600"
                                >
                                    GSTIN / UIN
                                </p>

                                <p class="mt-2 break-all font-bold text-slate-900">
                                    {{ $business->gstin }}
                                </p>
                            </div>
                        @endif

                        @if($business->msme_number)
                            <div
                                class="rounded-2xl border border-slate-200 bg-slate-50 p-5"
                            >
                                <p
                                    class="text-xs font-black uppercase tracking-wider text-slate-600"
                                >
                                    MSME Registration No.
                                </p>

                                <p class="mt-2 break-all font-bold text-slate-900">
                                    {{ $business->msme_number }}
                                </p>
                            </div>
                        @endif

                        @if($business->address)
                            <div
                                class="rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-5 sm:col-span-2"
                            >
                                <div
                                    class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                                >
                                    <div>
                                        <p
                                            class="text-xs font-black uppercase tracking-wider text-solar-700"
                                        >
                                            Business Address
                                        </p>

                                        <p class="mt-2 leading-7 text-slate-700">
                                            {{ $business->address }}
                                        </p>
                                    </div>

                                    @if($business->google_map_url)
                                        <a
                                            href="{{ $business->google_map_url }}"
                                            target="_blank"
                                            rel="noopener"
                                            data-track="google"
                                            class="shrink-0 rounded-xl bg-solar-700 px-5 py-3 text-center text-sm font-black text-white transition hover:bg-solar-800"
                                        >
                                            📍 Get Directions
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                {{-- Product gallery --}}
                @if($products->isNotEmpty())
                    <section class="mt-12">
                        <div
                            class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between"
                        >
                            <div>
                                <p
                                    class="text-xs font-black uppercase tracking-[0.22em] text-solar-700"
                                >
                                    Solar Products
                                </p>

                                <h2
                                    class="mt-1 text-2xl font-black text-slate-900"
                                >
                                    Our Products & Solutions
                                </h2>
                            </div>

                            <p class="text-sm text-slate-500">
                                {{ $products->count() }} products available
                            </p>
                        </div>

                        <div
                            class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3"
                        >
                            @foreach($products as $product)
                                <article
                                    class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-solar"
                                >
                                    <div
                                        class="relative aspect-[4/3] overflow-hidden bg-slate-100"
                                    >
                                        <img
                                            src="{{ $product->image_url }}"
                                            alt="{{ $product->name }}"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                        >

                                        @if($product->offer_price)
                                            <span
                                                class="absolute left-3 top-3 rounded-full bg-red-600 px-3 py-1 text-xs font-black text-white shadow-lg"
                                            >
                                                Special Offer
                                            </span>
                                        @endif

                                        <div
                                            class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-black/50 to-transparent"
                                        ></div>
                                    </div>

                                    <div class="p-5">
                                        <h3
                                            class="text-lg font-black text-slate-900"
                                        >
                                            {{ $product->name }}
                                        </h3>

                                        @if($product->description)
                                            <p
                                                class="mt-2 line-clamp-3 text-sm leading-6 text-slate-500"
                                            >
                                                {{ $product->description }}
                                            </p>
                                        @endif

                                        <div class="mt-4 flex items-center gap-2">
                                            @if($product->offer_price)
                                                <span
                                                    class="text-xl font-black text-solar-700"
                                                >
                                                    ₹{{ number_format(
                                                        (float) $product->offer_price,
                                                        2
                                                    ) }}
                                                </span>

                                                @if($product->price)
                                                    <span
                                                        class="text-sm font-semibold text-slate-400 line-through"
                                                    >
                                                        ₹{{ number_format(
                                                            (float) $product->price,
                                                            2
                                                        ) }}
                                                    </span>
                                                @endif
                                            @elseif($product->price)
                                                <span
                                                    class="text-xl font-black text-solar-700"
                                                >
                                                    ₹{{ number_format(
                                                        (float) $product->price,
                                                        2
                                                    ) }}
                                                </span>
                                            @else
                                                <span
                                                    class="text-sm font-bold text-slate-500"
                                                >
                                                    Price on request
                                                </span>
                                            @endif
                                        </div>

                                        @if($product->button_url)
                                            <a
                                                href="{{ $product->button_url }}"
                                                target="_blank"
                                                rel="noopener"
                                                class="mt-5 block rounded-xl bg-solar-700 px-4 py-3 text-center text-sm font-black text-white transition hover:bg-solar-800"
                                            >
                                                {{ $product->button_text ?: 'View Product' }}
                                            </a>
                                        @elseif($whatsappNumber)
                                            <a
                                                href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello '.$business->bussiness_name.', I am interested in '.$product->name.'. Please share more details.') }}"
                                                target="_blank"
                                                rel="noopener"
                                                data-track="whatsapp"
                                                class="mt-5 block rounded-xl bg-emerald-500 px-4 py-3 text-center text-sm font-black text-white transition hover:bg-emerald-600"
                                            >
                                                Enquire on WhatsApp
                                            </a>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Social connections --}}
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
                    <section class="mt-12">
                        <div class="text-center">
                            <p
                                class="text-xs font-black uppercase tracking-[0.22em] text-solar-700"
                            >
                                Follow & Connect
                            </p>

                            <h2 class="mt-1 text-2xl font-black text-slate-900">
                                Connect With Us
                            </h2>
                        </div>

                        <div
                            class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4"
                        >
                            @if($business->website_url)
                                <a
                                    href="{{ $business->website_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="website"
                                    class="rounded-2xl border border-blue-100 bg-blue-50 p-4 text-center transition hover:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-blue-600 text-xl text-white"
                                    >
                                        🌐
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        Website
                                    </strong>
                                </a>
                            @endif

                            @if($business->google_map_url)
                                <a
                                    href="{{ $business->google_map_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="google"
                                    class="rounded-2xl border border-red-100 bg-red-50 p-4 text-center transition hover:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-red-500 text-xl text-white"
                                    >
                                        📍
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        Location
                                    </strong>
                                </a>
                            @endif

                            @if($business->insta_url)
                                <a
                                    href="{{ $business->insta_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="instagram"
                                    class="rounded-2xl border border-pink-100 bg-pink-50 p-4 text-center transition hover:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-gradient-to-br from-purple-600 via-pink-500 to-amber-400 text-xl font-black text-white"
                                    >
                                        ◎
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        Instagram
                                    </strong>
                                </a>
                            @endif

                            @if($business->fb_url)
                                <a
                                    href="{{ $business->fb_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="facebook"
                                    class="rounded-2xl border border-blue-100 bg-blue-50 p-4 text-center transition hover:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-blue-600 text-xl font-black text-white"
                                    >
                                        f
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        Facebook
                                    </strong>
                                </a>
                            @endif

                            @if($business->linkden_url)
                                <a
                                    href="{{ $business->linkden_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="linkedin"
                                    class="rounded-2xl border border-sky-100 bg-sky-50 p-4 text-center transition hover:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-sky-700 text-sm font-black text-white"
                                    >
                                        in
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        LinkedIn
                                    </strong>
                                </a>
                            @endif

                            @if($business->twiter_url)
                                <a
                                    href="{{ $business->twiter_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="twitter"
                                    class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-center transition hoverfinder:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-black text-xl font-black text-white"
                                    >
                                        𝕏
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        X / Twitter
                                    </strong>
                                </a>
                            @endif

                            @if($business->youtube_url)
                                <a
                                    href="{{ $business->youtube_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="youtube"
                                    class="rounded-2xl border border-red-100 bg-red-50 p-4 text-center transition hover:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-red-600 text-lg font-black text-white"
                                    >
                                        ▶
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        YouTube
                                    </strong>
                                </a>
                            @endif

                            @if($business->review_url)
                                <a
                                    href="{{ $business->review_url }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-track="review"
                                    class="rounded-2xl border border-amber-100 bg-amber-50 p-4 text-center transition hover:-translate-y-1 hover:shadow-md"
                                >
                                    <span
                                        class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-sun-400 text-xl font-black text-black"
                                    >
                                        ★
                                    </span>

                                    <strong class="mt-2 block text-sm">
                                        Review Us
                                    </strong>
                                </a>
                            @endif
                        </div>
                    </section>
                @endif

                {{-- Bottom actions --}}
                <section class="mt-10 grid gap-3 sm:grid-cols-2">
                    <button
                        type="button"
                        onclick="shareBusiness()"
                        class="rounded-2xl border-2 border-solar-700 px-5 py-4 font-black text-solar-700 transition hover:bg-solar-700 hover:text-white"
                    >
                        ↗ Share Business Profile
                    </button>

                    @if($business->review_url)
                        <a
                            href="{{ $business->review_url }}"
                            target="_blank"
                            rel="noopener"
                            data-track="review"
                            class="rounded-2xl bg-gradient-to-r from-sun-400 to-sun-500 px-5 py-4 text-center font-black text-slate-950 shadow-lg transition hover:-translate-y-1"
                        >
                            ★ Give Your Review
                        </a>
                    @elseif($business->exists)
                        <a
                            href="{{ route('business.rating', $business->id) }}"
                            class="rounded-2xl bg-gradient-to-r from-sun-400 to-sun-500 px-5 py-4 text-center font-black text-slate-950 shadow-lg transition hover:-translate-y-1"
                        >
                            ★ Give Your Review
                        </a>
                    @endif
                </section>
            </div>

            <footer
                class="border-t border-slate-100 bg-slate-950 px-5 py-6 text-center"
            >
                <p class="text-xs text-slate-400">
                    © {{ date('Y') }}

                    <span class="font-bold text-emerald-400">
                        {{ $business->bussiness_name }}
                    </span>

                    · Powering a cleaner tomorrow
                </p>
            </footer>
        </section>
    </main>

    {{-- Copy notification --}}
    <div
        id="shareMessage"
        class="fixed bottom-5 left-1/2 z-50 hidden -translate-x-1/2 rounded-xl bg-solar-700 px-5 py-3 text-sm font-bold text-white shadow-2xl"
    >
        Profile link copied successfully!
    </div>

    @if(($previewMode ?? false) !== true && $business->exists)
        <script>
            document.querySelectorAll('[data-track]').forEach((element) => {
                element.addEventListener('click', function () {
                    fetch(
                        @json(route('business.trackClick', $business->id)),
                        {
                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token())
                            },

                            body: JSON.stringify({
                                platform: element.dataset.track
                            }),

                            keepalive: true
                        }
                    ).catch(() => {});
                });
            });

            async function shareBusiness() {
                const shareData = {
                    title: @json($business->bussiness_name),
                    text: @json($pageDescription),
                    url: window.location.href
                };

                try {
                    if (navigator.share) {
                        await navigator.share(shareData);
                        return;
                    }

                    await navigator.clipboard.writeText(
                        window.location.href
                    );

                    showShareMessage();
                } catch (error) {
                    // Share sheet cancel hone par kuch nahi karna.
                }
            }

            function showShareMessage() {
                const message = document.getElementById(
                    'shareMessage'
                );

                message.classList.remove('hidden');

                setTimeout(() => {
                    message.classList.add('hidden');
                }, 2500);
            }
        </script>
    @else
        <script>
            function shareBusiness() {
                alert('Template preview mode');
            }
        </script>
    @endif
</body>

</html>
