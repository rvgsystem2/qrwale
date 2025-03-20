<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('Business QR') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container mx-auto px-4 py-6">
                <div class="bg-white p-6 shadow-lg rounded-lg">
                    
                    <!-- Business Logo -->
                    @if ($business->logo_img)
                        <div class="flex justify-center">
                            <img src="{{ asset('storage/' . $business->logo_img) }}" alt="Business Logo"
                                class="h-24 w-24 rounded-full shadow-md">
                        </div>
                    @endif

                    <!-- Business Details -->
                    <h2 class="text-3xl font-semibold text-gray-700 text-center mt-4">
                        {{ $business->bussiness_name }}
                    </h2>
                    <p class="text-gray-600 text-center mt-2">{{ $business->address }}</p>

                    <!-- Social Media Links -->
                    <div class="flex justify-center space-x-4 mt-4">
                        @if ($business->fb_url)
                            <a href="{{ $business->fb_url }}" target="_blank" class="text-blue-600 text-xl">
                                <i class="fab fa-facebook"></i>
                            </a>
                        @endif
                        @if ($business->insta_url)
                            <a href="{{ $business->insta_url }}" target="_blank" class="text-pink-500 text-xl">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if ($business->twiter_url)
                            <a href="{{ $business->twiter_url }}" target="_blank" class="text-blue-400 text-xl">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if ($business->linkden_url)
                            <a href="{{ $business->linkden_url }}" target="_blank" class="text-blue-700 text-xl">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        @endif
                        @if ($business->watsapp_url)
                            <a href="https://wa.me/{{ $business->watsapp_url }}" target="_blank" class="text-green-500 text-xl">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>

                    <!-- Review Section -->
                    <h3 class="text-lg font-medium mt-6">Leave a Review</h3>
                    
                    <input type="hidden" id="current_rating" value="{{ $business->rating }}">
                    <input type="hidden" id="review_url" value="{{ $business->review_url }}">

                    <form action="{{ route('business.review', $business->id) }}" method="POST" class="space-y-4" id="reviewForm">
                        @csrf

                        <!-- Star Rating System -->
                        <div>
                            <label class="block text-gray-700 font-medium">Your Rating</label>
                            <div class="flex space-x-2 mt-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="checkbox" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden">
                                    <label for="star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 transition duration-300"
                                        onclick="setRating({{ $i }})">
                                        ★
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium">Your Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter your name">
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

                        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            Submit Review
                        </button>
                    </form>
                </div>
            </div>

            <!-- JavaScript for Rating -->
            <script>
                function setRating(selectedRating) {
                    let checkboxes = document.querySelectorAll("input[name='rating']");
                    let currentRating = parseInt(document.getElementById("current_rating").value);
                    let reviewUrl = document.getElementById("review_url").value;
                    
                    // Reset all checkboxes
                    checkboxes.forEach((checkbox, index) => {
                        checkbox.checked = (index < selectedRating);
                    });

                    // Change color of selected stars
                    let stars = document.querySelectorAll("label[for^='star']");
                    stars.forEach((star, index) => {
                        star.style.color = (index < selectedRating) ? "#FFD700" : "#D1D5DB"; // Gold for selected, gray for unselected
                    });

                    // Redirect if selected rating is equal to or higher than stored rating
                    if (selectedRating >= currentRating) {
                        window.location.href = reviewUrl;
                    }
                }
            </script>

        </div>
    </div>
</x-app-layout>
