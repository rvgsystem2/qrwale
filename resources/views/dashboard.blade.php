<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white bg-gradient-to-r from-[#5b7da4] to-[#39517c] px-4 py-2 rounded-md shadow-md inline-block">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-[#5b7da4] to-[#1b263b] shadow-lg sm:rounded-lg">
                <div class="p-6 text-white text-lg font-semibold text-center">
                    {{ __("You're logged in!") }} 🚀
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
