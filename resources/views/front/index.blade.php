<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" />
  <title>QRwale – Free & Custom QR Code Generator for Business, Events & Products</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="Generate stylish, scannable QR codes for business, events, products & more. Free & secure QR code generator with tracking & logo options.">
  <meta name="keywords" content="QR code generator, free QR code, custom QR, business QR code, trackable QR codes, QR with logo, qrwale, qr wale">
  <meta name="author" content="QRwale Team">
  <meta name="robots" content="index, follow">

  <meta property="og:type" content="website">
  <meta property="og:url" content="https://qrwale.com/">
  <meta property="og:title" content="QRwale – Free & Stylish QR Code Generator">
  <meta property="og:description" content="Create free, custom QR codes for your business, product, or event. Add logos, colors, and track performance.">
  <meta property="og:image" content="https://qrwale.com/logo.png">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="https://qrwale.com/">
  <meta name="twitter:title" content="QRwale – Free QR Code Generator with Tracking & Customization">
  <meta name="twitter:description" content="Make your own free QR codes in seconds. Customize with logo, colors, and more. Ideal for business & marketing.">
  <meta name="twitter:image" content="https://qrwale.com/logo.png">
  <link rel="canonical" href="https://qrwale.com/">

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="application/ld+json">
  {"@context":"https://schema.org","@type":"WebSite","name":"QRwale","url":"https://qrwale.com/","description":"Free & custom QR code generator with logo, colors, and tracking for business, events, and more.","publisher":{"@type":"Organization","name":"QRwale"}}
  </script>
