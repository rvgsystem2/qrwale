<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Businesses</h2>
                <p class="text-sm text-slate-500">Manage profiles, templates and logo QR codes</p>
            </div>
            <div class="flex flex-wrap gap-2">

                @if (auth()->user()->hasRole('Super Admin'))
                    <a href="{{ route('business-templates.index') }}"
                        class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold">Templates</a>
                @endif @can('create business')
                <a href="{{ route('business.create') }}"
                    class="rounded-xl bg-red-700 px-4 py-2.5 text-sm font-bold text-white">+ New business</a>
            @endcan
        </div>
    </div>
</x-slot>
<div class="py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @foreach (['success' => 'green', 'error' => 'red'] as $key => $color)
            @if (session($key))
                <div
                    class="mb-5 rounded-xl bg-{{ $color }}-50 p-4 font-semibold text-{{ $color }}-700">
                    {{ session($key) }}</div>
            @endif
        @endforeach
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse($businesses as $business)
                <article
                    class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="h-2" style="background:{{ $business->template?->primary_color ?? '#991b1b' }}">
                    </div>
                    <div class="p-5">
                        <div class="flex items-start gap-4"><img
                                src="{{ $business->logo_url ?: 'https://ui-avatars.com/api/?name=' . urlencode($business->bussiness_name) }}"
                                class="h-16 w-16 rounded-2xl border object-cover">
                            <div class="min-w-0 flex-1">
                                <h3 class="truncate text-lg font-black">{{ $business->bussiness_name }}</h3>
                                <p class="truncate text-sm text-slate-500">
                                    {{ $business->template?->name ?? 'Default template' }}</p>
                                <p class="mt-1 text-xs text-slate-400">{{ $business->user?->name }}</p>
                            </div><span
                                class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700">{{ $business->qr_scan_count ?? 0 }}
                                scans</span>
                        </div>
                        <div class="mt-5 grid grid-cols-2 gap-3 rounded-2xl bg-slate-50 p-4 text-sm">
                            <div>
                                <p class="text-xs text-slate-400">Mobile</p>
                                <b>{{ $business->mobile_number ?: '—' }}</b>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Clicks</p>
                                <b>{{ array_sum($business->social_clicks ?? []) }}</b>
                            </div>
                        </div>
                        <div class="mt-5 rounded-2xl border bg-white p-4"><img
                                src="{{ route('business.qr.image', $business) }}" class="mx-auto h-40 w-40"
                                alt="QR"></div>
                        <div class="mt-4 grid grid-cols-2 gap-2"><a target="_blank"
                                href="{{ route('business.qr', $business->custum_url ?: $business->id) }}"
                                class="rounded-xl border px-3 py-2.5 text-center text-sm font-bold">Open
                                profile</a><a href="{{ route('business.qr.download', $business) }}"
                                class="rounded-xl bg-slate-900 px-3 py-2.5 text-center text-sm font-bold text-white">Download
                                QR</a>

                                <a
    href="{{ route('business-products.index', $business) }}"
    class="rounded-xl bg-blue-50 px-3 py-2.5 text-center text-sm font-bold text-blue-700"
>
    Manage Products
</a>
                            @can('edit business')
                                <a href="{{ route('business.edit', $business) }}"
                                    class="rounded-xl bg-amber-50 px-3 py-2.5 text-center text-sm font-bold text-amber-800">Edit</a>
                                @endcan @can('delete business')
                                <form method="POST" action="{{ route('business.delete', $business) }}"
                                    onsubmit="return confirm('Delete this business permanently?')">@csrf
                                    @method('DELETE')<button
                                        class="w-full rounded-xl bg-red-50 px-3 py-2.5 text-sm font-bold text-red-700">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
            </article>@empty<div
                    class="col-span-full rounded-3xl border-2 border-dashed bg-white p-12 text-center">
                    <h3 class="text-xl font-black">No business found</h3>
                    <p class="mt-2 text-slate-500">Create your first dynamic business QR profile.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
</x-app-layout>
