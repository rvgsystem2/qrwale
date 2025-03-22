{{-- NAVBAR --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

 {{-- nav --}}
 @include('front.header')



    <!-- Hero Section -->
    <section class="w-full py-16">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-10">

            <!-- Left Content -->
            <div class="md:w-1/2">
                <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">
                    <span class="text-gray-600"> QR Wale for</span><br />
                    <span id="changing-text" class="text-rose-600">Ordering</span>
                </h1>
                <h2 class="mt-6 text-2xl font-bold text-gray-900">
                    Engage & Grow By <span class="underline decoration-rose-500">QR Wale</span>
                </h2>
                <p class="mt-4 text-gray-600 text-lg">
                    Transform your business with our intelligent QR solutions.
                    Drive more sales, track leads, automate tasks, enhance service,
                    boost efficiency & links — all in one.
                </p>
                <div class="mt-6">
                    <a href="#"
                        class="inline-flex items-center px-6 py-3 rounded-full bg-rose-600 text-white font-semibold hover:bg-rose-700 transition duration-300">
                        Free Signup →
                    </a>
                </div>
            </div>

            <!-- Right Image -->
            <div class="md:w-1/2">
                <img src="{{ asset('asset/img/hero.gif') }}" alt=" QR visual" class="w-full " />
            </div>
        </div>
    </section>


    <!-- Navigation Bar -->
    <nav class="w-full border-b flex justify-center">
        <div class="max-w-full mx-auto px-4 flex items-center justify-between py-4">
            <div class="flex space-x-12 ">
                <a href="#reviews"
                    class="flex items-center space-x-2 text-rose-600 font-semibold border-b-2 border-rose-600 pb-1">
                    📅 Reviews & Feedbacks QR
                </a>
                <a href="#automation" class="flex items-center space-x-2 text-gray-600 hover:text-rose-600 transition">
                    👥 Automation QR <span class="text-xs bg-rose-200 text-rose-800 px-2 py-1 rounded-full">NEW</span>
                </a>
                <a href="#ordering"  class="flex items-center space-x-2 text-gray-600 hover:text-rose-600 transition">
                    🏪 Self Ordering QR
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section  id="reviews" class="w-full py-16 flex justify-center">
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
    </section>


    {{-- automation --}}


    <section id="automation" class="max-w-5xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Left Content: Customer Table & Balance Card -->
        <div>
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Customer</h2>
                    <a href="#" class="text-green-600 font-medium hover:underline flex items-center">
                        View All →
                    </a>
                </div>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-gray-500 text-sm border-b">
                            <th class="text-left py-2">NAME</th>
                            <th class="text-left py-2">TOP ORDER</th>
                            <th class="text-left py-2">ORDER</th>
                            <th class="text-left py-2">LIKED PRODUCT</th>
                            <th class="text-left py-2">JOINED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b text-sm">
                            <td class="py-2 flex items-center space-x-3">
                                <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full" />
                                <span>Lucia Prichett</span>
                            </td>
                            <td>Fashion</td>
                            <td>720</td>
                            <td>3,290</td>
                            <td>12 Dec 2023</td>
                        </tr>
                        <tr class="border-b text-sm">
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
                <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
                    <span>Showing 1 - 2 of 8</span>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1 border rounded-md">◀</button>
                        <button class="px-3 py-1 border rounded-md bg-green-500 text-white">1</button>
                        <button class="px-3 py-1 border rounded-md">2</button>
                        <button class="px-3 py-1 border rounded-md">...</button>
                        <button class="px-3 py-1 border rounded-md">8</button>
                        <button class="px-3 py-1 border rounded-md">▶</button>
                    </div>
                </div>
            </div>

            <!-- Balance Card -->
            <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
                <p class="text-sm text-gray-500">Your Balance</p>
                <div class="flex justify-between items-center mt-2">
                    <h3 class="text-2xl font-semibold">$6,650.05</h3>
                    <span class="text-gray-400">💳 **** 9090</span>
                </div>
                <div class="mt-4 flex space-x-4">
                    <button class="w-1/2 bg-green-500 text-white py-2 rounded-lg">Transfer</button>
                    <button class="w-1/2 bg-green-100 text-green-700 py-2 rounded-lg">Request</button>
                </div>
            </div>
        </div>

        <!-- Right Content: Whatsapp QR Info -->
        <div>
            <span
                class="text-xs uppercase tracking-wide font-semibold bg-rose-100 text-rose-700 px-3 py-1 rounded">Automation
                QR</span>
            <h1 class="mt-4 text-4xl font-bold text-gray-900">
                <span class="underline decoration-rose-500">Whatsapp</span> Automation QR
            </h1>
            <p class="mt-4 text-gray-600 text-lg">
                Build strong client relationships with efficient communication and valuable feedback.
            </p>

            <!-- Features List -->
            <ul class="mt-6 space-y-3">
                <li class="flex items-center space-x-3 text-gray-700">
                    ✅ Increase client loyalty
                </li>
                <li class="flex items-center space-x-3 text-gray-700">
                    ✅ Enhance task management
                </li>
                <li class="flex items-center space-x-3 text-gray-700">
                    ✅ Improve client feedback
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

    </section>

    {{-- ordering --}}

    <section  id="ordering" class="max-w-5xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

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

    </section>



    <section class="max-w-full bg-rose-400 mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

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

    </section>


    {{-- footer --}}
    <div class="bg-gray-100">
        <div class="max-w-screen-lg px-4 sm:px-6 text-gray-800 sm:grid md:grid-cols-4 sm:grid-cols-2 mx-auto">
            <div class="p-5">
                <h3 class="font-bold text-xl text-red-600">QR Wale</h3>
                <img src="{{asset('logo.png')}}" alt="">
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-red-600 font-bold">Resources</div>
                <a class="my-3 block" href="/#">Documentation <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Tutorials <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Support <span class="text-teal-600 text-xs p-1">New</span></a>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-red-600 font-bold">Support</div>
                <a class="my-3 block" href="/#">Help Center <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Privacy Policy <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Conditions <span class="text-teal-600 text-xs p-1"></span></a>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-red-600 font-bold">Contact us</div>
                <a class="my-3 block" href="/#">XXX XXXX, Floor 4 San Francisco, CA
                    <span class="text-teal-600 text-xs p-1"></span></a><a class="my-3 block" href="/#">contact@company.com
                    <span class="text-teal-600 text-xs p-1"></span></a>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-100 pt-2">
        <div class="flex pb-5 px-3 m-auto pt-5 border-t text-gray-800 text-sm flex-col
          max-w-screen-lg items-center">
            <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex">
                <a href="/#" class="w-6 mx-1">
                    <svg class="fill-current cursor-pointer text-gray-500 hover:text-red-600" width="100%" height="100%"
                        viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                        style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                        <path id="Twitter" d="M24,12c0,6.627 -5.373,12 -12,12c-6.627,0 -12,-5.373 -12,-12c0,-6.627
                      5.373,-12 12,-12c6.627,0 12,5.373 12,12Zm-6.465,-3.192c-0.379,0.168
                      -0.786,0.281 -1.213,0.333c0.436,-0.262 0.771,-0.676
                      0.929,-1.169c-0.408,0.242 -0.86,0.418 -1.341,0.513c-0.385,-0.411
                      -0.934,-0.667 -1.541,-0.667c-1.167,0 -2.112,0.945 -2.112,2.111c0,0.166
                      0.018,0.327 0.054,0.482c-1.754,-0.088 -3.31,-0.929
                      -4.352,-2.206c-0.181,0.311 -0.286,0.674 -0.286,1.061c0,0.733 0.373,1.379
                      0.94,1.757c-0.346,-0.01 -0.672,-0.106 -0.956,-0.264c-0.001,0.009
                      -0.001,0.018 -0.001,0.027c0,1.023 0.728,1.877 1.694,2.07c-0.177,0.049
                      -0.364,0.075 -0.556,0.075c-0.137,0 -0.269,-0.014 -0.397,-0.038c0.268,0.838
                      1.048,1.449 1.972,1.466c-0.723,0.566 -1.633,0.904 -2.622,0.904c-0.171,0
                      -0.339,-0.01 -0.504,-0.03c0.934,0.599 2.044,0.949 3.237,0.949c3.883,0
                      6.007,-3.217 6.007,-6.008c0,-0.091 -0.002,-0.183 -0.006,-0.273c0.413,-0.298
                      0.771,-0.67 1.054,-1.093Z"></path>
                    </svg>
                </a>
                <a href="/#" class="w-6 mx-1">
                    <svg class="fill-current cursor-pointer text-gray-500 hover:text-red-600" width="100%" height="100%"
                        viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                        style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                        <path id="Facebook" d="M24,12c0,6.627 -5.373,12 -12,12c-6.627,0 -12,-5.373 -12,-12c0,-6.627
                      5.373,-12 12,-12c6.627,0 12,5.373
                      12,12Zm-11.278,0l1.294,0l0.172,-1.617l-1.466,0l0.002,-0.808c0,-0.422
                      0.04,-0.648 0.646,-0.648l0.809,0l0,-1.616l-1.295,0c-1.555,0 -2.103,0.784
                      -2.103,2.102l0,0.97l-0.969,0l0,1.617l0.969,0l0,4.689l1.941,0l0,-4.689Z"></path>
                    </svg>
                </a>
                <a href="/#" class="w-6 mx-1">
                    <svg class="fill-current cursor-pointer text-gray-500 hover:text-red-600" width="100%" height="100%"
                        viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                        style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                        <g id="Layer_1">
                            <circle id="Oval" cx="12" cy="12" r="12"></circle>
                            <path id="Shape" d="M19.05,8.362c0,-0.062 0,-0.125 -0.063,-0.187l0,-0.063c-0.187,-0.562
                         -0.687,-0.937 -1.312,-0.937l0.125,0c0,0 -2.438,-0.375 -5.75,-0.375c-3.25,0
                         -5.75,0.375 -5.75,0.375l0.125,0c-0.625,0 -1.125,0.375
                         -1.313,0.937l0,0.063c0,0.062 0,0.125 -0.062,0.187c-0.063,0.625 -0.25,1.938
                         -0.25,3.438c0,1.5 0.187,2.812 0.25,3.437c0,0.063 0,0.125
                         0.062,0.188l0,0.062c0.188,0.563 0.688,0.938 1.313,0.938l-0.125,0c0,0
                         2.437,0.375 5.75,0.375c3.25,0 5.75,-0.375 5.75,-0.375l-0.125,0c0.625,0
                         1.125,-0.375 1.312,-0.938l0,-0.062c0,-0.063 0,-0.125
                         0.063,-0.188c0.062,-0.625 0.25,-1.937 0.25,-3.437c0,-1.5 -0.125,-2.813
                         -0.25,-3.438Zm-4.634,3.927l-3.201,2.315c-0.068,0.068 -0.137,0.068
                         -0.205,0.068c-0.068,0 -0.136,0 -0.204,-0.068c-0.136,-0.068 -0.204,-0.204
                         -0.204,-0.34l0,-4.631c0,-0.136 0.068,-0.273 0.204,-0.341c0.136,-0.068
                         0.272,-0.068 0.409,0l3.201,2.316c0.068,0.068 0.136,0.204
                         0.136,0.34c0.068,0.136 0,0.273 -0.136,0.341Z" style="fill: rgb(255, 255, 255);"></path>
                        </g>
                    </svg>
                </a>
                <a href="/#" class="w-6 mx-1">
                    <svg class="fill-current cursor-pointer text-gray-500 hover:text-red-600" width="100%" height="100%"
                        viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                        style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                        <path id="Shape" d="M7.3,0.9c1.5,-0.6 3.1,-0.9 4.7,-0.9c1.6,0 3.2,0.3 4.7,0.9c1.5,0.6 2.8,1.5
                      3.8,2.6c1,1.1 1.9,2.3 2.6,3.8c0.7,1.5 0.9,3 0.9,4.7c0,1.7 -0.3,3.2
                      -0.9,4.7c-0.6,1.5 -1.5,2.8 -2.6,3.8c-1.1,1 -2.3,1.9 -3.8,2.6c-1.5,0.7
                      -3.1,0.9 -4.7,0.9c-1.6,0 -3.2,-0.3 -4.7,-0.9c-1.5,-0.6 -2.8,-1.5
                      -3.8,-2.6c-1,-1.1 -1.9,-2.3 -2.6,-3.8c-0.7,-1.5 -0.9,-3.1 -0.9,-4.7c0,-1.6
                      0.3,-3.2 0.9,-4.7c0.6,-1.5 1.5,-2.8 2.6,-3.8c1.1,-1 2.3,-1.9
                      3.8,-2.6Zm-0.3,7.1c0.6,0 1.1,-0.2 1.5,-0.5c0.4,-0.3 0.5,-0.8 0.5,-1.3c0,-0.5
                      -0.2,-0.9 -0.6,-1.2c-0.4,-0.3 -0.8,-0.5 -1.4,-0.5c-0.6,0 -1.1,0.2
                      -1.4,0.5c-0.3,0.3 -0.6,0.7 -0.6,1.2c0,0.5 0.2,0.9 0.5,1.3c0.3,0.4 0.9,0.5
                      1.5,0.5Zm1.5,10l0,-8.5l-3,0l0,8.5l3,0Zm11,0l0,-4.5c0,-1.4 -0.3,-2.5
                      -0.9,-3.3c-0.6,-0.8 -1.5,-1.2 -2.6,-1.2c-0.6,0 -1.1,0.2 -1.5,0.5c-0.4,0.3
                      -0.8,0.8 -0.9,1.3l-0.1,-1.3l-3,0l0.1,2l0,6.5l3,0l0,-4.5c0,-0.6 0.1,-1.1
                      0.4,-1.5c0.3,-0.4 0.6,-0.5 1.1,-0.5c0.5,0 0.9,0.2 1.1,0.5c0.2,0.3 0.4,0.8
                      0.4,1.5l0,4.5l2.9,0Z"></path>
                    </svg>
                </a>
                <a href="/#" class="w-6 mx-1">
                    <svg class="fill-current cursor-pointer text-gray-500 hover:text-red-600" width="100%" height="100%"
                        viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                        style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                        <path id="Combined-Shape" d="M12,24c6.627,0 12,-5.373 12,-12c0,-6.627 -5.373,-12 -12,-12c-6.627,0
                      -12,5.373 -12,12c0,6.627 5.373,12 12,12Zm6.591,-15.556l-0.722,0c-0.189,0
                      -0.681,0.208 -0.681,0.385l0,6.422c0,0.178 0.492,0.323
                      0.681,0.323l0.722,0l0,1.426l-4.675,0l0,-1.426l0.935,0l0,-6.655l-0.163,0l-2.251,8.081l-1.742,0l-2.222,-8.081l-0.168,0l0,6.655l0.935,0l0,1.426l-3.74,0l0,-1.426l0.519,0c0.203,0
                      0.416,-0.145 0.416,-0.323l0,-6.422c0,-0.177 -0.213,-0.385
                      -0.416,-0.385l-0.519,0l0,-1.426l4.847,0l1.583,5.704l0.042,0l1.598,-5.704l5.021,0l0,1.426Z"></path>
                    </svg>
                </a>
            </div>
            <div class="my-5">© Copyright 2025. All Rights Reserved.</div>
        </div>
    </div>
    


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
