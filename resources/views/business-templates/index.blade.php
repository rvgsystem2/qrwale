<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Template Manager</h2>
                <p class="text-sm text-slate-500">Create reusable designs for business QR profiles</p>
            </div>
            <div class="flex gap-2"><a href="{{ route('business.index') }}"
                    class="rounded-xl border bg-white px-4 py-2.5 text-sm font-bold">Businesses</a><a
                    href="{{ route('business-templates.create') }}"
                    class="rounded-xl bg-red-700 px-4 py-2.5 text-sm font-bold text-white">+ Create template</a></div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-5 rounded-xl bg-green-50 p-4 font-semibold text-green-700">{{ session('success') }}</div>
                @endif @if (session('error'))
                    <div class="mb-5 rounded-xl bg-red-50 p-4 font-semibold text-red-700">{{ session('error') }}</div>
                @endif
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($templates as $template)
                        <article class="overflow-hidden rounded-3xl border bg-white shadow-sm">
                            <div class="h-36 p-5"
                                style="background:linear-gradient(135deg,{{ $template->primary_color }},{{ $template->secondary_color }})">
                                <div class="h-full rounded-2xl border border-white/30 bg-white/10 p-4">
                                    <div class="h-10 w-10 rounded-full bg-white"></div>
                                    <div class="mt-3 h-2 w-28 rounded bg-white/80"></div>
                                    <div class="mt-2 h-2 w-40 rounded bg-white/40"></div>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-black">{{ $template->name }}</h3>
                                        <p class="text-sm capitalize text-slate-500">{{ $template->layout }} ·
                                            {{ $template->card_style }}</p>
                                    </div>
                                    @if ($template->is_default)
                                        <span
                                            class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-800">Default</span>
                                    @elseif(!$template->is_active)
                                        <span
                                            class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold">Inactive</span>
                                    @endif
                                </div>
                                <p class="mt-4 text-sm">{{ $template->businesses_count }} businesses use this design</p>
                                <div class="mt-5 grid grid-cols-3 gap-2"><a target="_blank"
                                        href="{{ route('business-templates.preview', $template) }}"
                                        class="rounded-xl border px-3 py-2 text-center text-sm font-bold">Preview</a><a
                                        href="{{ route('business-templates.edit', $template) }}"
                                        class="rounded-xl bg-slate-900 px-3 py-2 text-center text-sm font-bold text-white">Edit</a>
                                    <form method="POST" action="{{ route('business-templates.destroy', $template) }}"
                                        onsubmit="return confirm('Delete this template?')">@csrf
                                        @method('DELETE')<button
                                            class="w-full rounded-xl bg-red-50 px-3 py-2 text-sm font-bold text-red-700">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
        </div>
    </div>
</x-app-layout>
