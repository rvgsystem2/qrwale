<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('User Management') }}
            </h2>
            @can('create users')
                <a href="{{ route('user.create') }}"
                    class="px-5 py-2 bg-gradient-to-r from-[#c21108] to-[#000308] text-white font-semibold rounded-lg shadow-md hover:from-[#000308] hover:to-[#c21108] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c21108] transition duration-300 ease-in-out">
                    + Create
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if (session('success'))
                <div class="flex items-center bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-md">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">User Management</h2>
            
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="bg-gray-100 text-gray-800 uppercase text-sm font-semibold">
                            <tr>
                                <th class="px-6 py-3 border-b">ID</th>
                                <th class="px-6 py-3 border-b">Name</th>
                                <th class="px-6 py-3 border-b">Email</th>
                                <th class="px-6 py-3 border-b">Roles</th>
                                <th class="px-6 py-3 border-b">Permissions</th>
                                <th class="px-6 py-3 border-b text-center">Actions</th>
                            </tr>
                        </thead>
            
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($userData as $user)
                                <tr class="hover:bg-gray-50 transition-all">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                    <td class="px-6 py-4">
                                        @if ($user->permissions->isNotEmpty())
                                            <span class="text-gray-700 text-sm">
                                                {{ $user->permissions->pluck('name')->implode(', ') }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic">No Permissions</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2 flex-wrap">
                                            @can('edit users')
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                   class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-4 py-2 rounded shadow transition">
                                                    Edit
                                                </a>
                                            @endcan
            
                                            @can('delete users')
                                                <a href="{{ route('user.delete', $user->id) }}"
                                                   class="bg-red-500 hover:bg-red-600 text-white text-xs px-4 py-2 rounded shadow transition">
                                                    Delete
                                                </a>
                                            @endcan
            
                                            @can('assign permissions user')
                                                <a href="{{ route('user.permission.form', $user->id) }}"
                                                   class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-4 py-2 rounded shadow transition">
                                                    Assign Permissions
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500 text-base">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            

        </div>
    </div>
</x-app-layout>
