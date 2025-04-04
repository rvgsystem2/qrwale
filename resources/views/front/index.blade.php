{{-- NAVBAR --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <title>QRwale – Free & Custom QR Code Generator for Business, Events & Products</title>
    
    <meta name="description" content="Generate stylish, scannable QR codes for business, events, products & more. Free & secure QR code generator with tracking & logo options.">
    
    <meta name="keywords" content="QR code generator, free QR code, custom QR, business QR code, trackable QR codes, QR with logo, qrwale, qr wale">
    
    <meta name="author" content="QRwale Team">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://qrwale.com/">
    <meta property="og:title" content="QRwale – Free & Stylish QR Code Generator">
    <meta property="og:description" content="Create free, custom QR codes for your business, product, or event. Add logos, colors, and track performance.">
    <meta property="og:image" content="https://qrwale.com/logo.png"> <!-- Replace with actual preview image -->

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://qrwale.com/">
    <meta name="twitter:title" content="QRwale – Free QR Code Generator with Tracking & Customization">
    <meta name="twitter:description" content="Make your own free QR codes in seconds. Customize with logo, colors, and more. Ideal for business & marketing.">
    <meta name="twitter:image" content="https://qrwale.com/logo.png"> <!-- Replace with actual preview image -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}"> <!-- Replace with your favicon -->

    <!-- Canonical Link -->
    <link rel="canonical" href="https://qrwale.com/">

    <!-- Styles (Optional SEO boost) -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" /> --}}

    <!-- Structured Data for Google (Optional) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "QRwale",
      "url": "https://qrwale.com/",
      "description": "Free & custom QR code generator with logo, colors, and tracking for business, events, and more.",
      "publisher": {
        "@type": "Organization",
        "name": "QRwale"
      }
    }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">

    {{-- nav --}}
    @include('front.header')



    <!-- Hero Section -->
    <section class="w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-12">
            
            <!-- Image: Show first on mobile, second on desktop -->
            <div class="md:order-2 md:w-1/2">
                <img src="{{ asset('asset/img/hero.gif') }}" alt="QR visual" class="w-full" />
            </div>
    
            <!-- Text Content: Show second on mobile, first on desktop -->
            <div class="md:order-1 md:w-1/2">
                <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight tracking-tight">
                    <span class="text-gray-700">QR Wale for</span><br />
                    <span id="changing-text" class="text-[#CA0300]">Ordering</span>
                </h1>
                <h2 class="mt-6 text-2xl font-semibold text-gray-900">
                    Engage & Grow with <span class="underline decoration-[#CA0300]">QR Wale</span>
                </h2>
                <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                    Transform your business with our intelligent QR solutions. Drive more sales, track leads,
                    automate tasks, enhance service, boost efficiency, and manage links — all in one platform.
                </p>
                <div class="mt-8">
                    <a href="Tel:+ 91 77538 00444"
                        class="inline-flex items-center px-6 py-3 rounded-full bg-[#CA0300] text-white font-semibold shadow hover:bg-[#b00200] transition duration-300">
                        Connect With Us →
                    </a>
                </div>
    
                <!-- Social Media Links -->
                <div class="flex items-center space-x-4 mt-8">
                    <!-- Email -->
                    <a href="mailto:realvictorygroups@gmail.com"
                        class="group p-3 rounded-full bg-white shadow-md hover:bg-[#CA0300] transition duration-300">
                        <svg class="w-6 h-6 text-[#CA0300] group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/realvictorygroups/"
                        class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-600 transition duration-300">
                        <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 12.07C22 6.49 17.52 2 12 2S2 6.49 2 12.07c0 5.02 3.66 9.18 8.44 9.88v-6.99H7.9v-2.89h2.54V9.79c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.56v1.87h2.76l-.44 2.89h-2.32v6.99C18.34 21.25 22 17.09 22 12.07z" />
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/realvictorygroups/"
                        class="group p-3 rounded-full bg-white shadow-md hover:bg-pink-500 transition duration-300">
                        <svg class="w-6 h-6 text-pink-500 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                        </svg>
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all"
                        class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-700 transition duration-300">
                        <svg class="w-6 h-6 text-blue-700 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 5 2.12 5 3.5zM0 8h5v16H0V8zm7.5 0h4.7v2.2h.07c.66-1.25 2.28-2.57 4.7-2.57C20.2 7.63 22 9.52 22 13.14V24h-5v-9.6c0-2.3-.82-3.87-2.9-3.87-1.58 0-2.52 1.06-2.94 2.08-.15.36-.2.87-.2 1.37V24h-5V8z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    



    <!-- Navigation Bar -->
    {{-- <nav class="w-full border-b flex justify-center">
        <div class="max-w-full mx-auto px-4 flex items-center justify-between py-4">
            <div class="flex md:space-x-12 space-x-1 ">
                <a href="#reviews"
                    class="flex items-center md:space-x-2 text-rose-600 font-semibold border-b-2 border-rose-600 pb-1">
                    📅 Reviews & Feedbacks QR
                </a>
                <a href="#automation" class="flex items-center md:space-x-2 text-gray-600 hover:text-rose-600 transition">
                    👥 Automation QR <span class="text-xs bg-rose-200 text-rose-800 px-2 py-1 rounded-full">NEW</span>
                </a>
                <a href="#ordering"  class="flex items-center md:space-x-2 text-gray-600 hover:text-rose-600 transition">
                    🏪 Self Ordering QR
                </a>
            </div>
        </div>
    </nav> --}}

    <!-- Hero Section -->
    {{-- <section  id="reviews" class="w-full py-16 flex justify-center">
        <div class=" max-w-4xl px-2 flex flex-col md:flex-row items-center justify-between gap-1">

            <!-- Left Content -->
            <div class="md:w-full">
                <span
                    class="text-xs uppercase tracking-wide font-semibold bg-rose-100 text-rose-700 px-3 py-1 rounded">Magic
                    QR</span>
                <h1 class="mt-4 text-4xl font-bold text-gray-900">
                    <span class="underline decoration-rose-500">Positive Reviews</span> <br>
                    Magic QR
                </h1>
                <p class="mt-4 text-gray-600 text-lg">
                    Collect Positive Reviews & Eliminate Negative Reviews
                </p>

                <!-- Features List -->
                <ul class="mt-6 space-y-2">
                    <li class="flex items-center space-x-3 text-gray-700">
                        ✅ Collect Positive Reviews
                    </li>
                    <li class="flex items-center space-x-3 text-gray-700">
                        ✅ Eliminate Negative Reviews
                    </li>
                    <li class="flex items-center space-x-3 text-gray-700">
                        ✅ Feedback Management
                    </li>
                </ul>

                <!-- Button -->
                <div class="mt-6">
                    <a href="#"
                        class="inline-block px-6 py-3 rounded-full bg-rose-600 text-white font-semibold hover:bg-rose-700 transition">
                        Know More →
                    </a>
                </div>
            </div>

            <!-- Right Content -->
            <div class="md:w-full flex justify-center">
                <img src="{{ asset('asset/img/image1.jpg') }}" alt="Magic QR" class="w-full  rounded-lg shadow-lg">
            </div>

        </div>
    </section> --}}


    {{-- automation --}}

    {{-- <section id="automation" class="max-w-5xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Left Content: Customer Table & Balance Card -->
        <div>
            <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Customer</h2>
                    <a href="#" class="text-green-600 font-medium hover:underline flex items-center">
                        View All →
                    </a>
                </div>
                <table class="w-full border-collapse text-sm min-w-[600px]">
                    <thead>
                        <tr class="text-gray-500 text-xs sm:text-sm border-b">
                            <th class="text-left py-2">NAME</th>
                            <th class="text-left py-2">TOP ORDER</th>
                            <th class="text-left py-2">ORDER</th>
                            <th class="text-left py-2">LIKED PRODUCT</th>
                            <th class="text-left py-2">JOINED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b text-xs sm:text-sm">
                            <td class="py-2 flex items-center space-x-3">
                                <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full" />
                                <span>Lucia Prichett</span>
                            </td>
                            <td>Fashion</td>
                            <td>720</td>
                            <td>3,290</td>
                            <td>12 Dec 2023</td>
                        </tr>
                        <tr class="border-b text-xs sm:text-sm">
                            <td class="py-2 flex items-center space-x-3">
                                <img src="https://i.pravatar.cc/41" class="w-8 h-8 rounded-full" />
                                <span>Jake Adams</span>
                            </td>
                            <td>Cosmetic</td>
                            <td>1,200</td>
                            <td>2,708</td>
                            <td>09 Dec 2023</td>
                        </tr>
                    </tbody>
                </table>
    
                <!-- Pagination -->
                <div class="mt-4 flex flex-col sm:flex-row justify-between items-center text-xs sm:text-sm text-gray-600 space-y-2 sm:space-y-0">
                    <span>Showing 1 - 2 of 8</span>
                    <div class="flex items-center space-x-1 sm:space-x-2">
                        <button class="px-2 py-1 border rounded-md">◀</button>
                        <button class="px-2 py-1 border rounded-md bg-green-500 text-white">1</button>
                        <button class="px-2 py-1 border rounded-md">2</button>
                        <button class="px-2 py-1 border rounded-md">...</button>
                        <button class="px-2 py-1 border rounded-md">8</button>
                        <button class="px-2 py-1 border rounded-md">▶</button>
                    </div>
                </div>
            </div>
    
            <!-- Balance Card -->
            <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
                <p class="text-xs sm:text-sm text-gray-500">Your Balance</p>
                <div class="flex justify-between items-center mt-2">
                    <h3 class="text-xl sm:text-2xl font-semibold">$6,650.05</h3>
                    <span class="text-gray-400 text-xs sm:text-sm">💳 **** 9090</span>
                </div>
                <div class="mt-4 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <button class="w-full sm:w-1/2 bg-green-500 text-white py-2 rounded-lg">Transfer</button>
                    <button class="w-full sm:w-1/2 bg-green-100 text-green-700 py-2 rounded-lg">Request</button>
                </div>
            </div>
        </div>
    
        <!-- Right Content: Whatsapp QR Info -->
        <div>
            <span class="text-xs uppercase tracking-wide font-semibold bg-rose-100 text-rose-700 px-3 py-1 rounded">Automation QR</span>
            <h1 class="mt-4 text-3xl sm:text-4xl font-bold text-gray-900">
                <span class="underline decoration-rose-500">Whatsapp</span> Automation QR
            </h1>
            <p class="mt-4 text-gray-600 text-base sm:text-lg">
                Build strong client relationships with efficient communication and valuable feedback.
            </p>
    
            <!-- Features List -->
            <ul class="mt-6 space-y-2 sm:space-y-3">
                <li class="flex items-center space-x-2 sm:space-x-3 text-gray-700">
                    ✅ Increase client loyalty
                </li>
                <li class="flex items-center space-x-2 sm:space-x-3 text-gray-700">
                    ✅ Enhance task management
                </li>
                <li class="flex items-center space-x-2 sm:space-x-3 text-gray-700">
                    ✅ Improve client feedback
                </li>
            </ul>
    
            <!-- Button -->
            <div class="mt-6">
                <a href="#" class="inline-block px-5 sm:px-6 py-2 sm:py-3 rounded-full bg-rose-600 text-white font-semibold hover:bg-rose-700 transition">
                    Learn More →
                </a>
            </div>
        </div>
    </section> --}}
    {{-- ordering --}}

    {{-- <section  id="ordering" class="max-w-5xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Left Content -->
        <div>
            <span
                class="text-xs uppercase tracking-wide font-semibold bg-rose-100 text-rose-700 px-3 py-1 rounded">Self
                Ordering QR</span>
            <h1 class="mt-4 text-4xl font-bold text-gray-900">
                Increase sales <br>
                <span class="underline decoration-rose-500">Self-Ordering QR</span>
            </h1>
            <p class="mt-4 text-gray-600 text-lg">
                Our <strong>Self-Ordering QR System</strong> is designed to help businesses like yours save time, reduce
                costs, and enhance service quality!
            </p>

            <!-- Features List -->
            <ul class="mt-6 space-y-3">
                <li class="flex items-center space-x-3 text-gray-700">
                    ✅ <span>Real-Time Menu Management</span>
                </li>
                <li class="flex items-center space-x-3 text-gray-700">
                    ✅ <span>Increase Sales with Customizations</span>
                </li>
                <li class="flex items-center space-x-3 text-gray-700">
                    ✅ <span>Boost Efficiency & Reduce Wait Times</span>
                </li>
            </ul>

            <!-- Button -->
            <div class="mt-6">
                <a href="#"
                    class="inline-block px-6 py-3 rounded-full bg-rose-600 text-white font-semibold hover:bg-rose-700 transition">
                    Learn More →
                </a>
            </div>
        </div>

        <!-- Right Content: Image & Progress Card -->
        <div class="relative">
            <img src="{{asset('asset/img/self')}}" alt="Self-Ordering QR System" class="w-full rounded-lg shadow-lg">

            <!-- Progress Card -->
            <div class="absolute bottom-0 right-0 bg-white shadow-lg rounded-lg p-4 w-60">
                <p class="text-gray-500 text-sm">Project Done</p>
                <h3 class="text-xl font-bold">8,000</h3>
                <p class="text-green-600 text-sm font-semibold">10% ⬆ 100 Done This Week</p>

                <!-- Progress Bar -->
                <div class="mt-2 bg-gray-200 rounded-full h-2.5">
                    <div id="progress-bar" class="bg-green-500 h-2.5 rounded-full" style="width: 70%;"></div>
                </div>
                <p class="mt-1 text-gray-500 text-sm"><span id="progress-text">8,000</span> / 11,024</p>
            </div>
        </div>

    </section> --}}



    {{-- <section class="max-w-full bg-rose-400 mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Left Content -->
        <div>
            <span class="text-xs uppercase tracking-wide font-semibold bg-white/20 text-sky-300 px-3 py-1 rounded">Get Started</span>
            <h1 class="mt-4 text-4xl font-bold">
                Ready to <span class="underline decoration-blue-300">supercharge</span> <br>
                your business?
            </h1>
            <p class="mt-4 text-lg text-white/90">
                Grow sales and stay ahead in the competitive market by being among the first to benefit from our game-changing solutions.
            </p>
            
            <!-- Button -->
            <div class="mt-6">
                <a href="#" class="inline-block px-6 py-3 rounded-full bg-white text-pink-600 font-semibold hover:bg-gray-100 transition">
                    Contact Sales
                </a>
            </div>
        </div>

        <!-- Right Content: Image -->
        <div class="relative">
            <img src="{{asset('asset/img/crm-mockup-cta.png')}}" alt="Business Dashboard" class="w-full ">
        </div>

    </section> --}}


    {{-- footer --}}
    <footer class="bg-gray-100 py-12 text-gray-800">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            
            <!-- Branding -->
            <div>
                <h3 class="text-2xl font-extrabold text-red-600 mb-4">QR Wale</h3>
                <img src="{{ asset('logo.png') }}" alt="QR Wale Logo" class="w-32">
            </div>
    
            <!-- Resources -->
            <div>
                <h4 class="text-sm font-semibold uppercase text-red-600 mb-4">Connect</h4>
                <ul class="space-y-2 text-base">
                    <li><a href="mailto:realvictorygroups@gmail.com" class="hover:text-red-600 transition">Email</a></li>
                    <li><a href="https://www.facebook.com/realvictorygroups/" class="hover:text-red-600 transition">Facebook</a></li>
                    <li><a href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all" class="hover:text-red-600 transition">Linkedin</a></li>
                    <li><a href="https://www.instagram.com/realvictorygroups/" class="hover:text-red-600 transition">instagram</a></li>
                </ul>
            </div>
    
            <!-- Contact -->
            <div>
                <h4 class="text-sm font-semibold uppercase text-red-600 mb-4">Contact Us</h4>
                <ul class="space-y-2 text-base">
                    
                        <li>73 Basement, Ekta Enclave Society, Lakhanpur, Khyora, Kanpur, Uttar Pradesh 208024</li>
                    <li><a href="mailto:realvictorygroups@gmail.com " class="hover:text-red-600 transition">realvictorygroups@gmail.com </a></li>
                    <li>+ 91 77538 00444</li>
                </ul>
            </div>
    
            
           <!-- Support with Google Map -->
