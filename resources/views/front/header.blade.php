<!-- Header/Nav partial — no <html>, <head>, or extra script tags -->
<nav x-data="navMenu()" class="bg-white border-b border-gray-200 shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-24">
      <!-- Logo -->
      <div class="flex items-center">
        <a href="{{ url('/') }}" class="shrink-0" aria-label="QRwale Home">
          <img src="{{ asset('asset/img/logo-w.png') }}" alt="QRwale Logo" class="h-16 md:h-20 object-contain" />
        </a>
      </div>

      @if (Route::has('login'))
      <div class="flex items-center justify-end gap-4 hidden md:flex">
        @auth
          <a href="{{ url('/dashboard') }}"
             class="inline-block px-5 py-1.5 border text-sm rounded-sm hover:bg-gray-50">
            Dashboard
          </a>
        @else
          <a href="{{ route('login') }}"
             class="inline-block px-5 py-1.5 bg-[#CA0300] text-white rounded-sm text-sm hover:opacity-90">
            Log in
          </a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="inline-block px-5 py-1.5 border rounded-sm text-sm hover:bg-[#CA0300] hover:text-white">
              Register
            </a>
          @endif
        @endauth
      </div>
      @endif

      <!-- Mobile toggle -->
      <div class="md:hidden">
        <button @click="toggleMenu" class="p-2 text-gray-600 focus:outline-none" aria-label="Toggle menu">
          <svg class="h-7 w-7 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  :d="open ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div x-show="open" x-cloak x-transition.opacity.scale.90
       @click.away="closeMenu" @keydown.escape.window="closeMenu"
       class="md:hidden bg-white border-t border-gray-200 fixed inset-0 z-50 overflow-y-auto flex flex-col items-center p-6">

    <button @click="closeMenu" class="absolute top-4 right-4 p-2 text-gray-600" aria-label="Close menu">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

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
    toggleMenu() { this.open = !this.open; document.body.style.overflow = this.open ? "hidden" : "auto"; },
    closeMenu()  { this.open = false; document.body.style.overflow = "auto"; }
  }
}
</script>
