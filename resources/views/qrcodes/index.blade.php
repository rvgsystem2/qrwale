<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('QR Codes') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">All QR Codes</h1>

            @if ($qrcodes->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($qrcodes as $qr)
                        <div
                            class="bg-white rounded-lg shadow-lg p-5 relative group transition transform hover:-translate-y-1 hover:shadow-xl">
                            <!-- Delete Button -->
                            <button data-id="{{ $qr->id }}"
                                class="absolute top-3 right-3 bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-full text-xs opacity-0 group-hover:opacity-100 transition delete-btn"
                                title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <!-- QR Code -->
                            <div class="flex justify-center mb-4">
                                <div id="qrcode-{{ $qr->id }}" class="bg-white rounded p-2 shadow-md"></div>
                            </div>

                            <!-- URL -->
                            <div class="text-center">
                                <p class="text-sm font-medium text-gray-700">URL</p>
                                <a href="{{ $qr->url }}" target="_blank"
                                    class="text-blue-600 break-all underline text-sm hover:text-blue-800">
                                    {{ $qr->url }}
                                </a>
                            </div>

                            <!-- Meta -->
                            <div class="mt-3 text-xs text-gray-500 text-center">
                                Created on: {{ $qr->created_at->format('d M Y, h:i A') }}
                                @if ($qr->user)
                                    <div>By: <span class="text-gray-700 font-medium">{{ $qr->user->name }}</span></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500">
                    No QR codes found.
                </div>
            @endif
        </div>
    </div>

    {{-- JS Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate QR codes
            @foreach ($qrcodes as $qr)
                new QRCode(document.getElementById("qrcode-{{ $qr->id }}"), {
                    text: "{{ $qr->url }}",
                    width: 150,
                    height: 150,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            @endforeach

            // Delete QR
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const qrId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This QR code will be permanently deleted.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/qrcodes/${qrId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content'),
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(res => {
                                    if (res.status === 403) {
                                        Swal.fire('Permission Denied',
                                            'Only Super Admin can delete QR codes.',
                                            'error');
                                        return;
                                    }
                                    return res.json();
                                })
                                .then(data => {
                                    if (data?.success) {
                                        Swal.fire('Deleted!',
                                            'QR code has been deleted.', 'success');
                                        button.closest('div').remove();
                                    }
                                })
                                .catch(() => {
                                    Swal.fire('Error!', 'Something went wrong.',
                                        'error');
                                });
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
