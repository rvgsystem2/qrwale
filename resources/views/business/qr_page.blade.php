<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="p-1 bg-gradient-to-r from-red-500 to-black rounded-lg">
            <div class="bg-white  p-6 shadow-lg shadow-slate-700 rounded-lg">

                <!-- Business Logo -->
                <div class="flex justify-center">
                    <div class="relative w-36 h-36 rounded-full p-2 bg-gradient-to-r from-red-500 to-black">
                        <img src="{{ asset('storage/' . $business->logo_img) }}" alt="Business Logo"
                            class="h-32 w-32 rounded-full bg-white p-1 shadow-lg transition duration-300 transform hover:scale-105">
                    </div>
                </div>


                <!-- Business Details -->
                <h2 class="text-3xl font-semibold text-gray-700 text-center mt-4">
                    {{ $business->business_name }}
                </h2>
                <p class="text-gray-600 text-center mt-2">{{ $business->address }}</p>



                <div class="flex justify-center space-x-4 mt-4">
                    @if (!empty($business->fb_url))
                        <a href="{{ $business->fb_url }}" target="_blank"
                            class="text-blue-600 hover:text-blue-800 text-2xl transition-transform duration-300 ease-in-out transform hover:scale-110"
                            onclick="trackClick({{ $business->id }}, 'fb_url')">
                            <i class="fab fa-facebook"></i>
                        </a>
                    @endif

                    @if (!empty($business->insta_url))
                        <a href="{{ $business->insta_url }}" target="_blank"
                            class="text-pink-500 hover:text-pink-700 text-2xl transition-transform duration-300 ease-in-out transform hover:scale-110"
                            onclick="trackClick({{ $business->id }}, 'insta_url')">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if (!empty($business->website_url))
                        <a href="{{ $business->website_url }}" target="_blank"
                            class="text-blue-400 hover:text-blue-700 text-2xl transition-transform duration-300 ease-in-out transform hover:scale-110"
                            onclick="trackClick({{ $business->id }}, 'website_url')">
                            <i class="fas fa-globe"></i>
                        </a>
                    @endif

                    @if (!empty($business->linkden_url))
                        <a href="{{ $business->linkden_url }}" target="_blank"
                            class="text-blue-500 hover:text-blue-700 text-2xl transition-transform duration-300 ease-in-out transform hover:scale-110"
                            onclick="trackClick({{ $business->id }}, 'linkden_url')">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    @endif

                    @if (!empty($business->twiter_url))
                        <a href="{{ $business->twiter_url }}" target="_blank"
                            class="text-blue-400 hover:text-blue-600 text-2xl transition-transform duration-300 ease-in-out transform hover:scale-110"
                            onclick="trackClick({{ $business->id }}, 'twiter_url')">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif

                    @if (!empty($business->watsapp_url))
                        <a href="https://wa.me/+91{{ $business->watsapp_url }}" target="_blank"
                            class="text-green-500 hover:text-green-700 text-2xl transition-transform duration-300 ease-in-out transform hover:scale-110"
                            onclick="trackClick({{ $business->id }}, 'watsapp_url')">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                </div>


                <!-- Review Section -->
                <h3 class="text-xl font-semibold text-gray-700 mt-6">Leave a Review</h3>
                <input type="hidden" id="current_rating" value="{{ $business->rating }}">
                <input type="hidden" id="review_url" value="{{ $business->review_url }}">
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                <script>
                    Swal.fire({
                        title: "Success!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonText: "OK",
                        timer: 5000, // 5 seconds (5000 milliseconds)
                        timerProgressBar: true
                    });
                </script>
            @endif
            

                <form action="{{ route('business.review', $business->id) }}" method="POST" class="space-y-4"
                    id="reviewForm">
                    @csrf

                    <!-- Star Rating System -->
                    <div>
                        <label class="block text-gray-700 font-medium">Your Rating</label>
                        <div class="flex justify-center space-x-2 mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="rating"
                                    value="{{ $i }}" class="hidden ">
                                <label for="star{{ $i }}"
                                    class="cursor-pointer text-3xl text-gray-300 transition duration-300"
                                    onclick="setRating({{ $i }})">★</label>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Your Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2 border shadow-md rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="enter your name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Your Number</label>
                        <input type="text" name="number" value="{{ old('number') }}" required pattern="\d{10}"
                            class="w-full px-4 py-2 border shadow-md rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="enter your number">
                        @error('number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">Your Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border shadow-md rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="enter your email">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Review Box -->
                    <div id="reviewBox">
                        <label class="block text-gray-700 font-medium">Your Review</label>
                        <textarea name="review" class="w-full px-4 py-2 border shadow-md rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="Write your review"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full px-6 py-2 text-white rounded-lg bg-gradient-to-r from-black to-red-500 transition-all duration-300 transform hover:scale-105 hover:from-red-700 hover:to-black">
                        Submit Review
                    </button>


                    <div class="flex justify-center py-2">
                        <span class="font-bold">Powered by: <strong class="text-red-500"> <a href="https://realvictorygroups.com/">Real Victory
                            Groups</a> </strong></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setRating(selectedRating) {
            let checkboxes = document.querySelectorAll("input[name='rating']");
            let stars = document.querySelectorAll("label[for^='star']");
            let currentRating = parseInt(document.getElementById("current_rating").value);
            let reviewUrl = document.getElementById("review_url").value;

            checkboxes.forEach((checkbox) => {
                checkbox.checked = (checkbox.value == selectedRating);
            });

            stars.forEach((star, index) => {
                star.style.color = (index < selectedRating) ? "#FFD700" : "#D1D5DB";
            });

            // Prevent redirect unless a valid rating is selected
            if (selectedRating >= 1 && selectedRating >= currentRating) {
                setTimeout(() => {
                    window.location.href = reviewUrl;
                }, 500);
            }
        }
    </script>


    <script>
        function trackClick(businessId, platform) {
            fetch(`/business/${businessId}/track-click`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        platform: platform
                    })
                })
                .then(response => response.json())
                .then(data => console.log(`Updated clicks for ${platform}:`, data.clicks))
                .catch(error => console.error('Error tracking click:', error));
        }
    </script>

