<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" />
    <title>QRwale – Free & Custom QR Code Generator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description"
        content="Generate stylish, scannable QR codes for business, events, products & more. Free & secure QR code generator with tracking & logo options.">
    <meta name="keywords"
        content="QR code generator, free QR code, custom QR, business QR code, trackable QR codes, QR with logo, qrwale, qr wale">
    <meta name="author" content="QRwale Team">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://qrwale.com/">
    <meta property="og:title" content="QRwale – Free & Stylish QR Code Generator">
    <meta property="og:description"
        content="Create free, custom QR codes for your business, product, or event. Add logos, colors, and track performance.">
    <meta property="og:image" content="https://qrwale.com/logo.png">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://qrwale.com/">
    <meta name="twitter:title" content="QRwale – Free QR Code Generator with Tracking & Customization">
    <meta name="twitter:description"
        content="Make your own free QR codes in seconds. Customize with logo, colors, and more. Ideal for business & marketing.">
    <meta name="twitter:image" content="https://qrwale.com/logo.png">

    <link rel="canonical" href="https://qrwale.com/">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .bg-hero {
            background:
                /*radial-gradient(1200px 650px at 70% 55%, rgb(220, 231, 228), transparent 60%),
                radial-gradient(900px 520px at 35% 60%, rgb(231, 238, 250), transparent 55%),
                radial-gradient(600px 420px at 30% 20%, rgb(218, 218, 233), transparent 55%),
                linear-gradient(to bottom, #f0f2f9 0%, #f9fafc 40%, #edeef2 100%);*/
                #FFFFFF
        }

        .glass {
            background: #2f4858 border: 1px solid rgba(244, 235, 235, 0.977);
            box-shadow: 0 18px 45px rgb(255, 253, 253);
            backdrop-filter: blur(10px);
        }

        .soft-border {
            border: 1px solid rgba(0, 0, 0, 0.971);
        }
    </style>
</head>