</head>
<body class="bg-white text-gray-900">

  <!-- Header -->
  <nav x-data="navMenu()" class="bg-white border-b border-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-24">
        <div class="flex items-center">
          <a href="{{ url('/') }}" class="shrink-0" aria-label="QRwale Home">
            <img src="{{ asset('asset/img/logo-w.png') }}" alt="QRwale Logo" class="h-16 md:h-20 object-contain" />
          </a>
        </div>

        @if (Route::has('login'))
          <div class="hidden md:flex items-center gap-4">
            @auth
              <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 border text-sm rounded-sm hover:bg-gray-50">Dashboard</a>
            @else
              <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 bg-[#CA0300] text-white rounded-sm text-sm hover:opacity-90">Log in</a>
              @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 border rounded-sm text-sm hover:bg-[#CA0300] hover:text-white">Register</a>
              @endif
            @endauth
          </div>
        @endif

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

    <div x-show="open" x-cloak x-transition.opacity.scale.90
         @click.away="closeMenu" @keydown.escape.window="closeMenu"
         class="md:hidden bg-white border-t border-gray-200 fixed inset-0 z-50 overflow-y-auto flex flex-col items-center p-6">

      <button @click="closeMenu" class="absolute top-4 right-4 p-2 text-gray-600" aria-label="Close menu">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <div class="py-4 border-t border-gray-200 space-y-2 w-full my-4">
        <a href="{{ route('login') }}" class="block px-4 py-2 bg-rose-600 text-white rounded-md text-center hover:bg-rose-700 transition">Login</a>
        <a href="{{ route('register') }}" class="block px-4 py-2 border border-rose-600 text-rose-600 rounded-md text-center hover:bg-rose-600 hover:text-white transition">Register</a>
      </div>
    </div>
  </nav>

  <script>
  function navMenu(){return{open:false,toggleMenu(){this.open=!this.open;document.body.style.overflow=this.open?"hidden":"auto"},closeMenu(){this.open=false;document.body.style.overflow="auto"}}}
  </script>
  <!-- Hero Section -->
  <section class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-12">
      <!-- Image -->
      <div class="md:order-2 md:w-1/2">
        <img src="{{ asset('asset/img/hero.gif') }}" alt="QR visual" class="w-full" />
      </div>

      <!-- Text -->
      <div class="md:order-1 md:w-1/2">
        <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight tracking-tight">
          <span class="text-gray-700">QR Wale for</span><br />
          <span id="changing-text" class="text-[#CA0300]">Ordering</span>
        </h1>
        <h2 class="mt-6 text-2xl font-semibold">
          Engage & Grow with <span class="underline decoration-[#CA0300]">QR Wale</span>
        </h2>
        <p class="mt-4 text-gray-600 text-lg leading-relaxed">
          Transform your business with our intelligent QR solutions. Drive more sales, track leads,
          automate tasks, enhance service, boost efficiency, and manage links — all in one platform.
        </p>
        <div class="mt-8">
          <a href="tel:+917753800444"
             class="inline-flex items-center px-6 py-3 rounded-full bg-[#CA0300] text-white font-semibold shadow hover:bg-[#b00200] transition duration-300">
            Connect With Us →
          </a>
        </div>

        <!-- Social Media Links -->
        <div class="flex items-center space-x-4 mt-8 mb-8">
          <a href="mailto:realvictorygroups@gmail.com" class="group p-3 rounded-full bg-white shadow-md hover:bg-[#CA0300] transition" aria-label="Email">
            <svg class="w-6 h-6 text-[#CA0300] group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
          </a>
          <a href="https://www.facebook.com/realvictorygroups/" class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-600 transition" target="_blank" rel="noopener" aria-label="Facebook">
            <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12.07C22 6.49 17.52 2 12 2S2 6.49 2 12.07c0 5.02 3.66 9.18 8.44 9.88v-6.99H7.9v-2.89h2.54V9.79c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.56v1.87h2.76l-.44 2.89h-2.32v6.99C18.34 21.25 22 17.09 22 12.07z"/></svg>
          </a>
          <a href="https://www.instagram.com/realvictorygroups/" class="group p-3 rounded-full bg-white shadow-md hover:bg-pink-500 transition" target="_blank" rel="noopener" aria-label="Instagram">
            <svg class="w-6 h-6 text-pink-500 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"/></svg>
          </a>
          <a href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all" class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-700 transition" target="_blank" rel="noopener" aria-label="LinkedIn">
            <svg class="w-6 h-6 text-blue-700 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 5 2.12 5 3.5zM0 8h5v16H0V8zm7.5 0h4.7v2.2h.07c.66-1.25 2.28-2.57 4.7-2.57C20.2 7.63 22 9.52 22 13.14V24h-5v-9.6c0-2.3-.82-3.87-2.9-3.87-1.58 0-2.52 1.06-2.94 2.08-.15.36-.2.87-.2 1.37V24h-5V8z"/></svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Generator -->
  <div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl overflow-hidden">
      <!-- Header -->
      <div class="bg-gradient-to-r from-red-600 to-gray-700 p-6">
        <h1 class="text-2xl font-bold text-white text-center">QR Code Generator</h1>
        <p class="text-blue-100 mt-1 text-center">Create, preview, and download QR codes in PDF or Image format</p>
      </div>

      <!-- Main Content -->
      <div class="p-6">
        <!-- Input -->
        <div class="mb-8">
          <label for="url-input" class="block text-sm font-medium text-gray-700 mb-2">Enter URL</label>
          <div class="w-full max-w-2xl mx-auto px-0">
            <div class="flex flex-col sm:flex-row gap-2">
              <input type="text" id="url-input" name="url-input" placeholder="https://example.com"
                     class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition w-full">
              <button id="generate-btn"
                      class="px-6 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition w-full sm:w-auto">
                Generate
              </button>
            </div>
          </div>
        </div>

        <!-- Preview -->
        <div id="preview-section" class="hidden mb-8">
          <div class="flex flex-col md:flex-row gap-8">
            <!-- QR -->
            <div class="flex-1">
              <div class="border border-gray-200 rounded-lg p-4 bg-white">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">QR Code Preview</h2>
                <div id="qrcode" class="flex justify-center p-4 bg-white rounded"></div>
                <div class="mt-4 text-center">
                  <p id="qr-content" class="text-sm text-gray-600 break-all"></p>
                </div>
              </div>
            </div>

            <!-- Downloads -->
            <div class="flex-1">
              <div class="border border-gray-200 rounded-lg p-4 bg-white">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Download Options</h2>
                <div class="space-y-4">
                  <button id="download-pdf-btn"
                          class="w-full py-2 px-4 rounded-md text-sm font-medium text-white bg-gray-600 hover:bg-red-600 transition">
                    Download as PDF
                  </button>
                  <button id="download-img-btn"
                          class="w-full py-2 px-4 rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition">
                    Download as Image
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty -->
        <div id="empty-state" class="text-center py-12">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
          </svg>
          <h3 class="mt-4 text-lg font-medium text-gray-900">No QR Code Generated</h3>
          <p class="mt-1 text-sm text-gray-500">Enter a URL and click "Generate" to create your QR code.</p>
        </div>

        <!-- Progress (added; was missing) -->
        <div class="mt-6">
          <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div id="progress-bar" class="h-2.5 bg-[#CA0300] rounded-full" style="width:0%"></div>
          </div>
          <p class="text-xs text-gray-500 mt-2">Processed: <span id="progress-text">0</span></p>
        </div>
      </div>

      <!-- Footer -->
      <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        <p class="text-xs text-gray-500 text-center">
          QR codes can be scanned with any smartphone camera or QR reader app.
        </p>
      </div>
    </div>
  </div>

  {{-- footer --}}
  <footer class="bg-gray-100 py-12 text-gray-800">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
      <!-- Branding -->
      <div>
        <h3 class="text-2xl font-extrabold text-red-600 mb-4">QR Wale</h3>
        <img src="{{ asset('logo.png') }}" alt="QR Wale Logo" class="w-32">
      </div>

      <!-- Connect -->
      <div>
        <h4 class="text-sm font-semibold uppercase text-red-600 mb-4">Connect</h4>
        <ul class="space-y-2 text-base">
          <li><a href="mailto:realvictorygroups@gmail.com" class="hover:text-red-600 transition">Email</a></li>
          <li><a href="https://www.facebook.com/realvictorygroups/" target="_blank" rel="noopener" class="hover:text-red-600 transition">Facebook</a></li>
          <li><a href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all" target="_blank" rel="noopener" class="hover:text-red-600 transition">LinkedIn</a></li>
          <li><a href="https://www.instagram.com/realvictorygroups/" target="_blank" rel="noopener" class="hover:text-red-600 transition">Instagram</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h4 class="text-sm font-semibold uppercase text-red-600 mb-4">Contact Us</h4>
        <ul class="space-y-2 text-base">
          <li>73 Basement, Ekta Enclave Society, Lakhanpur, Khyora, Kanpur, Uttar Pradesh 208024</li>
          <li><a href="mailto:realvictorygroups@gmail.com" class="hover:text-red-600 transition">realvictorygroups@gmail.com</a></li>
          <li><a href="tel:+917753800444" class="hover:text-red-600 transition">+91 77538 00444</a></li>
        </ul>
      </div>

      <!-- Map (pure Tailwind 16:9) -->
      <div>
        <h4 class="text-sm font-semibold uppercase text-red-600 mb-4">Our Location</h4>
        <div class="relative w-full overflow-hidden rounded-lg shadow-md" style="padding-top:56.25%;">
          <iframe
            class="absolute inset-0 w-full h-full border-0"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3570.795247124584!2d80.27712277488058!3d26.494536677937603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c3826d4ebf859%3A0xe9e2ed37cc371552!2sReal%20Victory%20Groups!5e0!3m2!1sen!2sin!4v1743753208287!5m2!1sen!2sin"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>

    <!-- bottom social -->
    <div class="bg-gray-100 pt-2">
      <div class="flex px-3 m-auto border-t text-gray-800 text-sm flex-col max-w-screen-lg items-center">
        <div class="flex items-center space-x-4 mt-8">
          <!-- Email -->
          <a href="mailto:realvictorygroups@gmail.com" class="group p-3 rounded-full bg-white shadow-md hover:bg-[#CA0300] transition duration-300" aria-label="Email">
            <svg class="w-6 h-6 text-[#CA0300] group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
          </a>
          <!-- Facebook -->
          <a href="https://www.facebook.com/realvictorygroups/" class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-600 transition duration-300" target="_blank" rel="noopener" aria-label="Facebook">
            <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12.07C22 6.49 17.52 2 12 2S2 6.49 2 12.07c0 5.02 3.66 9.18 8.44 9.88v-6.99H7.9v-2.89h2.54V9.79c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.56v1.87h2.76l-.44 2.89h-2.32v6.99C18.34 21.25 22 17.09 22 12.07z"/></svg>
          </a>
          <!-- Instagram -->
          <a href="https://www.instagram.com/realvictorygroups/" class="group p-3 rounded-full bg-white shadow-md hover:bg-pink-500 transition duration-300" target="_blank" rel="noopener" aria-label="Instagram">
            <svg class="w-6 h-6 text-pink-500 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"/></svg>
          </a>
          <!-- LinkedIn -->
          <a href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all" class="group p-3 rounded-full bg-white shadow-md hover:bg-blue-700 transition duration-300" target="_blank" rel="noopener" aria-label="LinkedIn">
            <svg class="w-6 h-6 text-blue-700 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 5 2.12 5 3.5zM0 8h5v16H0V8zm7.5 0h4.7v2.2h.07c.66-1.25 2.28-2.57 4.7-2.57C20.2 7.63 22 9.52 22 13.14V24h-5v-9.6c0-2.3-.82-3.87-2.9-3.87-1.58 0-2.52 1.06-2.94 2.08-.15.36-.2.87-.2 1.37V24h-5V8z"/></svg>
          </a>
        </div>
        <div class="my-5">© Real <span class="text-[#CA0300]">Victory</span> Groups 2025. All Rights Reserved.</div>
      </div>
    </div>
  </footer>

  <!-- Page JS -->
  <script>
    // progress demo
    document.addEventListener("DOMContentLoaded", function () {
      const progress = 8000, total = 11024;
      const percentage = (progress / total) * 100;
      document.getElementById("progress-bar").style.width = percentage + "%";
      document.getElementById("progress-text").innerText = progress;
    });

    // Hero changing word
    const words = ["Ordering", "Links", "Reviews", "Feedbacks"];
    let index = 0;
    const changingText = document.getElementById("changing-text");
    setInterval(() => {
      changingText.textContent = words[index];
      index = (index + 1) % words.length;
    }, 2000);

    // QR logic
    const urlInput = document.getElementById('url-input');
    const generateBtn = document.getElementById('generate-btn');
    const previewSection = document.getElementById('preview-section');
    const emptyState = document.getElementById('empty-state');
    const qrcodeContainer = document.getElementById('qrcode');
    const qrContent = document.getElementById('qr-content');
    const downloadPdfBtn = document.getElementById('download-pdf-btn');
    const downloadImgBtn = document.getElementById('download-img-btn');

    let qrCode = null;
    const fixedSize = 300;
    const fixedColor = "#000000";

    generateBtn.addEventListener('click', async function () {
      const text = urlInput.value.trim();

      if (!text) {
        Swal.fire({ icon: 'warning', title: 'URL is required!', text: 'Please enter a valid URL.' });
        return;
      }

      try {
        const response = await fetch('/save-qr', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ url: text })
        });

        if (response.status === 401) {
          Swal.fire({
            icon: 'error',
            title: 'Login Required!',
            text: 'Please login to save your QR code.',
            confirmButtonText: 'Register',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
          }).then((r) => { if (r.isConfirmed) window.location.href = '/register'; });
          return;
        }

        // clear & render
        if (qrCode) { qrCode.clear(); qrcodeContainer.innerHTML = ''; }
        qrCode = new QRCode(qrcodeContainer, {
          text, width: fixedSize, height: fixedSize, colorDark: fixedColor, colorLight: "#ffffff",
          correctLevel: QRCode.CorrectLevel.H
        });

        qrContent.textContent = text;
        previewSection.classList.remove('hidden');
        emptyState.classList.add('hidden');

        Swal.fire({ icon: 'success', title: 'QR Code Generated!', text: 'Your QR code has been saved successfully.', timer: 2000, showConfirmButton: false });
      } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Something went wrong!', text: 'Could not save the QR. Please try again or login.' });
      }
    });

    downloadPdfBtn.addEventListener('click', function () {
      if (!qrCode) { Swal.fire({ icon: 'info', title: 'No QR Code Found!', text: 'Please generate a QR code first.' }); return; }
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      const text = urlInput.value.trim();
      const canvas = qrcodeContainer.querySelector('canvas');
      const imgData = canvas.toDataURL('image/png');

      const pageWidth = doc.internal.pageSize.getWidth();
      const pageHeight = doc.internal.pageSize.getHeight();
      const qrWidth = fixedSize / 2, qrHeight = fixedSize / 2;

      doc.addImage(imgData, 'PNG', (pageWidth - qrWidth) / 2, (pageHeight - qrHeight) / 2 - 20, qrWidth, qrHeight);
      const textLines = doc.splitTextToSize(text, pageWidth - 40);
      doc.setFontSize(10); doc.setTextColor(100);
      doc.text(textLines, pageWidth / 2, (pageHeight - qrHeight) / 2 + qrHeight + 10, { align: 'center' });
      doc.setFontSize(8); doc.setTextColor(200);
      doc.text('Generated with QR Code Generator', pageWidth / 2, pageHeight - 10, { align: 'center' });
      doc.save('qr-code.pdf');
    });

    downloadImgBtn.addEventListener('click', function () {
      if (!qrCode) { Swal.fire({ icon: 'info', title: 'No QR Code Found!', text: 'Please generate a QR code first.' }); return; }
      const canvas = qrcodeContainer.querySelector('canvas');
      const imageData = canvas.toDataURL('image/png');
      const link = document.createElement('a');
      const now = new Date().toISOString().replace(/[:.-]/g, '');
      link.href = imageData; link.download = `qr-code-${now}.png`;
      document.body.appendChild(link); link.click(); document.body.removeChild(link);
      Swal.fire({ icon: 'success', title: 'QR Code Image Downloaded!', text: 'You can now share or print the image.', timer: 2000, showConfirmButton: false });
    });

    urlInput.focus();
  </script>
</body>
</html>
