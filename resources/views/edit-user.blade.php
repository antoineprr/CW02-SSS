<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium mb-6">Edit User: {{ $user->firstname }} {{ $user->name }}</h3>
                    
                    <form method="POST" action="{{ route('admin-dashboard.user.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="firstname" class="block text-sm font-medium text-gray-700 mb-2">
                                    First Name
                                </label>
                                <input type="text" 
                                       name="firstname" 
                                       id="firstname" 
                                       value="{{ old('firstname', $user->firstname) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       required>
                                @error('firstname')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Last Name
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $user->name) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">User Roles</h4>
                            
                            <div class="flex items-center">
                                <input type="hidden" name="is_admin" value="0">
                                <input type="checkbox" 
                                       name="is_admin" 
                                       id="is_admin" 
                                       value="1"
                                       {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_admin" class="ml-2 block text-sm text-gray-700">
                                    Administrator
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="hidden" name="is_author" value="0">
                                <input type="checkbox" 
                                       name="is_author" 
                                       id="is_author" 
                                       value="1"
                                       {{ old('is_author', $user->is_author) ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_author" class="ml-2 block text-sm text-gray-700">
                                    Author
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-between pt-6">
                            <a href="{{ route('admin-dashboard.users') }}" 
                               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </a>
                            
                        <x-primary-button>Save</x-primary-button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