<body class="text-black bg-hero min-h-screen">

    <!-- ================= NAVBAR ================= -->
    <header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-white/10 bg-[#2f4858]/20 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-3">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" class="h-10 w-10 rounded-xl bg-white p-1" alt="QRwale Logo">
                <div class="leading-tight">
                    <div class="font-extrabold tracking-tight">QRwale</div>
                    <div class="text-xs text-black/60 -mt-0.5">By Real Victory Groups</div>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-7 text-sm text-black/80">
                <a href="#features" class="hover:text-black transition">Features</a>
                <a href="#pricing" class="hover:text-black transition">Pricing</a>
                <a href="#how" class="hover:text-black transition">How it works</a>
                <a href="#faq" class="hover:text-black transition">FAQ</a>
                <a href="#contact" class="hover:text-black transition">Contact</a>
            </nav>

            <div class="hidden lg:flex items-center gap-3">
                <a href="/login"
                    class="px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                    Login
                </a>
                <a href="#generator"
                    class="px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                    Generate QR
                </a>
                <a href="/register"
                    class="px-4 py-2 rounded-xl border border-red-400/40 text-red-900 bg-red-500/20 hover:bg-red-600 transition text-sm font-semibold">
                    Register
                </a>
                <a href="tel:+917753800444"
                    class="px-4 py-2 rounded-xl bg-red-500 hover:bg-red-400 transition text-sm font-extrabold text-white">
                    Book Demo
                </a>
            </div>

            <button @click="open=!open"
                class="lg:hidden inline-flex items-center justify-center h-10 w-10 rounded-xl soft-border bg-white/5 hover:bg-white/10">
                <span class="text-lg">☰</span>
            </button>
        </div>

        <div x-show="open" x-transition class="lg:hidden border-t border-white/10 bg-white/40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 space-y-3 text-black/80 text-sm">
                <a href="#features" class="block hover:text-black">Features</a>
                <a href="#pricing" class="block hover:text-black">Pricing</a>
                <a href="#how" class="block hover:text-black">How it works</a>
                <a href="#faq" class="block hover:text-black">FAQ</a>
                <a href="#contact" class="block hover:text-black">Contact</a>
                <div class="pt-3 grid grid-cols-2 gap-3">
                    <a href="/login"
                        class="px-4 py-2 rounded-xl soft-border bg-white/5 text-center font-semibold">Login</a>
                    <a href="/register"
                        class="px-4 py-2 rounded-xl bg-red-500 text-white text-center font-extrabold">Register</a>
                    <a href="#generator"
                        class="col-span-2 px-4 py-2 rounded-xl soft-border bg-white/5 text-center font-semibold">Generate
                        QR</a>
                </div>
            </div>
        </div>
    </header>

    <!-- ================= HERO ================= -->
    {{-- <section class="relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-6">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full soft-border bg-white/5 text-xs sm:text-sm text-red-100">
                        <span class="h-2 w-2 rounded-full bg-red-400"></span>
                        Specially crafted for Business • Events • Products
                    </div>

                    <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Smart QR Generator for<br>
                        <span class="text-red-300">Modern Businesses</span>
                    </h1>

                    <p class="mt-5 text-black/75 text-base sm:text-lg leading-relaxed max-w-xl">
                        Create QR codes for <span class="text-red-200 font-semibold">Links, Ordering, Reviews,
                            Feedback</span>.
                        Download as PNG/PDF. Clean, fast & mobile responsive.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="#generator"
                            class="px-6 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-black font-extrabold text-center">
                            Get Free Demo
                        </a>
                        <a href="#features"
                            class="px-6 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold text-center">
                            View Features →
                        </a>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4 text-sm text-black/75">
                        <div class="flex items-center gap-2">
                            <span
                                class="h-9 w-9 rounded-2xl bg-red-500/15 border border-red-400/20 flex items-center justify-center">✓</span>
                            <span>No installation — runs in browser</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="h-9 w-9 rounded-2xl bg-red-500/15 border border-red-400/20 flex items-center justify-center">⚡</span>
                            <span>Fast generation & downloads</span>
                        </div>
                    </div>
                </div>

                <!-- Right Live Preview -->
                <div class="lg:col-span-6">
                    <div class="glass rounded-3xl p-5 sm:p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-sm text-black/60">QRwale Live Preview</div>
                                <div class="text-xl font-extrabold mt-1">Generate & Download QR</div>
                                <div class="text-sm text-black/60 mt-1">Auto preview • PNG/PDF export</div>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/15 text-red-200 border border-red-400/20">
                                LIVE PREVIEW
                            </span>
                        </div>

                        <div id="generator" class="mt-5 rounded-2xl soft-border bg-black/25 p-4 sm:p-5">
                            <label class="text-sm font-semibold text-black/80">Enter URL</label>
                            <div class="mt-2 flex flex-col sm:flex-row gap-2">
                                <input id="url-input" type="text" placeholder="https://example.com"
                                    class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/30 border border-white/10 text-black placeholder:text-black/35 focus:border-red-400/40 focus:ring-4 focus:ring-red-500/10 transition" />
                                <button id="generate-btn"
                                    class="px-5 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-black font-extrabold disabled:opacity-60 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                                    <span id="btn-text">Generate</span>
                                    <span id="btn-spinner"
                                        class="hidden h-4 w-4 rounded-full border-2 border-black/40 border-t-transparent animate-spin"></span>
                                </button>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                <button id="copy-link-btn"
                                    class="hidden px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                                    Copy URL
                                </button>
                                <button id="reset-btn"
                                    class="hidden px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                                    Reset
                                </button>
                            </div>

                            <div class="mt-5 grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-7 rounded-2xl soft-border bg-black/25 p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="font-bold">QR Preview</div>
                                        <span class="text-xs text-black/60">Level: H</span>
                                    </div>
                                    <div class="mt-4 rounded-2xl bg-white p-3 flex items-center justify-center">
                                        <div id="qrcode" class="flex justify-center"></div>
                                    </div>
                                    <p id="qr-content" class="mt-3 text-xs text-black/60 break-all"></p>
                                </div>

                                <div class="md:col-span-5 rounded-2xl soft-border bg-black/25 p-4">
                                    <div class="font-bold">Downloads</div>
                                    <p class="text-xs text-black/60 mt-1">Get QR as PDF or PNG</p>
                                    <div class="mt-4 space-y-2">
                                        <button id="download-pdf-btn"
                                            class="w-full py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-bold">
                                            Download PDF
                                        </button>
                                        <button id="download-img-btn"
                                            class="w-full py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition font-extrabold text-black">
                                            Download PNG
                                        </button>
                                    </div>
                                    <div class="mt-4 text-xs text-black/60">One-click share • Print ready</div>
                                </div>
                            </div>

                            <div
                                class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between text-xs text-black/60">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-8 w-8 rounded-2xl bg-red-500/15 border border-red-400/20 flex items-center justify-center">⤴</span>
                                    One-click QR download
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-8 w-8 rounded-2xl bg-red-500/15 border border-red-400/20 flex items-center justify-center">☁</span>
                                    Secure save on login
                                </div>
                            </div>
                        </div>

                        <p class="mt-4 text-sm text-black/60">
                            QRwale helps you create QR codes for ordering links, Google reviews, WhatsApp chats,
                            feedback forms and more.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <section class="relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-6">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full soft-border bg-red/25 text-xs sm:text-sm text-red-700">
                        <span class="h-2 w-2 rounded-full bg-red-700"></span>
                        Specially crafted for Business • Events • Products
                    </div>

                    <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Smart QR Generator for<br>
                        <span class="text-red-700">Modern Businesses</span>
                    </h1>

                    <p class="mt-5  text-base sm:text-lg leading-relaxed max-w-xl">
                        Create QR codes for <span class="text-red-700 font-semibold">Links, Ordering, Reviews,
                            Feedback</span>.
                        Download as PNG/PDF. Clean, fast & mobile responsive.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="#generator"
                            class="px-6 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-white font-extrabold text-center">
                            Get Free Demo
                        </a>
                        <a href="#features"
                            class="px-6 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold text-center">
                            View Features →
                        </a>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4 text-sm text-black">
                        <div class="flex items-center gap-2">
                            <span
                                class="h-9 w-9 rounded-2xl bg-red-500 border border-red-700 flex items-center justify-center text-white">✓</span>
                            <span>No installation — runs in browser</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="h-9 w-9 rounded-2xl bg-red-500 border border-red-400/20 flex items-center justify-center text-black">⚡</span>
                            <span>Fast generation & downloads</span>
                        </div>
                    </div>
                </div>

                <!-- Right Live Preview -->
                <div class="lg:col-span-6">
                    <div class="glass bg-[#2f4858]/15  rounded-3xl p-5 sm:p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-sm text-black">QRwale Live Preview</div>
                                <div class="text-xl font-extrabold mt-1">Generate & Download QR</div>
                                <div class="text-sm text-black mt-1">Auto preview • PNG/PDF export</div>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-red-200 text-red-900 border border-red-400">
                                LIVE PREVIEW
                            </span>
                        </div>

                        <div id="generator" class="mt-5 rounded-2xl  p-4 sm:p-5">
                            <label class="text-sm font-semibold text-black/80">Enter URL</label>
                            <div class="mt-2 flex flex-col sm:flex-row gap-2">
                                <input id="url-input" type="text" placeholder="https://example.com"
                                    class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/10 border border-white/10 text-black placeholder:text-black/35 focus:border-red-400/40 focus:ring-4 focus:ring-red-500/10 transition" />
                                <button id="generate-btn"
                                    class="px-5 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-white font-extrabold disabled:opacity-60 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                                    <span id="btn-text">Generate</span>
                                    <span id="btn-spinner"
                                        class="hidden h-4 w-4 rounded-full border-2 border-black/40 border-t-transparent animate-spin"></span>
                                </button>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                <button id="copy-link-btn"
                                    class="hidden px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                                    Copy URL
                                </button>
                                <button id="reset-btn"
                                    class="hidden px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                                    Reset
                                </button>
                            </div>

                            <div class="mt-5 grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-7 rounded-2xl soft-border bg-black/10 p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="font-bold">QR Preview</div>
                                        <span class="text-xs text-black/60">Level: H</span>
                                    </div>

                                    <!-- ✅ QR + Logo wrapper -->
                                    <div class="mt-4 rounded-2xl bg-white p-3 flex items-center justify-center">
                                        <div class="relative inline-block">
                                            <div id="qrcode" class="flex justify-center"></div>

                                            <!-- CENTER LOGO -->
                                            <img id="qr-logo" src="/logo.png" alt="Logo"
                                                class="hidden absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2
                                                w-16 h-16 rounded-xl bg-white p-1 shadow-lg border border-black/10" />
                                        </div>
                                    </div>

                                    <p id="qr-content" class="mt-3 text-xs text-black/60 break-all"></p>
                                </div>

                                <div class="md:col-span-5 rounded-2xl soft-border bg-black/10 p-4">
                                    <div class="font-bold">Downloads</div>
                                    <p class="text-xs text-black/60 mt-1">Get QR as PDF or PNG</p>
                                    <div class="mt-4 space-y-2">
                                        <button id="download-pdf-btn"
                                            class="w-full py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-bold">
                                            Download PDF
                                        </button>
                                        <button id="download-img-btn"
                                            class="w-full py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition font-extrabold text-white">
                                            Download PNG
                                        </button>
                                    </div>
                                    <div class="mt-4 text-xs text-black/60">One-click share • Print ready</div>
                                </div>
                            </div>

                            <div
                                class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between text-xs text-black/60">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-8 w-8 rounded-2xl bg-red-500 border border-red-400 flex items-center justify-center">⤴</span>
                                    One-click QR download
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-8 w-8 rounded-2xl bg-red-500 border border-red-500 flex items-center justify-center">☁</span>
                                    Secure save on login
                                </div>
                            </div>
                        </div>

                        <p class="mt-4 text-sm text-black/60">
                            QRwale helps you create QR codes for ordering links, Google reviews, WhatsApp chats,
                            feedback forms and more.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ================= SHORT URL TOOL ================= -->
    <section class="relative" id="shorturl-tool">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
            <div class="glass bg-[#2f4858]/10  rounded-3xl p-5 sm:p-6">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="text-sm text-black">Free Short URL Generator</div>
                        <div class="text-xl font-extrabold mt-1">Create Short Link</div>
                        <div class="text-sm text-black mt-1">Instant generate • Copy • Saved automatically</div>
                    </div>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-bold bg-red-200 text-red-700 border border-red-400">
                        FREE
                    </span>
                </div>

                <div class="mt-5 rounded-2xl soft-border   p-4 sm:p-5">
                    <label class="text-sm font-semibold text-black">Enter Original URL</label>

                    <div class="mt-2 flex flex-col sm:flex-row gap-2">
                        <input id="short-original-input" type="url" placeholder="https://example.com/page"
                            class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/10 border border-white/10 text-black placeholder:text-black/35 focus:border-red-400/40 focus:ring-4 focus:ring-red-500/10 transition" />

                        <button id="short-generate-btn"
                            class="px-5 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-white font-extrabold disabled:opacity-60 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                            <span id="short-btn-text">Generate</span>
                            <span id="short-btn-spinner"
                                class="hidden h-4 w-4 rounded-full border-2 border-black/40 border-t-transparent animate-spin"></span>
                        </button>
                    </div>

                    <div id="short-result-wrap" class="hidden mt-4 rounded-2xl soft-border bg-black/25 p-4">
                        <div class="text-sm text-black/70">Your Short URL</div>

                        <div class="mt-2 flex flex-col sm:flex-row gap-2 sm:items-center">
                            <input id="short-result" readonly
                                class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/30 border border-white/10 text-black" />
                            <button id="short-copy-btn"
                                class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-extrabold">
                                Copy
                            </button>
                            <a id="short-open-btn" href="#" target="_blank"
                                class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-extrabold text-center">
                                Open
                            </a>
                        </div>

                        <div class="mt-2 text-xs text-black/60">
                            Saved automatically. You can generate unlimited links.
                        </div>
                    </div>

                    <div class="mt-4 text-xs text-black/60">
                        Works for Products • WhatsApp • Google Reviews • Landing Pages • Campaign links
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- images --}}
    <!-- Hero Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center gap-12">

            <!-- Left Image -->
            <div class="md:w-1/2">
                <img src="{{ asset('asset/img/qr_img.png') }}" alt="QR.io QR Code"
                    class="rounded-xl w-full object-cover">

            </div>

            <!-- Right Content -->
            <div class="md:w-1/2">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-6">Unlock the Power of QR Wale</h2>
                <p class="text-lg text-gray-600 mb-8">Track, customize, and enhance your QR Code experience
                    effortlessly. No coding required!</p>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Feature 1 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center">
                                {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18">
                                    </path>
                                </svg> --}}
                                <img src="{{asset('asset/img/arrow (2).gif')}}" alt="">
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">Dynamic & Static QR Codes</h3>
                            <p class="text-gray-600">Choose between dynamic QR codes that can be updated or static ones
                                that stay permanent.</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-green-100 text-green-500 rounded-full flex items-center justify-center">
                                {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 11V9a2 2 0 114 0v2m-4 4h4"></path>
                                </svg> --}}
                                <img src="{{asset('asset/img/arrow (2).gif')}}" alt="">

                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">QR Code Analytics</h3>
                            <p class="text-gray-600">Track how many people scan your QR Codes, their location, and the
                                exact date with built-in analytics.</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-purple-100 text-purple-500 rounded-full flex items-center justify-center">
                                {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16">
                                    </path>
                                </svg> --}}
                                <img src="{{asset('asset/img/arrow (2).gif')}}" alt="">

                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">Custom Landing Pages</h3>
                            <p class="text-gray-600">Create fully customized landing pages for your QR Codes without
                                writing a single line of code.</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-red-100 text-red-500 rounded-full flex items-center justify-center">
                                <img src="{{asset('asset/img/arrow (2).gif')}}" alt="">

                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">Custom Colors & Shapes</h3>
                            <p class="text-gray-600">Stand out by designing QR Codes with unique colors, shapes, and
                                styles that match your brand.</p>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-yellow-100 text-yellow-500 rounded-full flex items-center justify-center">
                                <img src="{{asset('asset/img/arrow (2).gif')}}" alt="">

                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">No Coding Required</h3>
                            <p class="text-gray-600">Everything is drag-and-drop and easy to manage. Perfect for
                                marketers, small business owners, and non-developers.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- ================= FEATURES (FULL) ================= -->
    <section id="features" class="border-t border-white/10 bg-[#2f4858]/10 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="max-w-2xl">
                <div class="text-red-900 text-sm font-bold tracking-wide">FEATURES</div>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Everything you need to generate QR codes</h2>
                <p class="mt-3 text-black/70">Simple for users, powerful for businesses. Works perfectly on mobile &
                    desktop.</p>
            </div>

            <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <!-- Accent -->
                    <div class="absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-red-500 to-red-700"></div>

                    <div class="p-8 pl-10">
                        <div class="flex items-center gap-3">
                            <span>
                               <img src="{{ asset('asset/img/instant.gif') }}" alt="" class="w-10 h-10">
                            </span>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Instant QR Generation
                            </h3>
                        </div>

                        <p class="mt-3 text-sm text-gray-500">
                            Paste a URL and generate a QR code instantly — no setup, no friction.
                        </p>

                        <div class="mt-6 h-px bg-gray-200"></div>

                        <ul class="mt-5 space-y-2 text-sm text-gray-600">
                            <li>• One-click generation</li>
                            <li>• Zero loading delay</li>
                            <li>• Clean output every time</li>
                        </ul>
                    </div>
                </div>

                <!-- Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <div class="absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-red-500 to-red-700"></div>

                    <div class="p-8 pl-10">
                        <div class="flex items-center gap-3">
                            <span>
                               <img src="{{ asset('asset/img/response.gif') }}" alt="" class="w-10 h-10">
                            </span>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Mobile Responsive
                            </h3>
                        </div>

                        <p class="mt-3 text-sm text-gray-500">
                            Optimized UI for mobile, tablet, and desktop screens.
                        </p>

                        <div class="mt-6 h-px bg-gray-200"></div>

                        <ul class="mt-5 space-y-2 text-sm text-gray-600">
                            <li>• Touch-friendly controls</li>
                            <li>• Fast mobile load times</li>
                            <li>• Consistent UX everywhere</li>
                        </ul>
                    </div>
                </div>

                <!-- Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <div class="absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-red-500 to-red-700"></div>

                    <div class="p-8 pl-10">
                        <div class="flex items-center gap-3">
                            <span>
                               <img src="{{ asset('asset/img/pdf.gif') }}" alt="" class="w-10 h-10">
                            </span>
                            <h3 class="text-xl font-semibold text-gray-900">
                                PDF Export
                            </h3>
                        </div>

                        <p class="mt-3 text-sm text-gray-500">
                            Download print-ready PDFs with QR and URL text.
                        </p>

                        <div class="mt-6 h-px bg-gray-200"></div>

                        <ul class="mt-5 space-y-2 text-sm text-gray-600">
                            <li>• High-resolution output</li>
                            <li>• Print optimized layout</li>
                            <li>• Professional formatting</li>
                        </ul>
                    </div>
                </div>

                <!-- Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <div class="absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-red-500 to-red-700"></div>

                    <div class="p-8 pl-10">
                        <div class="flex items-center gap-3">
                            <span>
                               <img src="{{ asset('asset/img/download.gif') }}" alt="" class="w-10 h-10">
                            </span>
                            <h3 class="text-xl font-semibold text-gray-900">
                                PNG Download
                            </h3>
                        </div>

                        <p class="mt-3 text-sm text-gray-500">
                            High-quality PNG files ready for sharing anywhere.
                        </p>

                        <div class="mt-6 h-px bg-gray-200"></div>

                        <ul class="mt-5 space-y-2 text-sm text-gray-600">
                            <li>• Crisp image quality</li>
                            <li>• Social & print ready</li>
                            <li>• Lightweight files</li>
                        </ul>
                    </div>
                </div>

                <!-- Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <div class="absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-red-500 to-red-700"></div>

                    <div class="p-8 pl-10">
                        <div class="flex items-center gap-3">
                             <span>
                               <img src="{{ asset('asset/img/save.gif') }}" alt="" class="w-10 h-10">
                            </span>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Secure Save
                            </h3>
                        </div>

                        <p class="mt-3 text-sm text-gray-500">
                            Save and manage QR codes securely with login protection.
                        </p>

                        <div class="mt-6 h-px bg-gray-200"></div>

                        <ul class="mt-5 space-y-2 text-sm text-gray-600">
                            <li>• Auth-protected access</li>
                            <li>• Private QR history</li>
                            <li>• Secure storage</li>
                        </ul>
                    </div>
                </div>

                <!-- Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <div class="absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-red-500 to-red-700"></div>

                    <div class="p-8 pl-10">
                        <div class="flex items-center gap-3">
                            <span>
                               <img src="{{ asset('asset/img/future.gif') }}" alt="" class="w-10 h-10">
                            </span>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Future Ready
                            </h3>
                        </div>

                        <p class="mt-3 text-sm text-gray-500">
                            Built to support analytics, logos, and custom styles.
                        </p>

                        <div class="mt-6 h-px bg-gray-200"></div>

                        <ul class="mt-5 space-y-2 text-sm text-gray-600">
                            <li>• Custom colors</li>
                            <li>• Logo-embedded QR</li>
                            <li>• Scan tracking</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- dynamic  --}}

    {{-- <body class="bg-gray-100 p-4">

  <h1 class="text-3xl font-bold text-center mb-8 py-8">Dynamic vs Static QR Codes</h1>

  <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
    <!-- Static QR Code -->
    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center">
      <img src="{{asset('asset/img/static.png') }}" alt="Static QR Code" class="mb-4 rounded border">
      <h2 class="text-xl font-semibold mb-2 p-2">Static QR Code</h2>
      <p class="text-gray-700 text-center p-4">
        A static QR code contains fixed information that cannot be changed once generated.
        Perfect for simple links, contact info, or event details.
        Users are redirected directly to the embedded content.
      </p>
    </div>

    <!-- Dynamic QR Code -->
    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center">
      <img src="{{ asset('asset/img/dynamic_qr.png') }}" alt="Dynamic QR Code" class="mb-4 rounded border">
      <h2 class="text-xl font-semibold mb-2 p-2">Dynamic QR Code</h2>
      <p class="text-gray-700 text-center p-4">
        A dynamic QR code points to a URL that can be updated anytime without changing the QR code itself.
        Offers tracking, analytics, and flexibility for marketing campaigns or frequently updated content.
      </p>
    </div>
  </div>

</body> --}}