</body>






{{-- <body class="bg-gray-100">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white p-6 shadow-lg rounded-lg">
            
            <!-- Business Logo -->
            <div class="flex justify-center">
                <div class="relative">
                    <img src="{{ asset('storage/' . $business->logo_img) }}" alt="Business Logo"
                        class="h-32 w-32 rounded-full border-4 border-blue-500 p-2 bg-white shadow-lg transition duration-300 transform hover:scale-105">          
                </div>
            </div>
            

            <!-- Business Details -->
            <h2 class="text-3xl font-semibold text-gray-700 text-center mt-4">
                {{ $business->bussiness_name }}
            </h2>
            <p class="text-gray-600 text-center mt-2">{{ $business->address }}</p>

            <!-- Social Media Links -->
            <div class="flex justify-center space-x-4 mt-4 ">
                @if (!empty($business->fb_url))
                    <a href="{{ $business->fb_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-2xl"><i class="fab fa-facebook"></i></a>
                @endif
            
                @if (!empty($business->insta_url))
                    <a href="{{ $business->insta_url }}" target="_blank" class="text-pink-500 hover:text-pink-700 text-2xl"><i class="fab fa-instagram"></i></a>
                @endif
            
                @if (!empty($business->twiter_url))
                    <a href="{{ $business->twiter_url }}" target="_blank" class="text-blue-400 hover:text-blue-600 text-2xl"><i class="fab fa-twitter"></i></a>
                @endif
            
                @if (!empty($business->website_url))
                    <a href="{{ $business->website_url }}" target="_blank" class="text-blue-400 hover:text-blue-700 text-2xl"><i class="fas fa-globe"></i></a>
                @endif
            
                @if (!empty($business->linkden_url))
                    <a href="{{ $business->linkden_url }}" target="_blank" class="text-blue-500 hover:text-blue-700 text-2xl"><i class="fab fa-linkedin"></i></a>
                @endif
            
                @if (!empty($business->watsapp_url))
                    <a href="https://wa.me/{{ $business->watsapp_url }}" target="_blank" class="text-green-500 hover:text-green-700 text-2xl"><i class="fab fa-whatsapp"></i></a>
                @endif
            </div>
            

            <!-- Review Section -->
            <h3 class=" text-xl font-semibold text-gray-700 mt-6">Leave a Review</h3>
            <input type="hidden" id="current_rating" value="{{ $business->rating }}">
            <input type="hidden" id="review_url" value="{{ $business->review_url }}">

            <form action="{{ route('business.review', $business->id) }}" method="POST" class="space-y-4" id="reviewForm">
                @csrf

                <!-- Star Rating System -->
                <div>
                    <label class="block text-gray-700 font-medium">Your Rating</label>
                    <div class="flex justify-center space-x-2 mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="checkbox" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden">
                            <label for="star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 transition duration-300"
                                onclick="setRating({{ $i }})">★</label>
                        @endfor
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Your Name</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 " placeholder="Enter your name">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Your Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter your email">
                </div>

                <!-- Review Box -->
                <div id="reviewBox">
                    <label class="block text-gray-700 font-medium">Your Review</label>
                    <textarea name="review" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Write your review"></textarea>
                </div>

                <button type="submit" class="w-full px-6 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition">
                    Submit Review
                </button>
                <div class="flex justify-center py-2">
                    <span>Powered by: <strong>Real Victory Groups</strong></span>
                </div>
            </form>
        </div>
    </div>

    <script>
        function setRating(selectedRating) {
            let checkboxes = document.querySelectorAll("input[name='rating']");
            let currentRating = parseInt(document.getElementById("current_rating").value);
            let reviewUrl = document.getElementById("review_url").value;
            
            checkboxes.forEach((checkbox, index) => {
                checkbox.checked = (index < selectedRating);
            });

            let stars = document.querySelectorAll("label[for^='star']");
            stars.forEach((star, index) => {
                star.style.color = (index < selectedRating) ? "#FFD700" : "#D1D5DB";
            });

            if (selectedRating >= currentRating) {
                window.location.href = reviewUrl;
            }
        }
    </script>
</body> --}}

</html>
