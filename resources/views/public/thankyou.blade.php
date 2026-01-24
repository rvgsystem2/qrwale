<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100 px-4">
    <div class="bg-white max-w-lg w-full rounded-2xl shadow-2xl p-8 text-center">

        <div class="flex justify-center mb-4">
            <div class="bg-green-100 p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-green-600" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            धन्यवाद! 🎉
        </h1>

        <p class="text-gray-600 text-base mb-6">
            आपकी बिज़नेस जानकारी हमें मिल गई है।  
            हमारा एडमिन आपकी डिटेल्स को वेरीफाई करेगा।  
            अप्रूवल के बाद आपका बिज़नेस लाइव कर दिया जाएगा।
        </p>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <p class="text-green-700 text-sm">
                ⏳ आमतौर पर अप्रूवल में 24–48 घंटे लगते हैं।  
                अगर कोई जानकारी चाहिए होगी तो हम आपसे संपर्क करेंगे।
            </p>
        </div>

        <a href="{{ url('/') }}"
           class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
            होम पेज पर जाएँ
        </a>

        <p class="mt-6 text-xs text-gray-500">
            Real Victory Groups – Grow Your Business Digitally 🚀
        </p>
    </div>
</div>
</x-guest-layout>