<section class=" min-h-screen flex items-center justify-center p-6">

  <div class="max-w-6xl w-full">
    <!-- Header -->
    <div class="text-center mb-12">
      <h1 class="text-4xl font-extrabold text-slate-800 mb-3">
        Dynamic vs Static QR Codes
      </h1>
      <p class="text-slate-600 max-w-2xl mx-auto">
        Understand the difference and choose the right QR code for your needs
      </p>
    </div>

    <!-- Comparison Grid -->
    <div class="grid md:grid-cols-2 gap-8">

      <!-- Static QR Code Card -->
      <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 hover:shadow-xl transition">
        <div class="flex items-center mb-6">
          <div class="bg-gray-200 text-gray-600 p-3 rounded-xl mr-4">
           <img src="{{ asset('asset/img/pin.gif') }}" alt="" class="w-8 h-8">
          </div>
          <h2 class="text-2xl font-bold text-slate-800">Static QR Code</h2>
        </div>

        <p class="text-slate-600 mb-6">
          A static QR code contains fixed information that cannot be changed once generated.
        </p>

        <ul class="space-y-3 text-slate-700">
          <li class="flex items-start">
            <span class="text-green-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            Directly embeds data (URL, text, contact info)
          </li>
          <li class="flex items-start">
            <span class="text-green-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            No edits after creation
          </li>
          <li class="flex items-start">
            <span class="text-green-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            No tracking or analytics
          </li>
          <li class="flex items-start">
            <span class="text-green-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            Ideal for simple, permanent information
          </li>
        </ul>

        <div class="mt-6 bg-gray-100 text-gray-700 text-sm rounded-lg p-4">
          Best for: Business cards, event flyers, Wi-Fi access
        </div>
      </div>

      <!-- Dynamic QR Code Card -->
      <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 hover:shadow-xl transition">
        <div class="flex items-center mb-6">
          <div class="bg-red-100 text-red-600 p-3 rounded-xl mr-4">
           <img src="{{ asset('asset/img/entrepreneurship.gif') }}" alt="" class="w-8 h-8">
          </div>
          <h2 class="text-2xl font-bold text-slate-800">Dynamic QR Code</h2>
        </div>

        <p class="text-slate-600 mb-6">
          A dynamic QR code redirects to a short URL that can be updated anytime.
        </p>

        <ul class="space-y-3 text-slate-700">
          <li class="flex items-start">
            <span class="text-purple-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            Editable destination without reprinting
          </li>
          <li class="flex items-start">
            <span class="text-purple-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            Scan tracking & analytics
          </li>
          <li class="flex items-start">
            <span class="text-purple-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            Ideal for marketing & campaigns
          </li>
          <li class="flex items-start">
            <span class="text-purple-500 mr-2">
                <img src="{{asset('asset/img/fingers.gif') }}" alt="" class="w-6 h-6">
            </span>
            Supports A/B testing & updates
          </li>
        </ul>

        <div class="mt-6 bg-red-50 text-red-700 text-sm rounded-lg p-4">
          Best for: Marketing campaigns, menus, promotions
        </div>
      </div>

    </div>
  </div>

