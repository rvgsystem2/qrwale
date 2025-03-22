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

   <!-- Navbar -->
   <nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-gray-900">
                    <img src="{{ asset('logo.png') }}" alt="" class="h-24 w-24">
                </a>
            </div>

            <!-- Menu Items -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#" class="text-gray-700 hover:text-blue-500 transition">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-500 transition">About</a>
                <a href="#" class="text-gray-700 hover:text-blue-500 transition">Services</a>
                <a href="#" class="text-gray-700 hover:text-blue-500 transition">Contact</a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Services</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact</a>
    </div>
</nav>
  <!-- JavaScript for Mobile Menu -->
  <script>
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    mobileMenuButton.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
</script>
</body>
</html>