<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Business Requests (Approval Panel)
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow">

                @if(session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-50 text-green-700 border border-green-200 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">All Requests</h3>
                        <p class="text-sm text-gray-500">Approve to create business in businesses table</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm border">
                        <thead class="bg-gray-100">
                            <tr class="text-left">
                                <th class="p-3 border">#</th>
                                <th class="p-3 border">Applicant</th>
                                <th class="p-3 border">Business</th>
                                <th class="p-3 border">Custom URL</th>
                                <th class="p-3 border">Details</th>

                                <th class="p-3 border">Status</th>
                                <th class="p-3 border">Created</th>
                                <th class="p-3 border">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($requests as $r)
                            <tr class="border-t">
                                <td class="p-3 border">{{ $r->id }}</td>

                                <td class="p-3 border">
                                    <div class="font-semibold">{{ $r->name ?? '-' }}</div>
                                    <div class="text-gray-600">{{ $r->phone ?? '-' }}</div>
                                    <div class="text-gray-600">{{ $r->email ?? '-' }}</div>
                                </td>

                                <td class="p-3 border">
                                    <div class="font-semibold">{{ $r->bussiness_name ?? '-' }}</div>
                                    <div class="text-gray-600">Mob: {{ $r->mobile_number ?? '-' }}</div>
                                    @if($r->logo_img)
                                        <img src="{{ asset('storage/'.$r->logo_img) }}" class="w-12 h-12 rounded mt-2" alt="">
                                    @endif
                                </td>

                                <td class="p-3 border">
                                    <span class="px-2 py-1 rounded bg-indigo-50 text-indigo-700">
                                        {{ $r->custum_url ?? '-' }}
                                    </span>
                                </td>


                                <td class="p-3 border text-xs leading-5">
    <div class="space-y-1 text-gray-700">
        <div><b>Website:</b> {{ $r->website_url ?? '-' }}</div>
        <div><b>Facebook:</b> {{ $r->fb_url ?? '-' }}</div>
        <div><b>Instagram:</b> {{ $r->insta_url ?? '-' }}</div>
        <div><b>LinkedIn:</b> {{ $r->linkden_url ?? '-' }}</div>
        <div><b>Twitter:</b> {{ $r->twiter_url ?? '-' }}</div>
        <div><b>Review:</b> {{ $r->review_url ?? '-' }}</div>
        <div><b>Address:</b> {{ $r->address ?? '-' }}</div>
        <div><b>Rating:</b> {{ $r->rating ?? '-' }}</div>
    </div>
</td>

                                <td class="p-3 border">
                                    @if($r->status === 'pending')
                                        <span class="px-2 py-1 rounded bg-yellow-50 text-yellow-800">Pending</span>
                                    @elseif($r->status === 'approved')
                                        <span class="px-2 py-1 rounded bg-green-50 text-green-700">Approved</span>
                                    @else
                                        <span class="px-2 py-1 rounded bg-red-50 text-red-700">Rejected</span>
                                    @endif
                                </td>

                                <td class="p-3 border">
                                    {{ $r->created_at?->format('d-m-Y h:i A') }}
                                </td>

                                <td class="p-3 border">
                                    <div class="flex gap-2">
                                        @if($r->status === 'pending')
                                            <form method="POST" action="{{ route('admin.business_requests.approve', $r->id) }}">
                                                @csrf
                                                <button class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">
                                                    Approve
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.business_requests.reject', $r->id) }}">
                                                @csrf
                                                <button class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">
                                                    Reject
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.business_requests.destroy', $r->id) }}"
              onsubmit="return confirm('Are you sure you want to delete this request?');">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 rounded bg-gray-800 text-white hover:bg-black">
                Delete
            </button>
        </form>
                                        @else
                                            <span class="text-gray-500">No action</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">No requests found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