</section>

    <!-- ================= PRICING ================= -->
    <section id="pricing" class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <div class="text-red-900 text-sm font-bold tracking-wide">PRICING</div>
                    <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Simple plans for everyone</h2>
                    <p class="mt-3 text-black/70">Start free. Upgrade when you need branding, tracking & team access.
                    </p>
                </div>
                <a href="tel:+917753800444"
                    class="px-6 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-white font-extrabold">
                    Talk to Sales
                </a>
            </div>

            <div class="mt-10 pt-12 grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Starter Plan -->
                <div
                    class="glass rounded-3xl p-7 flex flex-col justify-between hover:shadow-lg transition-shadow duration-300 bg-gray-100">
                    <div>
                        <div class="text-sm text-black/60 font-medium">Starter</div>
                        <div class="mt-2 text-3xl font-extrabold">
                            ₹0 <span class="text-base text-black/60">/month</span>
                        </div>
                        <p class="mt-4 text-black/70 text-sm">Best for trying QR generation.</p>

                        <ul class="mt-6 space-y-3 text-sm text-black/75">
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Unlimited QR
                                generate</li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> PNG download</li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> PDF download</li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Mobile responsive
                            </li>
                        </ul>
                    </div>

                    <a href="#generator"
                        class="mt-7 block text-center px-5 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold">
                        Start Free
                    </a>
                </div>

                <!-- Pro Plan (Highlighted) -->
                <div
                    class="glass rounded-3xl p-7 flex flex-col justify-between border-2 border-red-400/30 shadow-lg hover:shadow-xl transition-shadow duration-300 relative">

                    <!-- Most Popular Badge -->
                    <div
                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 inline-flex items-center gap-2 text-xs font-bold px-3 py-1 rounded-full bg-red-200 text-red-900 border border-red-600">
                        MOST POPULAR
                    </div>

                    <div class="mt-6">
                        <div class="text-sm text-black/60 font-medium">Pro</div>
                        <div class="mt-2 text-3xl font-extrabold">
                            ₹499 <span class="text-base text-black/60">/Yearly</span>
                        </div>
                        <p class="mt-4 text-black/70 text-sm">For businesses who want branding + history.</p>

                        <ul class="mt-6 space-y-3 text-sm text-black/75">
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> QR history (saved
                                list)</li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Custom name/tags
                            </li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Download PNG/PDF
                            </li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Priority support
                            </li>
                        </ul>
                    </div>

                    <a href="/register"
                        class="mt-7 block text-center px-5 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-white font-extrabold">
                        Upgrade to Pro
                    </a>
                </div>

                <!-- Business Plan -->
                <div
                    class="glass rounded-3xl p-7 flex flex-col justify-between hover:shadow-lg transition-shadow duration-300 bg-gray-100">
                    <div>
                        <div class="text-sm text-black/60 font-medium">Business</div>
                        <div class="mt-2 text-3xl font-extrabold">Custom</div>
                        <p class="mt-4 text-black/70 text-sm">For multi-branch + tracking + team accounts.</p>

                        <ul class="mt-6 space-y-3 text-sm text-black/75">
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Scan tracking
                                (analytics)</li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Team & roles</li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Logo QR + color
                                styles</li>
                            <li class="flex items-center gap-2"><span class="text-red-300">✓</span> Dedicated support
                            </li>
                        </ul>
                    </div>

                    <a href="tel:+917753800444"
                        class="mt-7 block text-center px-5 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold">
                        Book Demo
                    </a>
                </div>

            </div>


        </div>
    </section>

    <!-- ================= HOW IT WORKS ================= -->
    <section id="how" class="border-t border-white/10 bg-[#EAECEE]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="max-w-2xl">
                <div class="text-red-800 text-sm font-bold tracking-wide">HOW IT WORKS</div>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Generate QR in 3 simple steps</h2>
                <p class="mt-3 text-black/70">Simple flow for everyone. No technical knowledge required.</p>
            </div>

            <div class="mt-16 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div
                    class="glass bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div
                        class="h-12 w-12 rounded-3xl bg-red-500/20 border border-red-400/30 flex items-center justify-center font-extrabold text-red-600 text-lg group-hover:scale-110 transition-transform duration-300">
                        1
                    </div>
                    <h3
                        class="mt-5 text-xl font-bold text-red-700 group-hover:text-red-600 transition-colors duration-300">
                        Paste Your Link</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                        Website, Google review link, WhatsApp link, payment link, anything.
                    </p>
                </div>

                <!-- Step 2 -->
                <div
                    class="glass bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div
                        class="h-12 w-12 rounded-3xl bg-red-500/20 border border-red-400/30 flex items-center justify-center font-extrabold text-red-600 text-lg group-hover:scale-110 transition-transform duration-300">
                        2
                    </div>
                    <h3
                        class="mt-5 text-xl font-bold text-red-700 group-hover:text-red-600 transition-colors duration-300">
                        Generate QR</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                        One click generate with high error correction level.
                    </p>
                </div>

                <!-- Step 3 -->
                <div
                    class="glass bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div
                        class="h-12 w-12 rounded-3xl bg-red-500/20 border border-red-400/30 flex items-center justify-center font-extrabold text-red-600 text-lg group-hover:scale-110 transition-transform duration-300">
                        3
                    </div>
                    <h3
                        class="mt-5 text-xl font-bold text-red-700 group-hover:text-red-600 transition-colors duration-300">
                        Download & Share</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                        Download as PNG/PDF and use in posters, cards, packaging, etc.
                    </p>
                </div>
            </div>

        </div>
    </section>


    {{-- what are Qr means --}}
    {{-- <section  class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
          <!-- Section Title -->
   <!-- Section Title -->
  <div class="max-w-4xl mx-auto text-center ">
    <h1 class="text-4xl font-bold mb-4">What are QR Codes?</h1>
    <p class="text-gray-700 text-lg">
      QR codes (Quick Response codes) are scannable two-dimensional barcodes that store information
      such as URLs, contact details, or promotional content.
    </p>
  </div>

  <!-- Use Cases Cards -->
  <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-4 max-w-6xl mx-auto">

    <!-- Gather Feedback -->
    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
      <img src="{{ asset('asset/img/feedback.gif') }}" alt="Gather Feedback" class="mx-auto mb-4 rounded w-12 h-12">
      <h2 class="text-xl font-semibold mb-2 text-center">Gather Feedback</h2>
      <p class="text-gray-700 text-center text-sm">
        Ask users to provide feedback instantly when they scan your QR code. Collect insights efficiently.
      </p>
    </div>

    <!-- Describe Your Business -->
    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
      <img src="{{asset('asset/img/bussiness.gif') }}" alt="Describe Business" class="mx-auto mb-4 rounded w-12 h-12">
      <h2 class="text-xl font-semibold mb-2 text-center">Describe Your Business</h2>
      <p class="text-gray-700 text-center text-sm">
        Redirect clients to an instruction page or website to explain your business, services, or products clearly.
      </p>
    </div>

    <!-- Profile Cards -->
    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
      <img src="{{ asset('asset/img/instant.gif') }}" alt="Profile Cards" class="mx-auto mb-4 rounded h-12 w-12">
      <h2 class="text-xl font-semibold mb-2 text-center">Profile Cards</h2>
      <p class="text-gray-700 text-center text-sm">
        Digital profile cards replace physical cards. Share your contact info and social profiles instantly.
      </p>
    </div>

    <!-- Promote Events & Discounts -->
    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
      <img src="{{ asset('asset/img/pdf.gif') }}" alt="Promote Events" class="mx-auto mb-4 rounded h-12 w-12">
      <h2 class="text-xl font-semibold mb-2 text-center">Promote Events & Discounts</h2>
      <p class="text-gray-700 text-center text-sm">
        Share event details or discount codes directly with your audience when they scan your QR code.
      </p>
    </div>

  </div>
    </section> --}}


    {{--    QR CODES TYPES  --}}
    <section class=" py-20">
  <div class="max-w-7xl mx-auto px-6">

    <!-- Section Header -->
    <div class="text-center mb-14">
      <h2 class="text-4xl font-extrabold text-slate-800 mb-4">
        QR Code Types
      </h2>
      <p class="text-slate-600 max-w-2xl mx-auto">
        Choose from a variety of QR code types designed for different use cases and experiences.
      </p>
    </div>

    <!-- QR Types Grid -->
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">

      <!-- URL QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-blue-100 text-blue-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">
          <img src="{{ asset('asset/img/future.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">URL QR Code</h3>
        <p class="text-slate-600 text-sm">
          Direct users to websites, landing pages, or online content instantly.
        </p>
      </div>

      <!-- Text QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-green-100 text-green-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">
             <img src="{{ asset('asset/img/download.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">Text QR Code</h3>
        <p class="text-slate-600 text-sm">
          Share plain text messages without needing an internet connection.
        </p>
      </div>

      <!-- Contact QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-purple-100 text-purple-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">
             <img src="{{ asset('asset/img/feedback.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">Contact QR</h3>
        <p class="text-slate-600 text-sm">
          Instantly save contact details directly into a user’s phone.
        </p>
      </div>

      <!-- WiFi QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-orange-100 text-orange-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">
               <img src="{{ asset('asset/img/wifi.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">Wi-Fi QR</h3>
        <p class="text-slate-600 text-sm">
          Allow users to connect to Wi-Fi networks without typing passwords.
        </p>
      </div>

      <!-- Email QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-pink-100 text-pink-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">
               <img src="{{ asset('asset/img/bussiness.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">Email QR</h3>
        <p class="text-slate-600 text-sm">
          Pre-fill recipient, subject, and message for quick email actions.
        </p>
      </div>

      <!-- SMS QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-yellow-100 text-yellow-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">

                          <img src="{{ asset('asset/img/arrow.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">SMS QR</h3>
        <p class="text-slate-600 text-sm">
          Launch text messages instantly with a pre-defined number and text.
        </p>
      </div>

      <!-- App QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-indigo-100 text-indigo-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">
              <img src="{{ asset('asset/img/download.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">App QR</h3>
        <p class="text-slate-600 text-sm">
          Redirect users to app stores based on their device type.
        </p>
      </div>

      <!-- Dynamic QR -->
      <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition">
        <div class="bg-cyan-100 text-cyan-600 w-12 h-12 flex items-center justify-center rounded-xl mb-5">
               <img src="{{ asset('asset/img/response.gif') }}" alt="" class="w-10 h-10">
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">Dynamic QR</h3>
        <p class="text-slate-600 text-sm">
          Update content anytime and track scans with analytics.
        </p>
      </div>

    </div>
  </div>
