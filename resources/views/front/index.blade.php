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
                radial-gradient(1200px 650px at 70% 55%, rgba(16, 185, 129, .22), transparent 60%),
                radial-gradient(900px 520px at 35% 60%, rgba(59, 130, 246, .12), transparent 55%),
                radial-gradient(600px 420px at 30% 20%, rgba(99, 102, 241, .10), transparent 55%),
                linear-gradient(to bottom, #040714 0%, #070a16 40%, #050815 100%);
        }

        .glass {
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .08);
            box-shadow: 0 18px 45px rgba(0, 0, 0, .35);
            backdrop-filter: blur(10px);
        }

        .soft-border {
            border: 1px solid rgba(255, 255, 255, .10);
        }
    </style>
</head>

<body class="text-white bg-hero min-h-screen">

    <!-- ================= NAVBAR ================= -->
    <header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-white/10 bg-black/25 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-3">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" class="h-10 w-10 rounded-xl bg-white p-1" alt="QRwale Logo">
                <div class="leading-tight">
                    <div class="font-extrabold tracking-tight">QRwale</div>
                    <div class="text-xs text-white/60 -mt-0.5">By Real Victory Groups</div>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-7 text-sm text-white/80">
                <a href="#features" class="hover:text-white transition">Features</a>
                <a href="#pricing" class="hover:text-white transition">Pricing</a>
                <a href="#how" class="hover:text-white transition">How it works</a>
                <a href="#faq" class="hover:text-white transition">FAQ</a>
                <a href="#contact" class="hover:text-white transition">Contact</a>
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
                    class="px-4 py-2 rounded-xl border border-emerald-400/40 text-emerald-200 bg-emerald-500/10 hover:bg-emerald-500/20 transition text-sm font-semibold">
                    Register
                </a>
                <a href="tel:+917753800444"
                    class="px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-400 transition text-sm font-extrabold text-black">
                    Book Demo
                </a>
            </div>

            <button @click="open=!open"
                class="lg:hidden inline-flex items-center justify-center h-10 w-10 rounded-xl soft-border bg-white/5 hover:bg-white/10">
                <span class="text-lg">☰</span>
            </button>
        </div>

        <div x-show="open" x-transition class="lg:hidden border-t border-white/10 bg-black/40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 space-y-3 text-white/80 text-sm">
                <a href="#features" class="block hover:text-white">Features</a>
                <a href="#pricing" class="block hover:text-white">Pricing</a>
                <a href="#how" class="block hover:text-white">How it works</a>
                <a href="#faq" class="block hover:text-white">FAQ</a>
                <a href="#contact" class="block hover:text-white">Contact</a>
                <div class="pt-3 grid grid-cols-2 gap-3">
                    <a href="/login"
                        class="px-4 py-2 rounded-xl soft-border bg-white/5 text-center font-semibold">Login</a>
                    <a href="/register"
                        class="px-4 py-2 rounded-xl bg-emerald-500 text-black text-center font-extrabold">Register</a>
                    <a href="#generator"
                        class="col-span-2 px-4 py-2 rounded-xl soft-border bg-white/5 text-center font-semibold">Generate
                        QR</a>
                </div>
            </div>
        </div>
    </header>

    <!-- ================= HERO ================= -->
    <section class="relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-6">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full soft-border bg-white/5 text-xs sm:text-sm text-emerald-100">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        Specially crafted for Business • Events • Products
                    </div>

                    <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Smart QR Generator for<br>
                        <span class="text-emerald-300">Modern Businesses</span>
                    </h1>

                    <p class="mt-5 text-white/75 text-base sm:text-lg leading-relaxed max-w-xl">
                        Create QR codes for <span class="text-emerald-200 font-semibold">Links, Ordering, Reviews,
                            Feedback</span>.
                        Download as PNG/PDF. Clean, fast & mobile responsive.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="#generator"
                            class="px-6 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black font-extrabold text-center">
                            Get Free Demo
                        </a>
                        <a href="#features"
                            class="px-6 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold text-center">
                            View Features →
                        </a>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4 text-sm text-white/75">
                        <div class="flex items-center gap-2">
                            <span
                                class="h-9 w-9 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">✓</span>
                            <span>No installation — runs in browser</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="h-9 w-9 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">⚡</span>
                            <span>Fast generation & downloads</span>
                        </div>
                    </div>
                </div>

                <!-- Right Live Preview -->
                <div class="lg:col-span-6">
                    <div class="glass rounded-3xl p-5 sm:p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-sm text-white/60">QRwale Live Preview</div>
                                <div class="text-xl font-extrabold mt-1">Generate & Download QR</div>
                                <div class="text-sm text-white/60 mt-1">Auto preview • PNG/PDF export</div>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/15 text-emerald-200 border border-emerald-400/20">
                                LIVE PREVIEW
                            </span>
                        </div>

                        <div id="generator" class="mt-5 rounded-2xl soft-border bg-black/25 p-4 sm:p-5">
                            <label class="text-sm font-semibold text-white/80">Enter URL</label>
                            <div class="mt-2 flex flex-col sm:flex-row gap-2">
                                <input id="url-input" type="text" placeholder="https://example.com"
                                    class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/30 border border-white/10 text-white placeholder:text-white/35 focus:border-emerald-400/40 focus:ring-4 focus:ring-emerald-500/10 transition" />
                                <button id="generate-btn"
                                    class="px-5 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black font-extrabold disabled:opacity-60 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
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
                                        <span class="text-xs text-white/60">Level: H</span>
                                    </div>
                                    <div class="mt-4 rounded-2xl bg-white p-3 flex items-center justify-center">
                                        <div id="qrcode" class="flex justify-center"></div>
                                    </div>
                                    <p id="qr-content" class="mt-3 text-xs text-white/60 break-all"></p>
                                </div>

                                <div class="md:col-span-5 rounded-2xl soft-border bg-black/25 p-4">
                                    <div class="font-bold">Downloads</div>
                                    <p class="text-xs text-white/60 mt-1">Get QR as PDF or PNG</p>
                                    <div class="mt-4 space-y-2">
                                        <button id="download-pdf-btn"
                                            class="w-full py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-bold">
                                            Download PDF
                                        </button>
                                        <button id="download-img-btn"
                                            class="w-full py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition font-extrabold text-black">
                                            Download PNG
                                        </button>
                                    </div>
                                    <div class="mt-4 text-xs text-white/60">One-click share • Print ready</div>
                                </div>
                            </div>

                            <div
                                class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between text-xs text-white/60">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-8 w-8 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">⤴</span>
                                    One-click QR download
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-8 w-8 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">☁</span>
                                    Secure save on login
                                </div>
                            </div>
                        </div>

                        <p class="mt-4 text-sm text-white/60">
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
            <div class="glass rounded-3xl p-5 sm:p-6">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="text-sm text-white/60">Free Short URL Generator</div>
                        <div class="text-xl font-extrabold mt-1">Create Short Link</div>
                        <div class="text-sm text-white/60 mt-1">Instant generate • Copy • Saved automatically</div>
                    </div>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/15 text-emerald-200 border border-emerald-400/20">
                        FREE
                    </span>
                </div>

                <div class="mt-5 rounded-2xl soft-border bg-black/25 p-4 sm:p-5">
                    <label class="text-sm font-semibold text-white/80">Enter Original URL</label>

                    <div class="mt-2 flex flex-col sm:flex-row gap-2">
                        <input id="short-original-input" type="url" placeholder="https://example.com/page"
                            class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/30 border border-white/10 text-white placeholder:text-white/35 focus:border-emerald-400/40 focus:ring-4 focus:ring-emerald-500/10 transition" />

                        <button id="short-generate-btn"
                            class="px-5 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black font-extrabold disabled:opacity-60 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                            <span id="short-btn-text">Generate</span>
                            <span id="short-btn-spinner"
                                class="hidden h-4 w-4 rounded-full border-2 border-black/40 border-t-transparent animate-spin"></span>
                        </button>
                    </div>

                    <div id="short-result-wrap" class="hidden mt-4 rounded-2xl soft-border bg-black/25 p-4">
                        <div class="text-sm text-white/70">Your Short URL</div>

                        <div class="mt-2 flex flex-col sm:flex-row gap-2 sm:items-center">
                            <input id="short-result" readonly
                                class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/30 border border-white/10 text-white" />
                            <button id="short-copy-btn"
                                class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-extrabold">
                                Copy
                            </button>
                            <a id="short-open-btn" href="#" target="_blank"
                                class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-extrabold text-center">
                                Open
                            </a>
                        </div>

                        <div class="mt-2 text-xs text-white/60">
                            Saved automatically. You can generate unlimited links.
                        </div>
                    </div>

                    <div class="mt-4 text-xs text-white/60">
                        Works for Products • WhatsApp • Google Reviews • Landing Pages • Campaign links
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- ================= FEATURES (FULL) ================= -->
    <section id="features" class="border-t border-white/10 bg-black/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="max-w-2xl">
                <div class="text-emerald-200 text-sm font-bold tracking-wide">FEATURES</div>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Everything you need to generate QR codes</h2>
                <p class="mt-3 text-white/70">Simple for users, powerful for businesses. Works perfectly on mobile &
                    desktop.</p>
            </div>

            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="glass rounded-3xl p-6">
                    <div class="text-2xl">⚡</div>
                    <div class="mt-3 font-extrabold text-lg">Instant QR Generation</div>
                    <div class="mt-2 text-sm text-white/65">Paste URL → Generate → Download. No extra steps.</div>
                </div>

                <div class="glass rounded-3xl p-6">
                    <div class="text-2xl">📱</div>
                    <div class="mt-3 font-extrabold text-lg">Mobile Responsive</div>
                    <div class="mt-2 text-sm text-white/65">Perfect UI for mobile screens and fast loading.</div>
                </div>

                <div class="glass rounded-3xl p-6">
                    <div class="text-2xl">🧾</div>
                    <div class="mt-3 font-extrabold text-lg">PDF Export</div>
                    <div class="mt-2 text-sm text-white/65">Print-ready PDF with QR and URL text.</div>
                </div>

                <div class="glass rounded-3xl p-6">
                    <div class="text-2xl">🖼️</div>
                    <div class="mt-3 font-extrabold text-lg">PNG Download</div>
                    <div class="mt-2 text-sm text-white/65">High quality QR image, easy to share.</div>
                </div>

                <div class="glass rounded-3xl p-6">
                    <div class="text-2xl">🔒</div>
                    <div class="mt-3 font-extrabold text-lg">Secure Save</div>
                    <div class="mt-2 text-sm text-white/65">Login required to save QR code record.</div>
                </div>

                <div class="glass rounded-3xl p-6">
                    <div class="text-2xl">🧠</div>
                    <div class="mt-3 font-extrabold text-lg">Future Ready</div>
                    <div class="mt-2 text-sm text-white/65">Add tracking, logo QR, custom colors anytime.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= PRICING ================= -->
    <section id="pricing" class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <div class="text-emerald-200 text-sm font-bold tracking-wide">PRICING</div>
                    <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Simple plans for everyone</h2>
                    <p class="mt-3 text-white/70">Start free. Upgrade when you need branding, tracking & team access.
                    </p>
                </div>
                <a href="tel:+917753800444"
                    class="px-6 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black font-extrabold">
                    Talk to Sales
                </a>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Free -->
                <div class="glass rounded-3xl p-7">
                    <div class="text-sm text-white/60">Starter</div>
                    <div class="mt-2 text-3xl font-extrabold">₹0 <span class="text-base text-white/60">/month</span>
                    </div>
                    <div class="mt-4 text-white/70 text-sm">Best for trying QR generation.</div>
                    <ul class="mt-6 space-y-3 text-sm text-white/75">
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Unlimited QR generate</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> PNG download</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> PDF download</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Mobile responsive</li>
                    </ul>
                    <a href="#generator"
                        class="mt-7 block text-center px-5 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold">
                        Start Free
                    </a>
                </div>

                <!-- Pro (highlight) -->
                <div
                    class="glass rounded-3xl p-7 border border-emerald-400/30 shadow-[0_0_0_1px_rgba(16,185,129,.15)]">
                    <div
                        class="inline-flex items-center gap-2 text-xs font-bold px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-200 border border-emerald-400/20">
                        MOST POPULAR
                    </div>
                    <div class="mt-3 text-sm text-white/60">Pro</div>
                    <div class="mt-2 text-3xl font-extrabold">₹499 <span class="text-base text-white/60">/Yearly</span>
                    </div>
                    <div class="mt-4 text-white/70 text-sm">For businesses who want branding + history.</div>
                    <ul class="mt-6 space-y-3 text-sm text-white/75">
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> QR history (saved list)</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Custom name/tags</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Download PNG/PDF</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Priority support</li>
                    </ul>
                    <a href="/register"
                        class="mt-7 block text-center px-5 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black font-extrabold">
                        Upgrade to Pro
                    </a>
                </div>

                <!-- Business -->
                <div class="glass rounded-3xl p-7">
                    <div class="text-sm text-white/60">Business</div>
                    <div class="mt-2 text-3xl font-extrabold">Custom</div>
                    <div class="mt-4 text-white/70 text-sm">For multi-branch + tracking + team accounts.</div>
                    <ul class="mt-6 space-y-3 text-sm text-white/75">
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Scan tracking (analytics)</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Team & roles</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Logo QR + color styles</li>
                        <li class="flex gap-2"><span class="text-emerald-300">✓</span> Dedicated support</li>
                    </ul>
                    <a href="tel:+917753800444"
                        class="mt-7 block text-center px-5 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold">
                        Book Demo
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= HOW IT WORKS ================= -->
    <section id="how" class="border-t border-white/10 bg-black/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="max-w-2xl">
                <div class="text-emerald-200 text-sm font-bold tracking-wide">HOW IT WORKS</div>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Generate QR in 3 simple steps</h2>
                <p class="mt-3 text-white/70">Simple flow for everyone. No technical knowledge required.</p>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="glass rounded-3xl p-7">
                    <div
                        class="h-10 w-10 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center font-extrabold">
                        1</div>
                    <div class="mt-4 text-lg font-extrabold">Paste your link</div>
                    <div class="mt-2 text-sm text-white/70">Website, Google review link, WhatsApp link, payment link,
                        anything.</div>
                </div>
                <div class="glass rounded-3xl p-7">
                    <div
                        class="h-10 w-10 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center font-extrabold">
                        2</div>
                    <div class="mt-4 text-lg font-extrabold">Generate QR</div>
                    <div class="mt-2 text-sm text-white/70">One click generate with high error correction level.</div>
                </div>
                <div class="glass rounded-3xl p-7">
                    <div
                        class="h-10 w-10 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center font-extrabold">
                        3</div>
                    <div class="mt-4 text-lg font-extrabold">Download & share</div>
                    <div class="mt-2 text-sm text-white/70">Download as PNG/PDF and use in posters, cards, packaging,
                        etc.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FAQ ================= -->
    <section id="faq" class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="max-w-2xl">
                <div class="text-emerald-200 text-sm font-bold tracking-wide">FAQ</div>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold">Frequently asked questions</h2>
                <p class="mt-3 text-white/70">Common doubts clear kar diye.</p>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="glass rounded-3xl p-6">
                    <div class="font-extrabold">Is QR generation free?</div>
                    <div class="mt-2 text-sm text-white/70">Yes, you can generate unlimited QR codes for free.</div>
                </div>
                <div class="glass rounded-3xl p-6">
                    <div class="font-extrabold">Can I save my QR codes?</div>
                    <div class="mt-2 text-sm text-white/70">If you are logged in, QR codes can be saved in your
                        account.</div>
                </div>
                <div class="glass rounded-3xl p-6">
                    <div class="font-extrabold">Which format can I download?</div>
                    <div class="mt-2 text-sm text-white/70">You can download QR as PNG image and PDF for print.</div>
                </div>
                <div class="glass rounded-3xl p-6">
                    <div class="font-extrabold">Can I add logo/colors in QR?</div>
                    <div class="mt-2 text-sm text-white/70">In Pro/Business we can add logo QR, colors and tracking.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CONTACT ================= -->
    <section id="contact" class="border-t border-white/10 py-12 bg-black/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="glass rounded-3xl p-6 sm:p-8 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div>
                    <div class="text-sm text-white/60">Need custom QR solutions?</div>
                    <div class="text-2xl font-extrabold mt-1">Real Victory Groups</div>
                    <div class="text-sm text-white/70 mt-2">
                        73 Basement, Ekta Enclave Society, Lakhanpur, Khyora, Kanpur, Uttar Pradesh 208024
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <a href="mailto:realvictorygroups@gmail.com"
                        class="px-6 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition text-center font-semibold">
                        Email Us
                    </a>
                    <a href="tel:+917753800444"
                        class="px-6 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black text-center font-extrabold">
                        Call: +91 77538 00444
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->


    <footer class="border-t border-white/10 py-8 bg-black/25">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-white/60">
            <div>© Real <span class="text-emerald-300 font-semibold">Victory</span> Groups 2025. All Rights Reserved.
            </div>
            <div class="flex items-center gap-4">
                <a class="hover:text-white" href="https://www.facebook.com/realvictorygroups/" target="_blank"
                    rel="noopener">Facebook</a>
                <a class="hover:text-white" href="https://www.instagram.com/realvictorygroups/" target="_blank"
                    rel="noopener">Instagram</a>
                <a class="hover:text-white"
                    href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all" target="_blank"
                    rel="noopener">LinkedIn</a>
            </div>
        </div>
    </footer>

    <!-- ================= JS ================= -->


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

  function shortLoading(state){
    shortBtn.disabled = state;
    shortSpinner.classList.toggle('hidden', !state);
    shortBtnText.textContent = state ? 'Generating...' : 'Generate';
  }

  function isValidUrl(str) {
    try { const u = new URL(str); return u.protocol === "http:" || u.protocol === "https:"; }
    catch (e) { return false; }
  }

  async function generateShort(){
    const url = (shortInput.value || '').trim();

    if(!url){
      Swal.fire({ icon: 'warning', title: 'URL required', text: 'Please enter a valid URL.' });
      return;
    }
    if(!isValidUrl(url)){
      Swal.fire({ icon: 'warning', title: 'Invalid URL', text: 'Please enter a URL like https://example.com' });
      return;
    }

    shortLoading(true);

    try{
      const res = await fetch('{{ route("shorturls.store") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ original_url: url })
      });

      const data = await res.json().catch(() => null);

      if(!res.ok || !data || !data.success){
        const msg = (data && (data.message || data.error)) ? (data.message || data.error) : 'Please try again.';
        Swal.fire({ icon: 'error', title: 'Failed', text: msg });
        return;
      }

      shortResult.value = data.short_url;
      shortOpenBtn.href = data.short_url;
      shortResultWrap.classList.remove('hidden');

      Swal.fire({ icon: 'success', title: 'Short URL Ready!', text: 'Copied/Share your link now.', timer: 1200, showConfirmButton: false });

    }catch(e){
      console.error(e);
      Swal.fire({ icon: 'error', title: 'Something went wrong!', text: 'Could not create short URL.' });
    }finally{
      shortLoading(false);
    }
  }

  shortBtn.addEventListener('click', generateShort);
  shortInput.addEventListener('keydown', (e) => {
    if(e.key === 'Enter'){ e.preventDefault(); generateShort(); }
  });

  shortCopyBtn.addEventListener('click', async () => {
    const text = (shortResult.value || '').trim();
    if(!text) return;
    try{
      await navigator.clipboard.writeText(text);
      Swal.fire({ icon: 'success', title: 'Copied!', text: 'Short URL copied.', timer: 900, showConfirmButton: false });
    }catch{
      Swal.fire({ icon: 'info', title: 'Copy not supported', text: 'Please copy manually.' });
    }
  });
</script>




</body>

</html>
