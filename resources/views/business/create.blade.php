<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">{{ isset($business) ? 'Edit business' : 'Create business' }}
                </h2>
                <p class="text-sm text-slate-500">Profile details and QR design</p>
            </div><a href="{{ route('business.index') }}" class="rounded-xl border px-4 py-2 text-sm font-bold">Back</a>
        </div>
    </x-slot>
    @php $fields=[['bussiness_name','Business name','text',1],['custum_url','Custom URL','text',0],['tagline','Tagline','text',0],['business_category','Business category','text',0],['contact_person','Contact person','text',0],['mobile_number','Mobile number','tel',0],['alternate_mobile','Alternate mobile','tel',0],['watsapp_url','WhatsApp number','tel',0],['email','Email','email',0],['opening_hours','Opening hours','text',0],['gstin','GSTIN / UIN','text',0],['msme_number','MSME registration no.','text',0],['website_url','Website URL','url',0],['google_map_url','Google Maps URL','url',0],['fb_url','Facebook URL','url',0],['insta_url','Instagram URL','url',0],['linkden_url','LinkedIn URL','url',0],['twiter_url','X / Twitter URL','url',0],['youtube_url','YouTube URL','url',0],['review_url','Review URL','url',0]]; @endphp
    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <form method="POST" enctype="multipart/form-data"
                action="{{ isset($business) ? route('business.update', $business) : route('business.store') }}"
                class="overflow-hidden rounded-3xl bg-white shadow-xl">@csrf
                <div class="bg-gradient-to-r from-red-800 to-slate-950 p-6 text-white">
                    <h1 class="text-2xl font-black">Business profile setup</h1>
                    <p class="mt-1 text-sm text-white/70">Empty optional fields will not appear on the public profile.
                    </p>
                </div>
                <div class="space-y-8 p-5 sm:p-8">
                    @if ($errors->any())
                        <div class="rounded-2xl bg-red-50 p-4 text-sm text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <section>
                        <div class="mb-4 flex items-end justify-between">
                            <div>
                                <p class="text-xs font-black uppercase tracking-widest text-red-700">Step 1</p>
                                <h2 class="text-xl font-black">Choose profile template</h2>
                            </div>
                            @if (auth()->user()->hasRole('Super Admin'))
                                <a href="{{ route('business-templates.index') }}"
                                    class="text-sm font-bold text-red-700">Manage templates →</a>
                            @endif
                        </div>
                        <div class="grid gap-4 md:grid-cols-3">
                            @forelse($templates as $template)
                                <label class="cursor-pointer"><input type="radio" name="business_template_id"
                                        value="{{ $template->id }}" class="peer sr-only"
                                        @checked(
                                            (string) old(
                                                'business_template_id',
                                                $business->business_template_id ?? $templates->firstWhere('is_default', true)?->id) === (string) $template->id)><span
                                        class="block rounded-2xl border-2 p-4 transition peer-checked:border-red-700 peer-checked:bg-red-50"><span
                                            class="mb-3 block h-16 rounded-xl"
                                            style="background:linear-gradient(135deg,{{ $template->primary_color }},{{ $template->secondary_color }})"></span><b
                                            class="block">{{ $template->name }}</b><small
                                            class="capitalize text-slate-500">{{ $template->layout }} ·
                                        {{ $template->card_style }}</small></span></label>@empty<p
                                    class="text-red-600">No active template found. Super Admin must create one.</p>
                            @endforelse
                        </div>
                    </section>
                    <section>
                        <p class="text-xs font-black uppercase tracking-widest text-red-700">Step 2</p>
                        <h2 class="mb-4 text-xl font-black">Business information</h2>
                        <div class="grid gap-4 md:grid-cols-2">
                            @foreach ($fields as [$name, $label, $type, $required])
                                <label><span class="mb-1.5 block text-sm font-bold text-slate-700">{{ $label }}
                                        @if ($required)
                                            <b class="text-red-600">*</b>
                                        @endif
                                    </span>
                                    <input type="{{ $type }}" name="{{ $name }}"
                                        value="{{ old($name, $business->{$name} ?? '') }}" @required($required)
                                        class="w-full rounded-xl border-slate-300 focus:border-red-700 focus:ring-red-700"></label>
                            @endforeach
                            <label class="md:col-span-2"><span class="mb-1.5 block text-sm font-bold">Address</span>
                                <textarea name="address" rows="3"
                                    class="w-full rounded-xl border-slate-300 focus:border-red-700 focus:ring-red-700">{{ old('address', $business->address ?? '') }}</textarea>
                            </label><label class="md:col-span-2"><span class="mb-1.5 block text-sm font-bold">About
                                    business</span>
                                <textarea name="description" rows="4"
                                    class="w-full rounded-xl border-slate-300 focus:border-red-700 focus:ring-red-700">{{ old('description', $business->description ?? '') }}</textarea>
                            </label><label><span class="mb-1.5 block text-sm font-bold">Rating</span><input
                                    type="number" step="0.1" min="0" max="5" name="rating"
                                    value="{{ old('rating', $business->rating ?? '') }}"
                                    class="w-full rounded-xl border-slate-300"></label><label><span
                                    class="mb-1.5 block text-sm font-bold">Business logo</span><input type="file"
                                    accept="image/png,image/jpeg,image/webp" name="logo_img"
                                    class="w-full rounded-xl border p-2">
                                @if (isset($business) && $business->logo_url)
                                    <img src="{{ $business->logo_url }}"
                                        class="mt-3 h-16 w-16 rounded-xl object-cover">
                                @endif
                            </label>
                            @if (auth()->user()->hasRole('Super Admin'))<label><span
                                        class="mb-1.5 block text-sm font-bold">Owner</span><select name="user_id"
                                        class="w-full rounded-xl border-slate-300">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @selected(old('user_id', $business->user_id ?? auth()->id()) == $user->id)>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </label>@endif
                        </div>
                    </section>
                    <button
                        class="w-full rounded-2xl bg-red-700 px-6 py-4 font-black text-white shadow-lg hover:bg-red-800">{{ isset($business) ? 'Update business & QR' : 'Create business & generate QR' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