</section>


    <!-- ================= FAQ ================= -->

    <script src="//unpkg.com/alpinejs" defer></script>

    <section id="faq" class="bg-[#F7F8F8] border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="max-w-2xl">
                <div class="text-red-800 text-sm font-bold tracking-wide">FAQ</div>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Frequently asked questions</h2>
                <p class="mt-3 text-black/70">Common doubts clear kar diye.</p>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="glass bg-[#D5DADE]/20 rounded-3xl p-6">
                    <div class="font-extrabold ">Is QR generation free?</div>
                    <div class="mt-2 text-sm text-black/70 bg-gray-200 p-4 rounded-xl">Yes, you can generate unlimited
                        QR codes for free.</div>
                </div>

                <div class="glass bg-[#D5DADE]/20 rounded-3xl p-6">
                    <div class="font-extrabold ">Can I save my QR codes?</div>
                    <div class="mt-2 text-sm text-black/70 bg-gray-200 p-4 rounded-xl">If you are logged in, QR codes
                        can be saved in your
                        account.</div>
                </div>
                <div class="glass bg-[#D5DADE]/20 rounded-3xl p-6">
                    <div class="font-extrabold">Which format can I download?</div>
                    <div class="mt-2 text-sm text-black/70 bg-gray-200 p-4 rounded-xl">You can download QR as PNG image
                        and PDF for print.</div>
                </div>
                <div class="glass bg-[#D5DADE]/20 rounded-3xl p-6">
                    <div class="font-extrabold">Can I add logo/colors in QR?</div>
                    <div class="mt-2 text-sm text-black/70 bg-gray-200 p-4 rounded-xl">In Pro/Business we can add logo
                        QR, colors and tracking.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CONTACT ================= -->
    <section id="contact" class="border-t border-white/10 py-12 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="glass bg-[#F7F8F8]/60 shadow-md rounded-3xl p-6 sm:p-8 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div>
                    <div class="text-sm text-red/10">Need custom QR solutions?</div>
                    <div class="text-2xl font-extrabold mt-1">Real Victory Groups</div>
                    <div class="text-sm text-black/70 mt-2">
                        73 Basement, Ekta Enclave Society, Lakhanpur, Khyora, Kanpur, Uttar Pradesh 208024
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <a href="mailto:realvictorygroups@gmail.com"
                        class="px-6 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition text-center font-semibold">
                        Email Us
                    </a>
                    <a href="tel:+917753800444"
                        class="px-6 py-3 rounded-2xl bg-red-500 hover:bg-red-400 transition text-white text-center font-extrabold">
                        Call: +91 77538 00444
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->


    {{-- <footer class="border-t border-white/10 py-8 bg-black/25">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-black/60">
            <div>© Real <span class="text-red-300 font-semibold">Victory</span> Groups 2025. All Rights Reserved.
            </div>
            <div class="flex items-center gap-4">
                <a class="hover:text-black" href="https://www.facebook.com/realvictorygroups/" target="_blank"
                    rel="noopener">Facebook</a>
                <a class="hover:text-black" href="https://www.instagram.com/realvictorygroups/" target="_blank"
                    rel="noopener">Instagram</a>
                <a class="hover:text-black"
                    href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all" target="_blank"
                    rel="noopener">LinkedIn</a>
            </div>
        </div>
    </footer> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <footer class="bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <!-- Branding -->
                <div>
                    <h2 class="text-2xl font-extrabold text-red-600 mb-4">QR Wale</h2>
                    <p class="text-gray-300">Generate, customize, and track QR codes effortlessly. Redefining
                        simplicity with style.</p>
                    <div class="flex space-x-4 mt-4">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/realvictorygroups/" target="_blank"
                            class="bg-red-500 text-gray-100 hover:text-blue-600 transition rounded-full hover:bg-white px-3 py-1">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/realvictorygroups/" target="_blank"
                            class="bg-red-500 text-gray-300 hover:text-pink-500 transition rounded-full hover:bg-white px-3 py-1">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all"
                            target="_blank"
                            class="bg-red-500 hover:bg-white text-gray-300 hover:text-blue-500 transition rounded-full  px-3 py-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold text-red-600 mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#faq" class="hover:text-red-600 transition">FAQ</a></li>
                        <li><a href="#features" class="hover:text-red-600 transition">Features</a></li>
                        <li><a href="#pricing" class="hover:text-red-600 transition">Pricing</a></li>
                        <li><a href="#contact" class="hover:text-red-600 transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h3 class="text-lg font-bold text-red-600 mb-4">Resources</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#contact" class="hover:text-red-600 transition">Blog</a></li>
                        <li><a href="#contact" class="hover:text-red-600 transition">Documentation</a></li>
                        <li><a href="#contact" class="hover:text-red-600 transition">API</a></li>
                        <li><a href="#contact" class="hover:text-red-600 transition">Support</a></li>
                    </ul>
                </div>

                <!-- Services-->
                <div>
                    <h3 class="text-lg font-bold text-red-600 mb-4">Services</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#contact" class="hover:text-red-600 transition">Digital Marketing</a></li>
                        <li><a href="#contact" class="hover:text-red-600 transition">Poster </a></li>
                        <li><a href="#contact" class="hover:text-red-600 transition">Website</a></li>
                        <li><a href="#contact" class="hover:text-red-600 transition">Application</a></li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-700 mt-12 pt-6 text-center text-gray-500 text-sm">
                &copy; 2026 Real Victory Groups. All rights reserved.
            </div>
        </div>
    </footer>


    <!-- ================= JS ================= -->


    {{-- <script>
        const urlInput = document.getElementById('url-input');
        const generateBtn = document.getElementById('generate-btn');
        const btnText = document.getElementById('btn-text');
        const btnSpinner = document.getElementById('btn-spinner');

        const qrcodeContainer = document.getElementById('qrcode');
        const qrContent = document.getElementById('qr-content');

        const downloadPdfBtn = document.getElementById('download-pdf-btn');
        const downloadImgBtn = document.getElementById('download-img-btn');
        const copyLinkBtn = document.getElementById('copy-link-btn');
        const resetBtn = document.getElementById('reset-btn');

        let qrCode = null;
        const fixedSize = 300;
        const fixedColor = "#000000";

        function setLoading(state) {
            generateBtn.disabled = state;
            btnSpinner.classList.toggle('hidden', !state);
            btnText.textContent = state ? 'Generating...' : 'Generate';
        }

        function isValidUrl(str) {
            try {
                const u = new URL(str);
                return u.protocol === "http:" || u.protocol === "https:";
            } catch (e) {
                return false;
            }
        }

        function renderQr(text) {
            if (qrCode) {
                qrCode.clear();
                qrcodeContainer.innerHTML = '';
            }

            qrCode = new QRCode(qrcodeContainer, {
                text,
                width: fixedSize,
                height: fixedSize,
                colorDark: fixedColor,
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            qrContent.textContent = text;
            copyLinkBtn.classList.remove('hidden');
            resetBtn.classList.remove('hidden');
        }

        async function handleGenerate() {
            const text = (urlInput.value || '').trim();

            if (!text) {
                Swal.fire({
                    icon: 'warning',
                    title: 'URL is required!',
                    text: 'Please enter a valid URL.'
                });
                return;
            }

            if (!isValidUrl(text)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid URL!',
                    text: 'Please enter a URL like https://example.com'
                });
                return;
            }

            setLoading(true);

            try {
                const response = await fetch('/save-qr', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        url: text
                    })
                });

                const data = await response.json().catch(() => null);

                if (!response.ok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Save failed!',
                        text: (data && (data.message || data.error)) ? (data.message || data.error) :
                            'Please try again.'
                    });
                    return;
                }

                renderQr(text);

                Swal.fire({
                    icon: 'success',
                    title: 'QR Generated!',
                    text: 'Your QR is ready & saved.',
                    timer: 1500,
                    showConfirmButton: false
                });

            } catch (e) {
                console.error(e);
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!',
                    text: 'Could not save the QR. Please try again.'
                });
            } finally {
                setLoading(false);
            }
        }

        generateBtn.addEventListener('click', handleGenerate);
        urlInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleGenerate();
            }
        });

        copyLinkBtn.addEventListener('click', async () => {
            const text = (urlInput.value || '').trim();
            if (!text) return;
            try {
                await navigator.clipboard.writeText(text);
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'URL copied to clipboard.',
                    timer: 1100,
                    showConfirmButton: false
                });
            } catch {
                Swal.fire({
                    icon: 'info',
                    title: 'Copy not supported',
                    text: 'Please copy manually.'
                });
            }
        });

        resetBtn.addEventListener('click', () => {
            urlInput.value = '';
            urlInput.focus();
            if (qrCode) {
                qrCode.clear();
                qrcodeContainer.innerHTML = '';
                qrCode = null;
            }
            qrContent.textContent = '';
            copyLinkBtn.classList.add('hidden');
            resetBtn.classList.add('hidden');
        });

        downloadPdfBtn.addEventListener('click', () => {
            if (!qrCode) {
                Swal.fire({
                    icon: 'info',
                    title: 'No QR Found!',
                    text: 'Please generate first.'
                });
                return;
            }

            const canvas = qrcodeContainer.querySelector('canvas');
            if (!canvas) {
                Swal.fire({
                    icon: 'error',
                    title: 'QR not ready',
                    text: 'Please generate again.'
                });
                return;
            }

            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();
            const text = (urlInput.value || '').trim();
            const imgData = canvas.toDataURL('image/png');

            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();
            const qrW = 90,
                qrH = 90;
            const x = (pageWidth - qrW) / 2;
            const y = (pageHeight - qrH) / 2 - 18;

            doc.addImage(imgData, 'PNG', x, y, qrW, qrH);

            doc.setFontSize(10);
            doc.setTextColor(80);
            const lines = doc.splitTextToSize(text, pageWidth - 30);
            doc.text(lines, pageWidth / 2, y + qrH + 12, {
                align: 'center'
            });

            doc.setFontSize(8);
            doc.setTextColor(160);
            doc.text('Generated with QRwale', pageWidth / 2, pageHeight - 10, {
                align: 'center'
            });

            doc.save('qr-code.pdf');
        });

        downloadImgBtn.addEventListener('click', () => {
            if (!qrCode) {
                Swal.fire({
                    icon: 'info',
                    title: 'No QR Found!',
                    text: 'Please generate first.'
                });
                return;
            }

            const canvas = qrcodeContainer.querySelector('canvas');
            if (!canvas) {
                Swal.fire({
                    icon: 'error',
                    title: 'QR not ready',
                    text: 'Please generate again.'
                });
                return;
            }

            const imageData = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            const now = new Date().toISOString().replace(/[:.-]/g, '');
            link.href = imageData;
            link.download = `qr-code-${now}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            Swal.fire({
                icon: 'success',
                title: 'Downloaded!',
                text: 'QR PNG downloaded.',
                timer: 1200,
                showConfirmButton: false
            });
        });

        urlInput.focus();
    </script> --}}



    <script>
        const urlInput = document.getElementById('url-input');
        const generateBtn = document.getElementById('generate-btn');
        const btnText = document.getElementById('btn-text');
        const btnSpinner = document.getElementById('btn-spinner');

        const qrcodeContainer = document.getElementById('qrcode');
        const qrContent = document.getElementById('qr-content');

        const downloadPdfBtn = document.getElementById('download-pdf-btn');
        const downloadImgBtn = document.getElementById('download-img-btn');
        const copyLinkBtn = document.getElementById('copy-link-btn');
        const resetBtn = document.getElementById('reset-btn');

        const logoEl = document.getElementById('qr-logo');

        let qrCode = null;
        const fixedSize = 300;
        const fixedColor = "#000000";

        // ✅ logo settings
        const logoSizeRatio = 0.25; // 25% of qr
        const logoWaitMs = 200; // wait for QR canvas render

        function setLoading(state) {
            generateBtn.disabled = state;
            btnSpinner.classList.toggle('hidden', !state);
            btnText.textContent = state ? 'Generating...' : 'Generate';
        }

        function isValidUrl(str) {
            try {
                const u = new URL(str);
                return u.protocol === "http:" || u.protocol === "https:";
            } catch (e) {
                return false;
            }
        }

        function hideLogo() {
            if (logoEl) logoEl.classList.add('hidden');
        }

        function showLogo() {
            if (logoEl) logoEl.classList.remove('hidden');
        }

        function renderQr(text) {
            // reset previous
            if (qrCode) {
                qrCode.clear();
                qrcodeContainer.innerHTML = '';
            }

            hideLogo();

            // generate qr
            qrCode = new QRCode(qrcodeContainer, {
                text,
                width: fixedSize,
                height: fixedSize,
                colorDark: fixedColor,
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            qrContent.textContent = text;
            copyLinkBtn.classList.remove('hidden');
            resetBtn.classList.remove('hidden');

            // show logo after render
            setTimeout(() => {
                showLogo();
            }, logoWaitMs);
        }

        async function handleGenerate() {
            const text = (urlInput.value || '').trim();

            if (!text) {
                Swal.fire({
                    icon: 'warning',
                    title: 'URL is required!',
                    text: 'Please enter a valid URL.'
                });
                return;
            }

            if (!isValidUrl(text)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid URL!',
                    text: 'Please enter a URL like https://example.com'
                });
                return;
            }

            setLoading(true);

            try {
                const response = await fetch('/save-qr', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        url: text
                    })
                });

                const data = await response.json().catch(() => null);

                if (!response.ok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Save failed!',
                        text: (data && (data.message || data.error)) ? (data.message || data.error) :
                            'Please try again.'
                    });
                    return;
                }

                renderQr(text);

                Swal.fire({
                    icon: 'success',
                    title: 'QR Generated!',
                    text: 'Your QR is ready & saved.',
                    timer: 1500,
                    showConfirmButton: false
                });

            } catch (e) {
                console.error(e);
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!',
                    text: 'Could not save the QR. Please try again.'
                });
            } finally {
                setLoading(false);
            }
        }

        generateBtn.addEventListener('click', handleGenerate);

        urlInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleGenerate();
            }
        });

        copyLinkBtn.addEventListener('click', async () => {
            const text = (urlInput.value || '').trim();
            if (!text) return;
            try {
                await navigator.clipboard.writeText(text);
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'URL copied to clipboard.',
                    timer: 1100,
                    showConfirmButton: false
                });
            } catch {
                Swal.fire({
                    icon: 'info',
                    title: 'Copy not supported',
                    text: 'Please copy manually.'
                });
            }
        });

        resetBtn.addEventListener('click', () => {
            urlInput.value = '';
            urlInput.focus();

            if (qrCode) {
                qrCode.clear();
                qrcodeContainer.innerHTML = '';
                qrCode = null;
            }

            qrContent.textContent = '';
            copyLinkBtn.classList.add('hidden');
            resetBtn.classList.add('hidden');
            hideLogo();
        });

        // ✅ helper: merge QR canvas + logo into one canvas (for PNG/PDF)
        async function buildFinalCanvas() {
            if (!qrCode) return null;

            const qrCanvas = qrcodeContainer.querySelector('canvas');
            if (!qrCanvas) return null;

            // ensure logo loaded (important for drawImage)
            if (logoEl && logoEl.src && !logoEl.complete) {
                await new Promise((resolve) => {
                    logoEl.onload = resolve;
                    logoEl.onerror = resolve;
                });
            }

            const finalCanvas = document.createElement('canvas');
            finalCanvas.width = qrCanvas.width;
            finalCanvas.height = qrCanvas.height;

            const ctx = finalCanvas.getContext('2d');
            ctx.drawImage(qrCanvas, 0, 0);

            // draw logo center (optional)
            if (logoEl && logoEl.src) {
                const size = qrCanvas.width * logoSizeRatio;
                const x = (qrCanvas.width - size) / 2;
                const y = (qrCanvas.height - size) / 2;

                // ✅ white background behind logo (helps scan)
                const pad = size * 0.12;
                const bgX = x - pad,
                    bgY = y - pad,
                    bgW = size + pad * 2,
                    bgH = size + pad * 2;

                // rounded rect background
                const r = 16;
                ctx.save();
                ctx.fillStyle = "#ffffff";
                ctx.beginPath();
                ctx.moveTo(bgX + r, bgY);
                ctx.arcTo(bgX + bgW, bgY, bgX + bgW, bgY + bgH, r);
                ctx.arcTo(bgX + bgW, bgY + bgH, bgX, bgY + bgH, r);
                ctx.arcTo(bgX, bgY + bgH, bgX, bgY, r);
                ctx.arcTo(bgX, bgY, bgX + bgW, bgY, r);
                ctx.closePath();
                ctx.fill();
                ctx.restore();

                ctx.drawImage(logoEl, x, y, size, size);
            }

            return finalCanvas;
        }

        downloadImgBtn.addEventListener('click', async () => {
            if (!qrCode) {
                Swal.fire({
                    icon: 'info',
                    title: 'No QR Found!',
                    text: 'Please generate first.'
                });
                return;
            }

            const finalCanvas = await buildFinalCanvas();
            if (!finalCanvas) {
                Swal.fire({
                    icon: 'error',
                    title: 'QR not ready',
                    text: 'Please generate again.'
                });
                return;
            }

            const imageData = finalCanvas.toDataURL('image/png');
            const link = document.createElement('a');
            const now = new Date().toISOString().replace(/[:.-]/g, '');
            link.href = imageData;
            link.download = `qr-code-${now}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            Swal.fire({
                icon: 'success',
                title: 'Downloaded!',
                text: 'QR PNG downloaded.',
                timer: 1200,
                showConfirmButton: false
            });
        });

        downloadPdfBtn.addEventListener('click', async () => {
            if (!qrCode) {
                Swal.fire({
                    icon: 'info',
                    title: 'No QR Found!',
                    text: 'Please generate first.'
                });
                return;
            }

            const finalCanvas = await buildFinalCanvas();
            if (!finalCanvas) {
                Swal.fire({
                    icon: 'error',
                    title: 'QR not ready',
                    text: 'Please generate again.'
                });
                return;
            }

            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            const text = (urlInput.value || '').trim();
            const imgData = finalCanvas.toDataURL('image/png');

            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();
            const qrW = 90,
                qrH = 90;
            const x = (pageWidth - qrW) / 2;
            const y = (pageHeight - qrH) / 2 - 18;

            doc.addImage(imgData, 'PNG', x, y, qrW, qrH);

            doc.setFontSize(10);
            doc.setTextColor(80);
            const lines = doc.splitTextToSize(text, pageWidth - 30);
            doc.text(lines, pageWidth / 2, y + qrH + 12, {
                align: 'center'
            });

            doc.setFontSize(8);
            doc.setTextColor(160);
            doc.text('Generated with QRwale', pageWidth / 2, pageHeight - 10, {
                align: 'center'
            });

            doc.save('qr-code.pdf');
        });

        urlInput.focus();
    </script>



    {{-- sort ulr --}}


    <script>
        const shortInput = document.getElementById('short-original-input');
        const shortBtn = document.getElementById('short-generate-btn');
        const shortBtnText = document.getElementById('short-btn-text');
        const shortSpinner = document.getElementById('short-btn-spinner');

        const shortResultWrap = document.getElementById('short-result-wrap');
        const shortResult = document.getElementById('short-result');
        const shortCopyBtn = document.getElementById('short-copy-btn');
        const shortOpenBtn = document.getElementById('short-open-btn');

        function shortLoading(state) {
            shortBtn.disabled = state;
            shortSpinner.classList.toggle('hidden', !state);
            shortBtnText.textContent = state ? 'Generating...' : 'Generate';
        }

        function isValidUrl(str) {
            try {
                const u = new URL(str);
                return u.protocol === "http:" || u.protocol === "https:";
            } catch (e) {
                return false;
            }
        }

        async function generateShort() {
            const url = (shortInput.value || '').trim();

            if (!url) {
                Swal.fire({
                    icon: 'warning',
                    title: 'URL required',
                    text: 'Please enter a valid URL.'
                });
                return;
            }
            if (!isValidUrl(url)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid URL',
                    text: 'Please enter a URL like https://example.com'
                });
                return;
            }

            shortLoading(true);

            try {
                const res = await fetch('{{ route('shorturls.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        original_url: url
                    })
                });

                const data = await res.json().catch(() => null);

                if (!res.ok || !data || !data.success) {
                    const msg = (data && (data.message || data.error)) ? (data.message || data.error) :
                        'Please try again.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: msg
                    });
                    return;
                }

                shortResult.value = data.short_url;
                shortOpenBtn.href = data.short_url;
                shortResultWrap.classList.remove('hidden');

                Swal.fire({
                    icon: 'success',
                    title: 'Short URL Ready!',
                    text: 'Copied/Share your link now.',
                    timer: 1200,
                    showConfirmButton: false
                });

            } catch (e) {
                console.error(e);
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!',
                    text: 'Could not create short URL.'
                });
            } finally {
                shortLoading(false);
            }
        }

        shortBtn.addEventListener('click', generateShort);
        shortInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                generateShort();
            }
        });

        shortCopyBtn.addEventListener('click', async () => {
            const text = (shortResult.value || '').trim();
            if (!text) return;
            try {
                await navigator.clipboard.writeText(text);
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'Short URL copied.',
                    timer: 900,
                    showConfirmButton: false
                });
            } catch {
                Swal.fire({
                    icon: 'info',
                    title: 'Copy not supported',
                    text: 'Please copy manually.'
                });
            }
        });
    </script>




</body>

</html>
