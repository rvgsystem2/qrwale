<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">
                    {{ $product->exists ? 'Edit Product' : 'Add Product' }}
                </h2>

                <p class="text-sm text-slate-500">
                    {{ $business->bussiness_name }}
                </p>
            </div>

            <a
                href="{{ route('business-products.index', $business) }}"
                class="rounded-xl border px-4 py-2 font-bold"
            >
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6">

            <form
                method="POST"
                enctype="multipart/form-data"
                action="{{ $product->exists
                    ? route('business-products.update', [$business, $product])
                    : route('business-products.store', $business) }}"
                class="rounded-3xl bg-white p-6 shadow-xl sm:p-8"
            >
                @csrf

                @if($product->exists)
                    @method('PUT')
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 p-4 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid gap-5 sm:grid-cols-2">

                    <label class="sm:col-span-2">
                        <span class="mb-1.5 block text-sm font-bold">
                            Product name *
                        </span>

                        <input
                            type="text"
                            name="name"
                            required
                            value="{{ old('name', $product->name) }}"
                            class="w-full rounded-xl border-slate-300"
                        >
                    </label>

                    <label class="sm:col-span-2">
                        <span class="mb-1.5 block text-sm font-bold">
                            Product image {{ $product->exists ? '' : '*' }}
                        </span>

                        <input
                            type="file"
                            name="image"
                            accept="image/png,image/jpeg,image/webp"
                            {{ $product->exists ? '' : 'required' }}
                            class="w-full rounded-xl border p-3"
                        >

                        @if($product->exists && $product->image)
                            <img
                                src="{{ $product->image_url }}"
                                class="mt-4 h-36 w-36 rounded-2xl object-cover"
                                alt="{{ $product->name }}"
                            >
                        @endif
                    </label>

                    <label>
                        <span class="mb-1.5 block text-sm font-bold">
                            Regular price
                        </span>

                        <input
                            type="number"
                            name="price"
                            step="0.01"
                            min="0"
                            value="{{ old('price', $product->price) }}"
                            class="w-full rounded-xl border-slate-300"
                        >
                    </label>

                    <label>
                        <span class="mb-1.5 block text-sm font-bold">
                            Offer price
                        </span>

                        <input
                            type="number"
                            name="offer_price"
                            step="0.01"
                            min="0"
                            value="{{ old('offer_price', $product->offer_price) }}"
                            class="w-full rounded-xl border-slate-300"
                        >
                    </label>

                    <label>
                        <span class="mb-1.5 block text-sm font-bold">
                            Button text
                        </span>

                        <input
                            type="text"
                            name="button_text"
                            value="{{ old('button_text', $product->button_text) }}"
                            placeholder="Enquire Now"
                            class="w-full rounded-xl border-slate-300"
                        >
                    </label>

                    <label>
                        <span class="mb-1.5 block text-sm font-bold">
                            Button URL
                        </span>

                        <input
                            type="url"
                            name="button_url"
                            value="{{ old('button_url', $product->button_url) }}"
                            placeholder="https://..."
                            class="w-full rounded-xl border-slate-300"
                        >
                    </label>

                    <label>
                        <span class="mb-1.5 block text-sm font-bold">
                            Display order
                        </span>

                        <input
                            type="number"
                            name="sort_order"
                            min="0"
                            value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                            class="w-full rounded-xl border-slate-300"
                        >
                    </label>

                    <label class="flex items-center gap-3 pt-7">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old(
                                'is_active',
                                $product->exists ? $product->is_active : true
                            ))
                            class="rounded text-red-700"
                        >

                        <span class="font-bold">Show this product</span>
                    </label>

                    <label class="sm:col-span-2">
                        <span class="mb-1.5 block text-sm font-bold">
                            Description
                        </span>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full rounded-xl border-slate-300"
                        >{{ old('description', $product->description) }}</textarea>
                    </label>
                </div>

                <button
                    class="mt-7 w-full rounded-2xl bg-red-700 px-6 py-4 font-black text-white"
                >
                    {{ $product->exists ? 'Update Product' : 'Upload Product' }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
