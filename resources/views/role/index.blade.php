<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('Role Management') }}
            </h2>
            <a href="{{ route('role.create') }}" 
               class="px-5 py-2 bg-gradient-to-r from-[#c21108] to-[#000308] text-white font-semibold rounded-lg shadow-md hover:from-[#000308] hover:to-[#c21108] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c21108] transition duration-300 ease-in-out">
                + Create Role
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            @if (session('success'))
                <div class="flex items-center bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-md">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-100 text-gray-800 uppercase text-sm font-bold">
                                <th class="border border-gray-300 px-6 py-3 text-left">ID</th>
                                <th class="border border-gray-300 px-6 py-3 text-left">Role Name</th>
                                <th class="border border-gray-300 px-6 py-3 text-left">Permissions</th>
                                <th class="border border-gray-300 px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($roleData as $role)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="border border-gray-300 px-6 py-4 text-gray-900 font-medium">{{ $role->id }}</td>
                                    <td class="border border-gray-300 px-6 py-4 text-gray-900">{{ $role->name }}</td>
                                    <td class="border border-gray-300 px-6 py-4 text-gray-900">
                                        @if($role->permissions->isNotEmpty())
                                            <span class="text-sm text-gray-700">
                                                {{ implode(', ', $role->permissions->pluck('name')->toArray()) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">No Permissions Assigned</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('role.edit', $role->id) }}" 
                                           class="px-4 md:py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow hover:bg-yellow-600 transition">
                                            Edit
                                        </a>
                                        <a href="{{ route('role.delete', $role->id) }}" 
                                           class="px-4 md:py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500 text-lg">No roles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
