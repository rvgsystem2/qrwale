<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <a
                        href="{{ route('business.index') }}"
                        class="transition hover:text-red-700"
                    >
                        Businesses
                    </a>

                    <span>/</span>

                    <span>Products</span>
                </div>

                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    {{ $business->bussiness_name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage business products and product images
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a
                    href="{{ route(
                        'business.qr',
                        $business->custum_url ?: $business->id
                    ) }}"
                    target="_blank"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:border-slate-400 hover:bg-slate-50"
                >
                    <span>↗</span>
                    View Profile
                </a>

                <a
                    href="{{ route('business-products.create', $business) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-700 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-red-700/20 transition hover:bg-red-800"
                >
                    <span>＋</span>
                    Add Product
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if(session('success'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800 shadow-sm"
                >
                    <div
                        class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-green-600 font-bold text-white"
                    >
                        ✓
                    </div>

                    <div>
                        <p class="font-bold">Successful</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Error message --}}
            @if(session('error'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm"
                >
                    <div
                        class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-red-600 font-bold text-white"
                    >
                        !
                    </div>

                    <div>
                        <p class="font-bold">Unable to process</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            {{-- Business information --}}
            <section
                class="mb-7 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
            >
                <div class="h-1.5 bg-gradient-to-r from-red-800 via-red-600 to-amber-400"></div>

                <div
                    class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6"
                >
                    <div class="flex min-w-0 items-center gap-4">
                        @if($business->logo_url)
                            <img
                                src="{{ $business->logo_url }}"
                                alt="{{ $business->bussiness_name }}"
                                class="h-16 w-16 shrink-0 rounded-2xl border border-slate-200 bg-white object-contain p-1 shadow-sm"
                            >
                        @else
                            <div
                                class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-red-700 to-slate-950 text-2xl font-black text-white shadow-sm"
                            >
                                {{ Str::upper(
                                    Str::substr($business->bussiness_name, 0, 1)
                                ) }}
                            </div>
                        @endif

                        <div class="min-w-0">
                            <p
                                class="text-xs font-black uppercase tracking-[0.18em] text-red-700"
                            >
                                Product Catalogue
                            </p>

                            <h1 class="truncate text-xl font-black text-slate-900">
                                {{ $business->bussiness_name }}
                            </h1>

                            <p class="mt-1 truncate text-sm text-slate-500">
                                {{ $business->business_category ?: 'Business profile' }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:flex">
                        <div
                            class="rounded-2xl bg-slate-100 px-5 py-3 text-center"
                        >
                            <p class="text-xs font-bold uppercase text-slate-500">
                                Total
                            </p>

                            <p class="mt-1 text-xl font-black text-slate-900">
                                {{ $products->total() }}
                            </p>
                        </div>

                        <div
                            class="rounded-2xl bg-green-50 px-5 py-3 text-center"
                        >
                            <p class="text-xs font-bold uppercase text-green-700">
                                Active
                            </p>

                            <p class="mt-1 text-xl font-black text-green-700">
                                {{ $products->getCollection()
                                    ->where('is_active', true)
                                    ->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Product grid --}}
            @if($products->isNotEmpty())
                <div
                    class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                >
                    @foreach($products as $product)
                        <article
                            class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                        >
                            {{-- Product image --}}
                            <div class="relative aspect-square overflow-hidden bg-slate-100">
                                <img
                                    src="{{ $product->image_url }}"
                                    alt="{{ $product->name }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >

                                <div
                                    class="absolute left-3 top-3 flex flex-col gap-2"
                                >
                                    @if($product->is_active)
                                        <span
                                            class="rounded-full bg-green-600 px-3 py-1 text-xs font-bold text-white shadow-lg"
                                        >
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-slate-700 px-3 py-1 text-xs font-bold text-white shadow-lg"
                                        >
                                            Hidden
                                        </span>
                                    @endif

                                    @if($product->offer_price)
                                        <span
                                            class="rounded-full bg-red-600 px-3 py-1 text-xs font-bold text-white shadow-lg"
                                        >
                                            Offer
                                        </span>
                                    @endif
                                </div>

                                <div
                                    class="absolute right-3 top-3 rounded-full bg-black/70 px-3 py-1 text-xs font-bold text-white backdrop-blur"
                                >
                                    #{{ $product->sort_order }}
                                </div>
                            </div>

                            {{-- Product content --}}
                            <div class="p-5">
                                <h3
                                    class="line-clamp-1 text-lg font-black text-slate-900"
                                    title="{{ $product->name }}"
                                >
                                    {{ $product->name }}
                                </h3>

                                @if($product->description)
                                    <p
                                        class="mt-2 line-clamp-2 min-h-[2.5rem] text-sm leading-5 text-slate-500"
                                    >
                                        {{ $product->description }}
                                    </p>
                                @else
                                    <p class="mt-2 min-h-[2.5rem] text-sm text-slate-400">
                                        No description added
                                    </p>
                                @endif

                                {{-- Price --}}
                                <div
                                    class="mt-4 flex min-h-[2rem] items-center gap-2"
                                >
                                    @if($product->offer_price)
                                        <span class="text-xl font-black text-red-700">
                                            ₹{{ number_format(
                                                (float) $product->offer_price,
                                                2
                                            ) }}
                                        </span>

                                        @if($product->price)
                                            <span
                                                class="text-sm font-semibold text-slate-400 line-through"
                                            >
                                                ₹{{ number_format(
                                                    (float) $product->price,
                                                    2
                                                ) }}
                                            </span>
                                        @endif
                                    @elseif($product->price)
                                        <span class="text-xl font-black text-slate-900">
                                            ₹{{ number_format(
                                                (float) $product->price,
                                                2
                                            ) }}
                                        </span>
                                    @else
                                        <span class="text-sm font-semibold text-slate-400">
                                            Price on request
                                        </span>
                                    @endif
                                </div>

                                {{-- Custom product button --}}
                                @if($product->button_url)
                                    <a
                                        href="{{ $product->button_url }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="mt-4 block truncate rounded-xl bg-blue-50 px-4 py-2.5 text-center text-sm font-bold text-blue-700 transition hover:bg-blue-100"
                                    >
                                        {{ $product->button_text ?: 'Open Product Link' }}
                                    </a>
                                @endif

                                {{-- Actions --}}
                                <div class="mt-5 grid grid-cols-2 gap-2">
                                    <a
                                        href="{{ route(
                                            'business-products.edit',
                                            [$business, $product]
                                        ) }}"
                                        class="rounded-xl bg-amber-50 px-3 py-2.5 text-center text-sm font-bold text-amber-800 transition hover:bg-amber-100"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'business-products.destroy',
                                            [$business, $product]
                                        ) }}"
                                        onsubmit="return confirmProductDelete(
                                            event,
                                            @js($product->name)
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-full rounded-xl bg-red-50 px-3 py-2.5 text-center text-sm font-bold text-red-700 transition hover:bg-red-100"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($products->hasPages())
                    <div
                        class="mt-8 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm"
                    >
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                {{-- Empty state --}}
                <section
                    class="rounded-3xl border-2 border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm"
                >
                    <div
                        class="mx-auto grid h-20 w-20 place-items-center rounded-full bg-red-50 text-4xl"
                    >
                        🛍️
                    </div>

                    <h2 class="mt-5 text-2xl font-black text-slate-900">
                        No products added yet
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Add product images, prices and enquiry buttons. Active
                        products will automatically appear on the public business
                        profile.
                    </p>

                    <a
                        href="{{ route('business-products.create', $business) }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-red-700 px-6 py-3 font-bold text-white shadow-lg shadow-red-700/20 transition hover:bg-red-800"
                    >
                        <span>＋</span>
                        Add First Product
                    </a>
                </section>
            @endif
        </div>
    </div>

    <script>
        function confirmProductDelete(event, productName) {
            return window.confirm(
                `"${productName}" product ko permanently delete karna hai?`
            );
        }
    </script>
</x-app-layout>
