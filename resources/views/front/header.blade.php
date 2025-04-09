   {{-- NAVBAR --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>

<body class="bg-gray-100">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <nav x-data="navMenu()" class="bg-white border-b border-gray-200 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                
                <!-- Logo -->
                <div class="flex items-center ">
                    <a href="#" class="shrink-0">
                        <img src="{{ asset('asset/img/logo-w.png') }}" alt="Logo" class="w-full h-32 md:h-56 md:p-8 ">
                    </a>
                </div>
    
                <!-- Desktop Navigation -->
                {{-- <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-700 hover:text-rose-600 font-medium transition">Dashboard</a>
                    <a href="#" class="text-gray-700 hover:text-rose-600 font-medium transition">Features</a>
                    <a href="#" class="text-gray-700 hover:text-rose-600 font-medium transition">Pricing</a>
                    <a href="#" class="text-gray-700 hover:text-rose-600 font-medium transition">About</a>
                </div> --}}
    
                <!-- Auth Buttons (Desktop) -->
                {{-- <div class="hidden md:flex space-x-4">
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-rose-600 text-white rounded-lg shadow-md hover:bg-rose-700 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 border border-rose-600 text-rose-600 rounded-lg shadow-md hover:bg-rose-600 hover:text-white transition">
                        Register
                    </a>
                </div>
     --}}@if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4 hidden md:block">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#0a0a00] border-[#ff555535] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 bg-[#CA0300] dark:text-[#fefefe] text-[#1b1b18] border border-black hover:bg-transparent hover:text-black rounded-sm text-sm leading-normal"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#0c0c00] border-[#19140035] hover:bg-[#CA0300] border hover:text-[#fafaf9] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="toggleMenu" class="p-2 text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                :d="open ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Mobile Menu -->
        <div 
            x-show="open"
            x-cloak
            x-transition.opacity.scale.90
            @click.away="closeMenu"
            @keydown.escape.window="closeMenu"
            class="md:hidden bg-white border-t border-gray-200 fixed inset-0 z-50 overflow-y-auto flex flex-col items-center p-6">
            
            <button @click="closeMenu" class="absolute top-4 right-4 p-2  text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
    
            {{-- <div class="py-4 space-y-4 text-center w-full">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Dashboard</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Features</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Pricing</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">About</a>
            </div> --}}
            <div class="py-4 border-t border-gray-200 space-y-2 w-full my-4">
                <a href="{{ route('login') }}" class="block px-4 py-2 bg-rose-600 text-white rounded-md text-center hover:bg-rose-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 border border-rose-600 text-rose-600 rounded-md text-center hover:bg-rose-600 hover:text-white transition">
                    Register
                </a>
            </div>
        </div>
    </nav>
    
    <script>
    function navMenu() {
        return {
            open: false,
            toggleMenu() {
                this.open = !this.open;
                document.body.style.overflow = this.open ? "hidden" : "auto";
            },
            closeMenu() {
                this.open = false;
                document.body.style.overflow = "auto";
            }
        }
    }
    </script> 
   <!-- Navbar -->
   <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
    
</header>
@if (Route::has('login'))
<div class="h-14.5 hidden lg:block"></div>
@endif
</body>
</html>