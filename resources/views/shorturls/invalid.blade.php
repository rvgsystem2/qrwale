

<div class="max-w-xl mx-auto p-6">
  <div class="rounded-2xl border p-5 bg-white">
    <h1 class="text-xl font-bold">This short link has non-URL content</h1>
    <p class="text-sm text-gray-600 mt-1">You can copy the original text below:</p>

    <textarea class="w-full mt-4 p-3 rounded-xl border" rows="4" readonly>{{ $text }}</textarea>

    <button class="mt-3 px-4 py-2 rounded-xl bg-red-600 text-white font-bold"
      onclick="navigator.clipboard.writeText(@js($text))">
      Copy
    </button>
  </div>
</div>

