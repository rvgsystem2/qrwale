<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business QR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body class="bg-gray-100">
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
                @if(!empty($business->fb_url))
                    <a href="{{ $business->fb_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-2xl"><i class="fab fa-facebook"></i></a>
                @endif
            
                @if(!empty($business->insta_url))
                    <a href="{{ $business->insta_url }}" target="_blank" class="text-pink-500 hover:text-pink-700 text-2xl"><i class="fab fa-instagram"></i></a>
                @endif
            
                @if(!empty($business->twiter_url))
                    <a href="{{ $business->twiter_url }}" target="_blank" class="text-blue-400 hover:text-blue-600 text-2xl"><i class="fab fa-twitter"></i></a>
                @endif
            
                @if(!empty($business->website_url))
                    <a href="{{ $business->website_url }}" target="_blank" class="text-blue-400 hover:text-blue-700 text-2xl"><i class="fas fa-globe"></i></a>
                @endif
            
                @if(!empty($business->linkden_url))
                    <a href="{{ $business->linkden_url }}" target="_blank" class="text-blue-500 hover:text-blue-700 text-2xl"><i class="fab fa-linkedin"></i></a>
                @endif
            
                @if(!empty($business->watsapp_url))
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
</body>
</html>
