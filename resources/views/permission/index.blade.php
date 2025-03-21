<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4 rounded-lg">
            <h2 class="font-bold text-2xl text-gray-800">
                {{ __('Permission Management') }}
            </h2>
            @can('create permission')
            <a href="{{ route('permission.create') }}" 
               class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                + Create Permission
            </a>      
            @endcan
          
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

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="flex items-center bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-md">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                                <th class="border border-gray-300 px-6 py-3 text-left">ID</th>
                                <th class="border border-gray-300 px-6 py-3 text-left">Name</th>
                                <th class="border border-gray-300 px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($permissionData as $permission)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="border border-gray-300 px-6 py-4 text-gray-900 font-medium">{{ $permission->id }}</td>
                                    <td class="border border-gray-300 px-6 py-4 text-gray-900">{{ $permission->name }}</td>
                                    <td class="border border-gray-300 px-6 py-4 text-center">
                                        @can('edit permission')
                                        <a href="{{ route('permission.edit', $permission->id) }}" 
                                            class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow hover:bg-yellow-600 transition">
                                             Edit
                                         </a>     
                                        @endcan
                                       
                                        @can('delete permission')
                                        <a href="{{ route('permission.delete', $permission->id) }}" 
                                            class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                                             delete
                                         </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-6 text-gray-500 text-lg">No permissions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
