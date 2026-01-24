<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-10 px-4">
<div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-6 md:p-10">

<h2 class="text-3xl font-bold text-center text-indigo-700 mb-2">
    बिज़नेस रजिस्ट्रेशन फॉर्म
</h2>
<p class="text-center text-gray-600 mb-8">
    अपनी दुकान / कंपनी की जानकारी भरें। एडमिन अप्रूवल के बाद आपका बिज़नेस लाइव हो जाएगा।
</p>

@if(session('success'))
<div class="mb-4 p-3 rounded bg-green-100 text-green-700 border border-green-300">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300">
    <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ url('/apply-business') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
@csrf

{{-- Applicant --}}
<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="font-semibold">आपका नाम</label>
        <input type="text" name="name" placeholder="जैसे: Ravi Kumar"
            class="input">
        <p class="hint">आपका नाम, जिससे हम आपसे संपर्क कर सकें</p>
    </div>

    <div>
        <label class="font-semibold">मोबाइल नंबर</label>
        <input type="text" name="phone" placeholder="जैसे: 9876543210"
            class="input">
        <p class="hint">आपका पर्सनल संपर्क नंबर</p>
    </div>
</div>

<div>
    <label class="font-semibold">ईमेल</label>
    <input type="email" name="email" placeholder="जैसे: myshop@gmail.com" class="input">
    <p class="hint">एडमिन आपसे इस ईमेल पर संपर्क करेगा</p>
</div>

<hr>

<div>
    <label class="font-semibold">कस्टम URL</label>
    <input type="text" name="custum_url" placeholder="जैसे: ravi-store" class="input">
    <p class="hint">आपकी वेबसाइट का यूनिक नाम (admin verify करेगा)</p>
</div>

<div>
    <label class="font-semibold">बिज़नेस का नाम *</label>
    <input type="text" name="bussiness_name" placeholder="जैसे: Ravi Electronics" required class="input">
    <p class="hint">दुकान या कंपनी का पूरा नाम</p>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label>बिज़नेस मोबाइल</label>
        <input type="text" name="mobile_number" placeholder="जैसे: 9123456789" class="input">
        <p class="hint">ग्राहकों के लिए संपर्क नंबर</p>
    </div>

    <div>
        <label>व्हाट्सएप नंबर</label>
        <input type="text" name="watsapp_url" placeholder="जैसे: 9123456789" class="input">
        <p class="hint">जिस नंबर पर ग्राहक व्हाट्सएप कर सकें</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label>वेबसाइट लिंक</label>
        <input type="url" name="website_url" placeholder="https://myshop.com" class="input">
        <p class="hint">अगर आपकी वेबसाइट है तो</p>
    </div>
    <div>
        <label>रिव्यू लिंक</label>
        <input type="url" name="review_url" placeholder="Google review link" class="input">
        <p class="hint">Google / JustDial review page link</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label>Facebook</label>
        <input type="url" name="fb_url" placeholder="https://facebook.com/yourpage" class="input">
    </div>
    <div>
        <label>Instagram</label>
        <input type="url" name="insta_url" placeholder="https://instagram.com/yourpage" class="input">
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label>LinkedIn</label>
        <input type="url" name="linkden_url" placeholder="LinkedIn profile/page" class="input">
    </div>
    <div>
        <label>Twitter</label>
        <input type="url" name="twiter_url" placeholder="Twitter profile" class="input">
    </div>
</div>

<div>
    <label>पूरा पता</label>
    <textarea name="address" rows="3" class="input" placeholder="दुकान का पूरा पता लिखें"></textarea>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label>रेटिंग (0 से 5)</label>
        <input type="number" name="rating" min="0" max="5" class="input" placeholder="जैसे: 4.5">
    </div>

    <div>
        <label>लोगो अपलोड</label>
        <input type="file" name="logo_img" class="input">
        <p class="hint">आपकी दुकान का लोगो (JPG/PNG)</p>
    </div>
</div>

<button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
    सबमिट करें
</button>

</form>
</div>
</div>
</x-guest-layout>

<style>
.input{
    width:100%;
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
}
.input:focus{outline:none;border-color:#6366f1;box-shadow:0 0 0 2px #c7d2fe;}
.hint{font-size:12px;color:#6b7280;}
</style>
