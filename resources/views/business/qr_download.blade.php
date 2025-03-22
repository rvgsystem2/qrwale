<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $business->bussiness_name }} - QR Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 shadow-lg rounded-lg text-center">
        
        <!-- Business Name -->
        <h2 class="text-3xl font-bold text-gray-700 mb-4">{{ $business->bussiness_name }}</h2>

        <!-- Display QR Code -->
        <div class="flex justify-center bg-gray-200 p-4 rounded-lg shadow-md">
            {!! $qrCode !!}
        </div>

        <!-- Show QR Code URL -->
        <p class="text-gray-600 mt-4">QR Code URL: 
            <a href="{{ $qrCodeUrl }}" class="text-blue-500 underline" target="_blank">{{ $qrCodeUrl }}</a>
        </p>

        <!-- Buttons -->
        <div class="flex justify-center space-x-4 mt-6">
            <!-- Print QR Code -->
            <button onclick="window.print()" 
                class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition font-semibold">
                Print QR Code
            </button>

            <!-- Download QR Code -->
            <a href="{{ route('business.qr_download', ['identifier' => $business->custom_url ?? $business->id]) }}" 
               class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition font-semibold">
                Download QR Code
            </a>
        </div>

    </div>
</body>
</html>
