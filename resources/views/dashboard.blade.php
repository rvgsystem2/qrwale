<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white bg-gradient-to-r from-[#c21108] to-[#000308] px-4 py-2 rounded-md shadow-md inline-block">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-[#ef0808] to-[#000308] shadow-lg sm:rounded-lg transition-all duration-300 hover:from-[#000308] hover:to-[#ef0808]">
                <div class="p-6 text-white text-lg font-semibold text-center">
                    {{ __("You're logged in!") }} 🚀
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
