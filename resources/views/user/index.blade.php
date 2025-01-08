<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div x-data="{ selectedUser: 'message' }" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- User Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($users as $user)
                            <div class="bg-white border border-gray-200 rounded-lg shadow p-4 relative">
                                <!-- Card Header -->
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $user->name }}
                                    </h3>
                                    <!-- More Button -->
                                    <div>

                                        <!-- Dropdown Menu -->
                                        <!-- Right Section: Dropdown Menu -->
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">      
                                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link
                                                    style="cursor: pointer" 
                                                    x-on:click="message = 'changed'"
                                                    @click="selectedUser = {{ json_encode($user) }}; $dispatch('open-modal', 'edit-user-modal');" 
                                                    class="block px-4 py-2 text-sm text-gray-700">
                                                    Edit
                                                </x-dropdown-link>
                                                <x-dropdown-link 
                                                    class="block px-4 py-2 text-sm text-gray-700 cursor-pointer">
                                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="color: red; width: 100%; text-align: left;" type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                </div>
                                
                                <!-- Card Body -->
                                <p class="text-gray-600 mt-2">
                                    <span class="font-semibold">Email:</span> {{ $user->email }}
                                </p>
                                <p class="text-gray-600 mt-1">
                                    <span class="font-semibold">Role:</span> {{ ucfirst($user->role) }}
                                </p>
                                <p class="text-gray-600 mt-1">
                                    <span class="font-semibold">Balance:</span> Rp {{ number_format($user->balance, 0, ',', '.') }}
                                </p>
                                <p class="text-gray-600 mt-1 text-sm">
                                    <span class="font-semibold">Terdaftar:</span> {{ $user->created_at->format('d M Y') }}
                                </p>
                            </div>
                        @endforeach
                        <x-modal name="edit-user-modal">
                            <div style="padding: 2.5rem" x-data="{
                                branch: window.selectedBranch || { name: '', province: '', city: '', address: '' },
                                init() {
                                    this.branch = window.selectedBranch;
                                }
                            }" x-init="init()">
                                <h2 style="font-weight: bold" class="text-2xl mb-6">Edit Pengguna</h2>
                                <form method="POST" :action="`{{ route('users.update', '') }}/${selectedUser.id}`" class="flex flex-col gap-4">
                                    @csrf
                                    @method('PUT')
                                    <!-- name -->
                                    <div>
                                        <x-input-label for="name" :value="__('Nama')" />
                                        <x-text-input x-model="selectedUser.name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                    
                                    <div>
                                        <x-input-label for="role" :value="__('Role')" />
                                        <select 
                                            id="role" 
                                            name="role" 
                                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                            required
                                        >
                                            <option value="" disabled x-bind:selected="!selectedUser.role">Pilih Role</option>
                                            <option 
                                                value="customer" 
                                                x-bind:selected="selectedUser.role === 'customer'"
                                            >
                                                Customer
                                            </option>
                                            <option 
                                                value="admin" 
                                                x-bind:selected="selectedUser.role === 'admin'"
                                            >
                                                Admin
                                            </option>
                                            <option 
                                                value="employee" 
                                                x-bind:selected="selectedUser.role === 'employee'"
                                            >
                                                Karyawan
                                            </option>
                                        </select>

                                        <x-input-error :messages="$errors->get('branch_id')" class="mt-2" />
                                    </div>
                    
                                    <!-- province -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input x-model="selectedUser.email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                    
                                    <!-- address -->
                                    <div>
                                        <x-input-label for="balance" :value="__('Saldo')" />
                                        <x-text-input x-model="selectedUser.balance" id="balance" class="block mt-1 w-full" type="number" name="balance" :value="old('balance')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('balance')" class="mt-2" />
                                    </div>
                            
                                    <div class="flex items-center justify-end mt-4 gap-2">
                                        <x-danger-button class="ms-3" type="button"
                                        @click="$dispatch('close-modal', 'edit-user-modal')"
                                        >
                                            {{ __('Tutup') }}
                                        </x-danger-button>
                                        <x-primary-button class="ms-3">
                                            {{ __('Simpan') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </x-modal>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
