<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cabang') }}
        </h2>
    </x-slot>

    <div class="py-12"">
        <div  class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ selectedBranch: 'message' }">
            <div style="padding: 2.5rem; flex-wrap: wrap; width: fit-content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex gap-6 mx-auto">
                @foreach ($data as $id => $s)
                    <div style="width: 20rem" class="bg-white shadow-md rounded-lg p-4 mb-4 flex items-start justify-between" x-data="{ open: false }">
                        <!-- Left Section: Info -->
                        <div class="flex flex-col gap-2 w-3/4">
                            <div class="flex items-center gap-2">
                                <!-- Branch Icon (SVG) -->
                                <div style="padding: 1rem; background-color: navy;" class="rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M120-120v-560h160v-160h400v320h160v400H520v-160h-80v160H120Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z"/></svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-700">{{ $s->name }}</h3>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <!-- Location Icon (SVG) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C8.134 2 5 5.134 5 9c0 3.866 5 9 7 9s7-5.134 7-9c0-3.866-3.134-7-7-7zM12 12V9M12 9l3 3M12 9l-3 3" />
                                </svg>
                                <p>{{ $s->province }}, {{ $s->city }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $s->address }}</p>
                        </div>

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
                                    @click="selectedBranch = {{ json_encode($s) }}; $dispatch('open-modal', 'edit-branch-modal');" 
                                    class="block px-4 py-2 text-sm text-gray-700">
                                    Edit
                                </x-dropdown-link>
                                <x-dropdown-link 
                                    class="block px-4 py-2 text-sm text-gray-700 cursor-pointer">
                                    <form action="{{ route('branches.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this branch?');">
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
                @endforeach
                
                
            </div>
            <x-modal name="edit-branch-modal">
                <div style="padding: 2.5rem" x-data="{
                    branch: window.selectedBranch || { name: '', province: '', city: '', address: '' },
                    init() {
                        this.branch = window.selectedBranch;
                    }
                }" x-init="init()">
                    <h2 style="font-weight: bold" class="text-2xl mb-6">Edit Cabang</h2>
                    <form method="POST" :action="`{{ route('branches.update', '') }}/${selectedBranch.id}`" class="flex flex-col gap-4">
                        @csrf
                        @method('PUT')
                
                        <!-- name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Cabang')" />
                            <x-text-input 
                                id="name" 
                                class="block mt-1 w-full" 
                                type="text" 
                                name="name" 
                                x-model="selectedBranch.name"
                                required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- province -->
                        <div>
                            <x-input-label for="province" :value="__('Provinsi')" />
                            <x-text-input 
                                id="province" 
                                class="block mt-1 w-full" 
                                type="text" 
                                name="province" 
                                x-model="selectedBranch.province"
                                required />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>
                
                        <!-- city -->
                        <div>
                            <x-input-label for="city" :value="__('Kota')" />
                            <x-text-input 
                                id="city" 
                                class="block mt-1 w-full" 
                                type="text" 
                                name="city" 
                                x-model="selectedBranch.city"
                                required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                
                        <!-- address -->
                        <div>
                            <x-input-label for="address" :value="__('Alamat')" />
                            <x-text-input 
                                id="address" 
                                class="block mt-1 w-full" 
                                type="text" 
                                name="address" 
                                x-model="selectedBranch.address"
                                required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4 gap-2">
                            <x-danger-button type="button" class="ms-3"
                            @click="$dispatch('close-modal', 'edit-branch-modal')">
                                {{ __('Tutup') }}
                            </x-danger-button>
                            <x-primary-button class="ms-3" type="submit">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </x-modal>
        </div>
        <!-- Modal for Editing Branch -->
    </div>

</x-app-layout>
