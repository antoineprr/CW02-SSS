<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium mb-4">Users list</h3>
                    
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        @php
                                            $columns = ['ID', 'Name', 'First Name', 'Email', 'Admin', 'Author', 'Registration Date', 'Actions'];
                                        @endphp
                                        @foreach($columns as $column)
                                            <th class="px-6 py-3 border-b border-gray-300 text-left text-xs font-medium text-gray-500 uppercase">{{ $column }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                        @php
                                            $cellClass = "px-6 py-4 whitespace-nowrap text-sm text-gray-900";
                                            $badgeYes = "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800";
                                            $badgeNo = "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800";
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="{{ $cellClass }} font-medium">{{ $user->id }}</td>
                                            <td class="{{ $cellClass }}">{{ $user->name }}</td>
                                            <td class="{{ $cellClass }}">{{ $user->firstname }}</td>
                                            <td class="{{ $cellClass }}">{{ $user->email }}</td>
                                            <td class="{{ $cellClass }}">
                                                <span class="{{ $user->is_admin ? $badgeYes : $badgeNo }}">
                                                    {{ $user->is_admin ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td class="{{ $cellClass }}">
                                                <span class="{{ $user->is_author ? $badgeYes : $badgeNo }}">
                                                    {{ $user->is_author ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td class="{{ $cellClass }}">{{ $user->created_at->format('d/m/Y g:i A') }}</td>
                                            <td class="{{ $cellClass }}">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin-dashboard.user', ['user' => $user]) }}" class="text-gray-600 hover:text-blue-600 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </a>
                                                    <button 
                                                        x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{ $user->id }}')"
                                                        class="text-gray-600 hover:text-red-600 transition-colors"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">Total: {{ $users->count() }} user(s)</p>
                        </div>

                        @foreach($users as $user)
                            <x-modal name="confirm-user-deletion-{{ $user->id }}" focusable>
                                <form method="post" action="{{ route('admin-dashboard.delete-user', ['user' => $user]) }}" class="p-6">
                                    @csrf
                                    @method('DELETE')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        Are you sure you want to delete this user?
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        Once deleted, the user <strong>{{ $user->name }} {{ $user->firstname }}</strong> ({{ $user->email }}) will be permanently removed from the database.
                                    </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            Cancel
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            Delete User
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No users found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