<div>
    <h4 class="text-sm font-semibold uppercase text-red-600 mb-4">Our Location</h4>
    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-md">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3570.795247124584!2d80.27712277488058!3d26.494536677937603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c3826d4ebf859%3A0xe9e2ed37cc371552!2sReal%20Victory%20Groups!5e0!3m2!1sen!2sin!4v1743753208287!5m2!1sen!2sin" 
            class="w-full h-full border-0" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

    
        </div>

         {{-- bottom socail media icon --}}
    <div class="bg-gray-100 pt-2">
        <div
            class="flex  px-3 m-auto border-t text-gray-800 text-sm flex-col
          max-w-screen-lg items-center">
          <div class="flex items-center space-x-4 mt-8">

            <!-- Email -->
            <a href="mailto:realvictorygroups@gmail.com"
                class="group p-3 rounded-full bg-white shadow-md hover:bg-[#CA0300] transition duration-300">
                <svg class="w-6 h-6 text-[#CA0300] group-hover:text-white" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
                </svg>
            </a>

            <!-- Facebook -->
            <a href="https://www.facebook.com/realvictorygroups/"
                class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-600 transition duration-300">
                <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M22 12.07C22 6.49 17.52 2 12 2S2 6.49 2 12.07c0 5.02 3.66 9.18 8.44 9.88v-6.99H7.9v-2.89h2.54V9.79c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.56v1.87h2.76l-.44 2.89h-2.32v6.99C18.34 21.25 22 17.09 22 12.07z" />
                </svg>
            </a>

            

            <!-- Instagram -->
            <a href="https://www.instagram.com/realvictorygroups/"
                class="group p-3 rounded-full bg-white shadow-md hover:bg-pink-500 transition duration-300">
                <svg class="w-6 h-6 text-pink-500 group-hover:text-white" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                </svg>
            </a>

            <!-- LinkedIn -->
            <a href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all"
                class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-700 transition duration-300">
                <svg class="w-6 h-6 text-blue-700 group-hover:text-white" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 5 2.12 5 3.5zM0 8h5v16H0V8zm7.5 0h4.7v2.2h.07c.66-1.25 2.28-2.57 4.7-2.57C20.2 7.63 22 9.52 22 13.14V24h-5v-9.6c0-2.3-.82-3.87-2.9-3.87-1.58 0-2.52 1.06-2.94 2.08-.15.36-.2.87-.2 1.37V24h-5V8z" />
                </svg>
            </a>
        </div>
            <div class="my-5">© Real <span class="text-[#CA0300]">Victroy</span> Groups 2025. All Rights Reserved.</div>
        </div>
    </div>
    </footer>
    

   



    <script>
        // Simulated dynamic progress bar update
        document.addEventListener("DOMContentLoaded", function() {
            let progress = 8000;
            let total = 11024;
            let percentage = (progress / total) * 100;

            document.getElementById("progress-bar").style.width = percentage + "%";
            document.getElementById("progress-text").innerText = progress;
        });
    </script>



    <!-- JavaScript for Dynamic Text -->
    <script>
        const words = ["Ordering", "Links", "Reviews ", "FeedBacks"];
        let index = 0;
        const changingText = document.getElementById("changing-text");

        function changeWord() {
            changingText.textContent = words[index];
            index = (index + 1) % words.length; // Loop back to the first word
        }

        setInterval(changeWord, 2000); // Change text every 2 seconds
    </script>




</body>

</html>
