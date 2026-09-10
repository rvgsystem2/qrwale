<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.2em] text-red-700">
                    Template Manager
                </p>

                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    {{ $businessTemplate->exists
                        ? 'Edit Template'
                        : 'Create Template' }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Create a reusable business profile design.
                </p>
            </div>

            <a
                href="{{ route('business-templates.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:border-slate-400 hover:bg-slate-50"
            >
                <span>←</span>
                Back to Templates
            </a>
        </div>
    </x-slot>

    <div
        class="min-h-screen bg-slate-50 py-8"
        x-data="templateDesigner()"
    >
        <div
            class="mx-auto grid max-w-7xl gap-7 px-4 sm:px-6 lg:grid-cols-[1fr_.85fr] lg:px-8"
        >
            {{-- Template form --}}
            <form
                method="POST"
                action="{{ $businessTemplate->exists
                    ? route('business-templates.update', $businessTemplate)
                    : route('business-templates.store') }}"
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl"
            >
                @csrf

                @if($businessTemplate->exists)
                    @method('PUT')
                @endif

                {{-- Form header --}}
                <div
                    class="bg-gradient-to-r from-red-800 via-red-700 to-slate-950 px-5 py-6 text-white sm:px-8"
                >
                    <h1 class="text-2xl font-black">
                        Template Settings
                    </h1>

                    <p class="mt-1 text-sm leading-6 text-white/70">
                        Select an optional HTML design or create a dynamic
                        design using layouts and colors.
                    </p>
                </div>

                <div class="space-y-8 p-5 sm:p-8">

                    {{-- Success message --}}
                    @if(session('success'))
                        <div
                            class="flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800"
                        >
                            <div
                                class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-green-600 font-black text-white"
                            >
                                ✓
                            </div>

                            <div>
                                <p class="font-black">
                                    Successful
                                </p>

                                <p class="text-sm">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Validation errors --}}
                    @if($errors->any())
                        <div
                            class="rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800"
                        >
                            <div class="flex items-start gap-3">
                                <div
                                    class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-red-600 font-black text-white"
                                >
                                    !
                                </div>

                                <div>
                                    <p class="font-black">
                                        Please correct these errors
                                    </p>

                                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- HTML design selection --}}
                    <section>
                        <div class="mb-4">
                            <p
                                class="text-xs font-black uppercase tracking-[0.18em] text-red-700"
                            >
                                Step 1
                            </p>

                            <h2 class="mt-1 text-xl font-black text-slate-900">
                                Choose HTML Design
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                HTML design is optional. Without it, the
                                dynamic custom design will be used.
                            </p>
                        </div>

                        <div
                            class="rounded-2xl border border-blue-100 bg-blue-50/60 p-5"
                        >
                            <div class="flex items-start gap-3">
                                <div
                                    class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-blue-600 text-xs font-black text-white shadow-sm"
                                >
                                    HTML
                                </div>

                                <div class="min-w-0 flex-1">
                                    <label
                                        for="view_key"
                                        class="block text-sm font-black text-slate-800"
                                    >
                                        HTML Design

                                        <span class="font-medium text-slate-400">
                                            (Optional)
                                        </span>
                                    </label>

                                    <select
                                        id="view_key"
                                        name="view_key"
                                        x-model="viewKey"
                                        class="mt-2 w-full rounded-xl border-slate-300 bg-white focus:border-red-700 focus:ring-red-700"
                                    >
                                        <option value="">
                                            Dynamic Custom Design
                                        </option>

                                        @foreach(config('business_templates.views', []) as $key => $design)
                                            <option
                                                value="{{ $key }}"
                                                @selected(
                                                    (string) old(
                                                        'view_key',
                                                        $businessTemplate->view_key ?? ''
                                                    ) === (string) $key
                                                )
                                            >
                                                {{ $design['name'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div
                                        class="mt-3 rounded-xl border border-blue-100 bg-white p-3 text-xs leading-5 text-slate-600"
                                    >
                                        <template x-if="!viewKey">
                                            <div class="flex items-start gap-2">
                                                <span
                                                    class="mt-0.5 grid h-5 w-5 shrink-0 place-items-center rounded-full bg-green-100 font-black text-green-700"
                                                >
                                                    ✓
                                                </span>

                                                <p>
                                                    <strong class="text-slate-800">
                                                        Dynamic Custom Design:
                                                    </strong>

                                                    Layout, card style and colors
                                                    selected below will generate
                                                    the complete business profile.
                                                </p>
                                            </div>
                                        </template>

                                        <template x-if="viewKey">
                                            <div class="flex items-start gap-2">
                                                <span
                                                    class="mt-0.5 grid h-5 w-5 shrink-0 place-items-center rounded-full bg-blue-100 font-black text-blue-700"
                                                >
                                                    ✓
                                                </span>

                                                <p>
                                                    <strong class="text-slate-800">
                                                        Selected HTML Design:
                                                    </strong>

                                                    <span
                                                        x-text="selectedDesignName()"
                                                    ></span>

                                                    will be used. Selected colors
                                                    will also be passed to this
                                                    HTML template.
                                                </p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Basic information --}}
                    <section>
                        <div class="mb-4">
                            <p
                                class="text-xs font-black uppercase tracking-[0.18em] text-red-700"
                            >
                                Step 2
                            </p>

                            <h2 class="mt-1 text-xl font-black text-slate-900">
                                Template Information
                            </h2>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            {{-- Template name --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Template Name
                                    <b class="text-red-600">*</b>
                                </span>

                                <input
                                    type="text"
                                    name="name"
                                    x-model="name"
                                    value="{{ old(
                                        'name',
                                        $businessTemplate->name ?? ''
                                    ) }}"
                                    required
                                    maxlength="100"
                                    placeholder="Example: Premium Solar"
                                    class="w-full rounded-xl border-slate-300 focus:border-red-700 focus:ring-red-700"
                                >

                                @error('name')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>

                            {{-- Slug --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Template Slug
                                    <b class="text-red-600">*</b>
                                </span>

                                <input
                                    type="text"
                                    name="slug"
                                    value="{{ old(
                                        'slug',
                                        $businessTemplate->slug ?? ''
                                    ) }}"
                                    required
                                    maxlength="100"
                                    pattern="[a-z0-9-]+"
                                    placeholder="premium-solar"
                                    class="w-full rounded-xl border-slate-300 focus:border-red-700 focus:ring-red-700"
                                >

                                <p class="mt-1 text-xs text-slate-400">
                                    Use lowercase letters, numbers and hyphens.
                                </p>

                                @error('slug')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>
                        </div>
                    </section>

                    {{-- Layout settings --}}
                    <section>
                        <div class="mb-4">
                            <p
                                class="text-xs font-black uppercase tracking-[0.18em] text-red-700"
                            >
                                Step 3
                            </p>

                            <h2 class="mt-1 text-xl font-black text-slate-900">
                                Layout & Card Style
                            </h2>

                            <p
                                x-show="viewKey"
                                x-cloak
                                class="mt-1 text-xs font-semibold text-amber-700"
                            >
                                These options mainly control Dynamic Custom
                                Design. HTML templates may use their own layout.
                            </p>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            {{-- Layout --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Page Layout
                                </span>

                                <select
                                    name="layout"
                                    x-model="layout"
                                    class="w-full rounded-xl border-slate-300 bg-white focus:border-red-700 focus:ring-red-700"
                                >
                                    @foreach([
                                        'split' => 'Split Desktop',
                                        'centered' => 'Centered Profile',
                                        'banner' => 'Wide Banner',
                                    ] as $value => $label)
                                        <option
                                            value="{{ $value }}"
                                            @selected(
                                                old(
                                                    'layout',
                                                    $businessTemplate->layout
                                                        ?: 'split'
                                                ) === $value
                                            )
                                        >
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('layout')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>

                            {{-- Card style --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Information Card Style
                                </span>

                                <select
                                    name="card_style"
                                    x-model="cardStyle"
                                    class="w-full rounded-xl border-slate-300 bg-white focus:border-red-700 focus:ring-red-700"
                                >
                                    @foreach([
                                        'soft' => 'Soft Cards',
                                        'bordered' => 'Strong Borders',
                                        'glass' => 'Glass Cards',
                                    ] as $value => $label)
                                        <option
                                            value="{{ $value }}"
                                            @selected(
                                                old(
                                                    'card_style',
                                                    $businessTemplate->card_style
                                                        ?: 'soft'
                                                ) === $value
                                            )
                                        >
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('card_style')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>
                        </div>
                    </section>

                    {{-- Colors --}}
                    <section>
                        <div class="mb-4">
                            <p
                                class="text-xs font-black uppercase tracking-[0.18em] text-red-700"
                            >
                                Step 4
                            </p>

                            <h2 class="mt-1 text-xl font-black text-slate-900">
                                Template Colors
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                These colors are available in dynamic and
                                selected HTML templates.
                            </p>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            {{-- Primary color --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Primary Color
                                </span>

                                <div class="flex gap-2">
                                    <input
                                        type="color"
                                        name="primary_color"
                                        x-model="primaryColor"
                                        class="h-11 w-16 shrink-0 cursor-pointer rounded-xl border border-slate-300 bg-white p-1"
                                    >

                                    <input
                                        type="text"
                                        x-model="primaryColor"
                                        maxlength="7"
                                        class="w-full rounded-xl border-slate-300 font-mono uppercase focus:border-red-700 focus:ring-red-700"
                                    >
                                </div>

                                @error('primary_color')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>

                            {{-- Secondary color --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Secondary Color
                                </span>

                                <div class="flex gap-2">
                                    <input
                                        type="color"
                                        name="secondary_color"
                                        x-model="secondaryColor"
                                        class="h-11 w-16 shrink-0 cursor-pointer rounded-xl border border-slate-300 bg-white p-1"
                                    >

                                    <input
                                        type="text"
                                        x-model="secondaryColor"
                                        maxlength="7"
                                        class="w-full rounded-xl border-slate-300 font-mono uppercase focus:border-red-700 focus:ring-red-700"
                                    >
                                </div>

                                @error('secondary_color')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>

                            {{-- Accent color --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Accent Color
                                </span>

                                <div class="flex gap-2">
                                    <input
                                        type="color"
                                        name="accent_color"
                                        x-model="accentColor"
                                        class="h-11 w-16 shrink-0 cursor-pointer rounded-xl border border-slate-300 bg-white p-1"
                                    >

                                    <input
                                        type="text"
                                        x-model="accentColor"
                                        maxlength="7"
                                        class="w-full rounded-xl border-slate-300 font-mono uppercase focus:border-red-700 focus:ring-red-700"
                                    >
                                </div>

                                @error('accent_color')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>

                            {{-- Background color --}}
                            <label>
                                <span
                                    class="mb-1.5 block text-sm font-bold text-slate-700"
                                >
                                    Page Background
                                </span>

                                <div class="flex gap-2">
                                    <input
                                        type="color"
                                        name="background_color"
                                        x-model="backgroundColor"
                                        class="h-11 w-16 shrink-0 cursor-pointer rounded-xl border border-slate-300 bg-white p-1"
                                    >

                                    <input
                                        type="text"
                                        x-model="backgroundColor"
                                        maxlength="7"
                                        class="w-full rounded-xl border-slate-300 font-mono uppercase focus:border-red-700 focus:ring-red-700"
                                    >
                                </div>

                                @error('background_color')
                                    <p class="mt-1 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </label>
                        </div>
                    </section>

                    {{-- Status settings --}}
                    <section>
                        <div class="mb-4">
                            <p
                                class="text-xs font-black uppercase tracking-[0.18em] text-red-700"
                            >
                                Step 5
                            </p>

                            <h2 class="mt-1 text-xl font-black text-slate-900">
                                Template Status
                            </h2>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            {{-- Active --}}
                            <label
                                class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-green-300 hover:bg-green-50/50"
                            >
                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    @checked(
                                        old(
                                            'is_active',
                                            $businessTemplate->exists
                                                ? $businessTemplate->is_active
                                                : true
                                        )
                                    )
                                    class="mt-1 rounded border-slate-300 text-green-600 focus:ring-green-500"
                                >

                                <span>
                                    <strong class="block text-slate-900">
                                        Active Template
                                    </strong>

                                    <small class="mt-1 block leading-5 text-slate-500">
                                        Active templates can be selected while
                                        creating a business.
                                    </small>
                                </span>
                            </label>

                            {{-- Default --}}
                            <label
                                class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-amber-300 hover:bg-amber-50/50"
                            >
                                <input
                                    type="checkbox"
                                    name="is_default"
                                    value="1"
                                    @checked(
                                        old(
                                            'is_default',
                                            $businessTemplate->is_default
                                                ?? false
                                        )
                                    )
                                    class="mt-1 rounded border-slate-300 text-amber-600 focus:ring-amber-500"
                                >

                                <span>
                                    <strong class="block text-slate-900">
                                        Default Template
                                    </strong>

                                    <small class="mt-1 block leading-5 text-slate-500">
                                        This template will be used when no
                                        valid business template is available.
                                    </small>
                                </span>
                            </label>
                        </div>
                    </section>

                    {{-- Submit button --}}
                    <div class="border-t border-slate-100 pt-6">
                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 font-black text-white shadow-lg shadow-red-700/20 transition hover:-translate-y-0.5 hover:from-red-800 hover:to-slate-950"
                        >
                            <span>
                                {{ $businessTemplate->exists
                                    ? 'Update Template'
                                    : 'Create Template' }}
                            </span>

                            <span>→</span>
                        </button>
                    </div>
                </div>
            </form>

            {{-- Live preview --}}
           <aside class="lg:sticky lg:top-6 lg:self-start">
    <div class="mb-3 flex items-center justify-between">
        <div>
            <p
                class="text-xs font-black uppercase tracking-[0.18em] text-slate-500"
            >
                Live Preview
            </p>

            <p
                class="mt-1 text-xs font-semibold"
                :class="viewKey
                    ? 'text-blue-700'
                    : 'text-green-700'"
                x-text="viewKey
                    ? selectedDesignName()
                    : 'Dynamic Custom Design'"
            ></p>
        </div>

        <span
            class="rounded-full px-3 py-1 text-xs font-black"
            :class="viewKey
                ? 'bg-blue-100 text-blue-700'
                : 'bg-green-100 text-green-700'"
            x-text="viewKey ? 'HTML' : 'DYNAMIC'"
        ></span>
    </div>

    {{-- Actual selected HTML preview --}}
    <template x-if="viewKey">
        <div
            class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-2xl"
        >
            <div
                class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-4 py-3"
            >
                <div class="flex items-center gap-2">
                    <span class="h-3 w-3 rounded-full bg-red-400"></span>
                    <span class="h-3 w-3 rounded-full bg-amber-400"></span>
                    <span class="h-3 w-3 rounded-full bg-green-400"></span>
                </div>

                <button
                    type="button"
                    @click="refreshHtmlPreview()"
                    class="rounded-lg border bg-white px-3 py-1.5 text-xs font-bold text-slate-700 hover:bg-slate-100"
                >
                    Refresh
                </button>
            </div>

            <div
                class="relative bg-slate-100"
                style="height: 680px;"
            >
                <div
                    x-show="previewLoading"
                    class="absolute inset-0 z-10 grid place-items-center bg-white/90"
                >
                    <div class="text-center">
                        <div
                            class="mx-auto h-10 w-10 animate-spin rounded-full border-4 border-slate-200 border-t-red-700"
                        ></div>

                        <p class="mt-3 text-sm font-bold text-slate-600">
                            Loading template preview...
                        </p>
                    </div>
                </div>

                <iframe
                    x-ref="htmlPreview"
                    :src="htmlPreviewUrl"
                    @load="previewLoading = false"
                    class="h-full w-full border-0 bg-white"
                    title="HTML template preview"
                ></iframe>
            </div>

            <div
                class="border-t border-slate-200 bg-white px-4 py-3 text-center"
            >
                <button
                    type="button"
                    @click="openPreviewInNewTab()"
                    class="text-sm font-black text-blue-700 hover:underline"
                >
                    Open full-size preview ↗
                </button>
            </div>
        </div>
    </template>

    {{-- Dynamic custom design preview --}}
    <template x-if="!viewKey">
        <div>
            <div
                class="overflow-hidden rounded-[2rem] border border-white bg-white shadow-2xl transition"
                :style="`background:${backgroundColor}`"
            >
                <div
                    class="h-2"
                    :style="`
                        background:linear-gradient(
                            90deg,
                            ${primaryColor},
                            ${accentColor}
                        )
                    `"
                ></div>

                <div
                    class="relative overflow-hidden p-7 text-center text-white"
                    :style="`
                        background:linear-gradient(
                            135deg,
                            ${primaryColor},
                            ${secondaryColor}
                        )
                    `"
                >
                    <div
                        class="absolute -right-16 -top-16 h-40 w-40 rounded-full opacity-20 blur-2xl"
                        :style="`background:${accentColor}`"
                    ></div>

                    <div class="relative z-10">
                        <div
                            class="mx-auto grid h-20 w-20 place-items-center rounded-full border-4 border-white bg-white text-2xl font-black shadow-xl"
                            :style="`color:${primaryColor}`"
                        >
                            <span
                                x-text="name
                                    ? name.charAt(0).toUpperCase()
                                    : 'B'"
                            ></span>
                        </div>

                        <p
                            class="mt-5 text-xs font-black uppercase tracking-widest"
                            :style="`color:${accentColor}`"
                        >
                            Business Category
                        </p>

                        <h3
                            class="mt-2 text-2xl font-black"
                            x-text="name || 'Template Preview'"
                        ></h3>

                        <p class="mt-2 text-sm text-white/70">
                            Your trusted business partner
                        </p>

                        <div class="mt-5 grid grid-cols-2 gap-2">
                            <span
                                class="rounded-xl bg-white p-3 text-sm font-black"
                                :style="`color:${primaryColor}`"
                            >
                                Call Now
                            </span>

                            <span
                                class="rounded-xl p-3 text-sm font-black"
                                :style="`
                                    background:${accentColor};
                                    color:${getContrastColor(accentColor)}
                                `"
                            >
                                WhatsApp
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid gap-3 p-5 sm:grid-cols-2">
                    <template
                        x-for="detail in [
                            'Contact Person',
                            'Mobile Number',
                            'Email Address',
                            'Business Address'
                        ]"
                        :key="detail"
                    >
                        <div
                            class="rounded-xl bg-white p-3 shadow-sm"
                            :class="{
                                'border border-slate-100':
                                    cardStyle === 'soft',

                                'border-2':
                                    cardStyle === 'bordered',

                                'border border-white/80 bg-white/75 backdrop-blur':
                                    cardStyle === 'glass'
                            }"
                            :style="cardStyle === 'bordered'
                                ? `border-color:${primaryColor}35`
                                : ''"
                        >
                            <small
                                class="font-black uppercase tracking-wide"
                                :style="`color:${primaryColor}`"
                                x-text="detail"
                            ></small>

                            <div
                                class="mt-2 h-2 w-3/4 rounded bg-slate-200"
                            ></div>

                            <div
                                class="mt-2 h-2 w-1/2 rounded bg-slate-100"
                            ></div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </template>
</aside>
        </div>
    </div>

  <script>
    function templateDesigner() {
        return {
            name: @json(
                old(
                    'name',
                    $businessTemplate->name ?? ''
                )
            ),

            viewKey: @json(
                old(
                    'view_key',
                    $businessTemplate->view_key ?? ''
                )
            ),

            layout: @json(
                old(
                    'layout',
                    $businessTemplate->layout ?: 'split'
                )
            ),

            cardStyle: @json(
                old(
                    'card_style',
                    $businessTemplate->card_style ?: 'soft'
                )
            ),

            primaryColor: @json(
                old(
                    'primary_color',
                    $businessTemplate->primary_color
                        ?: '#991b1b'
                )
            ),

            secondaryColor: @json(
                old(
                    'secondary_color',
                    $businessTemplate->secondary_color
                        ?: '#0f172a'
                )
            ),

            accentColor: @json(
                old(
                    'accent_color',
                    $businessTemplate->accent_color
                        ?: '#f59e0b'
                )
            ),

            backgroundColor: @json(
                old(
                    'background_color',
                    $businessTemplate->background_color
                        ?: '#fff7ed'
                )
            ),

            previewLoading: true,

            htmlDesigns: @json(
                collect(
                    config('business_templates.views', [])
                )->mapWithKeys(
                    fn ($design, $key) => [
                        $key => $design['name']
                    ]
                )
            ),

            get htmlPreviewUrl() {
                if (!this.viewKey) {
                    return '';
                }

                const baseUrl = @json(
                    url('/business-templates/preview-design')
                );

                const params = new URLSearchParams({
                    name: this.name || 'Template Preview',
                    layout: this.layout,
                    card_style: this.cardStyle,
                    primary_color: this.primaryColor,
                    secondary_color: this.secondaryColor,
                    accent_color: this.accentColor,
                    background_color: this.backgroundColor
                });

                return `${baseUrl}/${encodeURIComponent(
                    this.viewKey
                )}?${params.toString()}`;
            },

            selectedDesignName() {
                if (!this.viewKey) {
                    return 'Dynamic Custom Design';
                }

                return this.htmlDesigns[this.viewKey]
                    ?? 'Selected HTML Design';
            },

            refreshHtmlPreview() {
                if (
                    !this.viewKey ||
                    !this.$refs.htmlPreview
                ) {
                    return;
                }

                this.previewLoading = true;

                this.$refs.htmlPreview.src =
                    this.htmlPreviewUrl
                    + '&refresh='
                    + Date.now();
            },

            openPreviewInNewTab() {
                if (!this.viewKey) {
                    return;
                }

                window.open(
                    this.htmlPreviewUrl,
                    '_blank',
                    'noopener'
                );
            },

            getContrastColor(hexColor) {
                if (!hexColor) {
                    return '#000000';
                }

                const hex = hexColor.replace('#', '');

                if (hex.length !== 6) {
                    return '#000000';
                }

                const red = parseInt(
                    hex.substring(0, 2),
                    16
                );

                const green = parseInt(
                    hex.substring(2, 4),
                    16
                );

                const blue = parseInt(
                    hex.substring(4, 6),
                    16
                );

                const brightness =
                    (red * 299 + green * 587 + blue * 114)
                    / 1000;

                return brightness > 155
                    ? '#0f172a'
                    : '#ffffff';
            }
        };
    }
</script>
</x-app-layout>
