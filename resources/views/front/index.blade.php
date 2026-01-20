<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" />
  <title>QRwale – Free & Custom QR Code Generator</title>
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

  <style>
    /* myvictory-style background */
    .bg-hero {
      background:
        radial-gradient(1200px 650px at 70% 55%, rgba(16,185,129,.22), transparent 60%),
        radial-gradient(900px 520px at 35% 60%, rgba(59,130,246,.12), transparent 55%),
        radial-gradient(600px 420px at 30% 20%, rgba(99,102,241,.10), transparent 55%),
        linear-gradient(to bottom, #040714 0%, #070a16 40%, #050815 100%);
    }
    .glass {
      background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 18px 45px rgba(0,0,0,.35);
      backdrop-filter: blur(10px);
    }
    .soft-border { border: 1px solid rgba(255,255,255,.10); }
  </style>
</head>

<body class="text-white bg-hero min-h-screen">

  <!-- ================= NAVBAR (myvictory style) ================= -->
  <header x-data="{open:false}" class="sticky top-0 z-50 border-b border-white/10 bg-black/25 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-3">
      <!-- Brand -->
      <a href="/" class="flex items-center gap-3">
        <img src="{{ asset('logo.png') }}" class="h-10 w-10 rounded-xl bg-white p-1" alt="QRwale Logo">
        <div class="leading-tight">
          <div class="font-extrabold tracking-tight">QRwale</div>
          <div class="text-xs text-white/60 -mt-0.5">By Real Victory Groups</div>
        </div>
      </a>

      <!-- Desktop menu -->
      <nav class="hidden lg:flex items-center gap-7 text-sm text-white/80">
        <a href="#features" class="hover:text-white transition">Features</a>
        <a href="#pricing" class="hover:text-white transition">Pricing</a>
        <a href="#how" class="hover:text-white transition">How it works</a>
        <a href="#faq" class="hover:text-white transition">FAQ</a>
        <a href="#contact" class="hover:text-white transition">Contact</a>
      </nav>

      <!-- Actions -->
      <div class="hidden lg:flex items-center gap-3">
        <a href="/login" class="px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
          Login (Admin)
        </a>
        <a href="#generator" class="px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
          Generate QR
        </a>
        <a href="/register" class="px-4 py-2 rounded-xl border border-emerald-400/40 text-emerald-200 bg-emerald-500/10 hover:bg-emerald-500/20 transition text-sm font-semibold">
          Register
        </a>
        <a href="tel:+917753800444" class="px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-400 transition text-sm font-extrabold text-black">
          Book Demo
        </a>
      </div>

      <!-- Mobile button -->
      <button @click="open=!open" class="lg:hidden inline-flex items-center justify-center h-10 w-10 rounded-xl soft-border bg-white/5 hover:bg-white/10">
        <span class="text-lg">☰</span>
      </button>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" x-transition class="lg:hidden border-t border-white/10 bg-black/40">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 space-y-3 text-white/80 text-sm">
        <a href="#features" class="block hover:text-white">Features</a>
        <a href="#pricing" class="block hover:text-white">Pricing</a>
        <a href="#how" class="block hover:text-white">How it works</a>
        <a href="#faq" class="block hover:text-white">FAQ</a>
        <a href="#contact" class="block hover:text-white">Contact</a>
        <div class="pt-3 grid grid-cols-2 gap-3">
          <a href="/login" class="px-4 py-2 rounded-xl soft-border bg-white/5 text-center font-semibold">Login</a>
          <a href="/register" class="px-4 py-2 rounded-xl bg-emerald-500 text-black text-center font-extrabold">Register</a>
          <a href="#generator" class="col-span-2 px-4 py-2 rounded-xl soft-border bg-white/5 text-center font-semibold">Generate QR</a>
        </div>
      </div>
    </div>
  </header>

  <!-- ================= HERO (like myvictory) ================= -->
  <section class="relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

        <!-- LEFT CONTENT -->
        <div class="lg:col-span-6">
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full soft-border bg-white/5 text-xs sm:text-sm text-emerald-100">
            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
            Specially crafted for Business • Events • Products
          </div>

          <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
            Smart QR Generator for<br>
            <span class="text-emerald-300">Modern Businesses</span>
          </h1>

          <p class="mt-5 text-white/75 text-base sm:text-lg leading-relaxed max-w-xl">
            Create QR codes for <span class="text-emerald-200 font-semibold">Links, Ordering, Reviews, Feedback</span>
            and share instantly. Download as PNG/PDF. Clean, fast & mobile responsive.
          </p>

          <div class="mt-8 flex flex-col sm:flex-row gap-3">
            <a href="#generator" class="px-6 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black font-extrabold text-center">
              Get Free Demo
            </a>
            <a href="#features" class="px-6 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition font-semibold text-center">
              View Features →
            </a>
          </div>

          <!-- bullets row (like myvictory) -->
          <div class="mt-8 flex flex-col sm:flex-row gap-4 text-sm text-white/75">
            <div class="flex items-center gap-2">
              <span class="h-9 w-9 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">✓</span>
              <span>No installation — runs in browser</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="h-9 w-9 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">⚡</span>
              <span>Fast generation & downloads</span>
            </div>
          </div>
        </div>

        <!-- RIGHT PREVIEW CARD (Live Preview style) -->
        <div class="lg:col-span-6">
          <div class="glass rounded-3xl p-5 sm:p-6">
            <div class="flex items-start justify-between gap-3">
              <div>
                <div class="text-sm text-white/60">QRwale Live Preview</div>
                <div class="text-xl font-extrabold mt-1">Generate & Download QR</div>
                <div class="text-sm text-white/60 mt-1">Auto preview • PNG/PDF export</div>
              </div>
              <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/15 text-emerald-200 border border-emerald-400/20">
                LIVE PREVIEW
              </span>
            </div>

            <!-- Generator inside card -->
            <div id="generator" class="mt-5 rounded-2xl soft-border bg-black/25 p-4 sm:p-5">
              <label class="text-sm font-semibold text-white/80">Enter URL</label>
              <div class="mt-2 flex flex-col sm:flex-row gap-2">
                <input
                  id="url-input"
                  type="text"
                  placeholder="https://example.com"
                  class="w-full flex-1 px-4 py-3 rounded-2xl bg-black/30 border border-white/10 text-white placeholder:text-white/35 focus:border-emerald-400/40 focus:ring-4 focus:ring-emerald-500/10 transition"
                />
                <button
                  id="generate-btn"
                  class="px-5 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black font-extrabold disabled:opacity-60 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2"
                >
                  <span id="btn-text">Generate</span>
                  <span id="btn-spinner" class="hidden h-4 w-4 rounded-full border-2 border-black/40 border-t-transparent animate-spin"></span>
                </button>
              </div>

              <div class="mt-3 flex flex-wrap gap-2">
                <button id="copy-link-btn" class="hidden px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                  Copy URL
                </button>
                <button id="reset-btn" class="hidden px-4 py-2 rounded-xl soft-border bg-white/5 hover:bg-white/10 transition text-sm font-semibold">
                  Reset
                </button>
              </div>

              <!-- Preview area -->
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
                    <button id="download-pdf-btn" class="w-full py-3 rounded-2xl bg-white/10 hover:bg-white/15 soft-border transition font-bold">
                      Download PDF
                    </button>
                    <button id="download-img-btn" class="w-full py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition font-extrabold text-black">
                      Download PNG
                    </button>
                  </div>

                  <div class="mt-4 text-xs text-white/60">
                    One-click share • Print ready
                  </div>
                </div>
              </div>

              <!-- small footer row like myvictory -->
              <div class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between text-xs text-white/60">
                <div class="flex items-center gap-2">
                  <span class="h-8 w-8 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">⤴</span>
                  One-click QR download
                </div>
                <div class="flex items-center gap-2">
                  <span class="h-8 w-8 rounded-2xl bg-emerald-500/15 border border-emerald-400/20 flex items-center justify-center">☁</span>
                  Secure save on login
                </div>
              </div>
            </div>

            <p class="mt-4 text-sm text-white/60">
              QRwale helps you create QR codes for ordering links, Google reviews, WhatsApp chats, feedback forms and more — all in one place.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ================= FEATURES STRIP ================= -->
  <section id="features" class="border-t border-white/10 bg-black/15">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="glass rounded-3xl p-5">
          <div class="text-2xl">⚡</div>
          <div class="mt-2 font-extrabold">Fast</div>
          <div class="text-sm text-white/60 mt-1">Generate in seconds</div>
        </div>
        <div class="glass rounded-3xl p-5">
          <div class="text-2xl">📱</div>
          <div class="mt-2 font-extrabold">Responsive</div>
          <div class="text-sm text-white/60 mt-1">Perfect on mobile</div>
        </div>
        <div class="glass rounded-3xl p-5">
          <div class="text-2xl">🧾</div>
          <div class="mt-2 font-extrabold">PDF Export</div>
          <div class="text-sm text-white/60 mt-1">Print-ready QR</div>
        </div>
        <div class="glass rounded-3xl p-5">
          <div class="text-2xl">🔒</div>
          <div class="mt-2 font-extrabold">Secure Save</div>
          <div class="text-sm text-white/60 mt-1">Login required to store</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= CONTACT ================= -->
  <section id="contact" class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="glass rounded-3xl p-6 sm:p-8 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
        <div>
          <div class="text-sm text-white/60">Need custom QR solutions?</div>
          <div class="text-2xl font-extrabold mt-1">Real Victory Groups</div>
          <div class="text-sm text-white/70 mt-2">
            73 Basement, Ekta Enclave Society, Lakhanpur, Khyora, Kanpur, Uttar Pradesh 208024
          </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
          <a href="mailto:realvictorygroups@gmail.com" class="px-6 py-3 rounded-2xl soft-border bg-white/5 hover:bg-white/10 transition text-center font-semibold">
            Email Us
          </a>
          <a href="tel:+917753800444" class="px-6 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 transition text-black text-center font-extrabold">
            Call: +91 77538 00444
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer class="border-t border-white/10 py-8 bg-black/25">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-white/60">
      <div>© Real <span class="text-emerald-300 font-semibold">Victory</span> Groups 2025. All Rights Reserved.</div>
      <div class="flex items-center gap-4">
        <a class="hover:text-white" href="https://www.facebook.com/realvictorygroups/" target="_blank" rel="noopener">Facebook</a>
        <a class="hover:text-white" href="https://www.instagram.com/realvictorygroups/" target="_blank" rel="noopener">Instagram</a>
        <a class="hover:text-white" href="https://www.linkedin.com/company/realvictorygroups/posts/?feedView=all" target="_blank" rel="noopener">LinkedIn</a>
      </div>
    </div>
  </footer>

  <!-- ================= JS (QR Logic) ================= -->
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
      } catch (e) { return false; }
    }

    function renderQr(text) {
      if (qrCode) { qrCode.clear(); qrcodeContainer.innerHTML = ''; }

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
        Swal.fire({ icon: 'warning', title: 'URL is required!', text: 'Please enter a valid URL.' });
        return;
      }

      if (!isValidUrl(text)) {
        Swal.fire({ icon: 'warning', title: 'Invalid URL!', text: 'Please enter a URL like https://example.com' });
        return;
      }

      setLoading(true);

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

        renderQr(text);

        Swal.fire({
          icon: 'success',
          title: 'QR Code Generated!',
          text: 'Your QR is ready. (Saved if you are logged in)',
          timer: 1600,
          showConfirmButton: false
        });

      } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Something went wrong!', text: 'Could not save the QR. Please try again.' });
      } finally {
        setLoading(false);
      }
    }

    generateBtn.addEventListener('click', handleGenerate);
    urlInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') { e.preventDefault(); handleGenerate(); }
    });

    copyLinkBtn.addEventListener('click', async () => {
      const text = (urlInput.value || '').trim();
      if (!text) return;
      try {
        await navigator.clipboard.writeText(text);
        Swal.fire({ icon: 'success', title: 'Copied!', text: 'URL copied to clipboard.', timer: 1100, showConfirmButton: false });
      } catch {
        Swal.fire({ icon: 'info', title: 'Copy not supported', text: 'Please copy manually.' });
      }
    });

    resetBtn.addEventListener('click', () => {
      urlInput.value = '';
      urlInput.focus();
      if (qrCode) { qrCode.clear(); qrcodeContainer.innerHTML = ''; qrCode = null; }
      qrContent.textContent = '';
      copyLinkBtn.classList.add('hidden');
      resetBtn.classList.add('hidden');
    });

    downloadPdfBtn.addEventListener('click', () => {
      if (!qrCode) { Swal.fire({ icon: 'info', title: 'No QR Found!', text: 'Please generate first.' }); return; }

      const canvas = qrcodeContainer.querySelector('canvas');
      if (!canvas) { Swal.fire({ icon: 'error', title: 'QR not ready', text: 'Please generate again.' }); return; }

      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      const text = (urlInput.value || '').trim();
      const imgData = canvas.toDataURL('image/png');

      const pageWidth = doc.internal.pageSize.getWidth();
      const pageHeight = doc.internal.pageSize.getHeight();

      const qrW = 90, qrH = 90;
      const x = (pageWidth - qrW) / 2;
      const y = (pageHeight - qrH) / 2 - 18;

      doc.addImage(imgData, 'PNG', x, y, qrW, qrH);

      doc.setFontSize(10);
      doc.setTextColor(80);
      const lines = doc.splitTextToSize(text, pageWidth - 30);
      doc.text(lines, pageWidth / 2, y + qrH + 12, { align: 'center' });

      doc.setFontSize(8);
      doc.setTextColor(160);
      doc.text('Generated with QRwale', pageWidth / 2, pageHeight - 10, { align: 'center' });

      doc.save('qr-code.pdf');
    });

    downloadImgBtn.addEventListener('click', () => {
      if (!qrCode) { Swal.fire({ icon: 'info', title: 'No QR Found!', text: 'Please generate first.' }); return; }

      const canvas = qrcodeContainer.querySelector('canvas');
      if (!canvas) { Swal.fire({ icon: 'error', title: 'QR not ready', text: 'Please generate again.' }); return; }

      const imageData = canvas.toDataURL('image/png');
      const link = document.createElement('a');
      const now = new Date().toISOString().replace(/[:.-]/g, '');
      link.href = imageData;
      link.download = `qr-code-${now}.png`;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);

      Swal.fire({ icon: 'success', title: 'Downloaded!', text: 'QR PNG downloaded.', timer: 1200, showConfirmButton: false });
    });

    // default focus
    urlInput.focus();
  </script>
</body>
</html>
