<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Layanan di {{ $branch->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ selectedService: {} }" style="padding: 2.5rem; flex-wrap: wrap; width: fit-content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex gap-6 mx-auto">
                @forelse ($services as $service)
                <div style="width: 20rem;" class="bg-white relative shadow-lg rounded-lg overflow-hidden">
                    <!-- Cover Image -->
                    <div 
                        style="
                            height: 10rem; 
                            background-image: url('{{ $service->img_url }}'); 
                            background-size: cover; 
                            background-position: center;" 
                        class="w-full relative rounded-t-lg flex justify-end p-2"
                    >
                        <!-- Dropdown Button -->
                        <x-dropdown align="right" width="48" class="absolute top-0 right-0">
                            <x-slot name="trigger">
                                @if(Auth::user()->role === 'admin')
                                <button class="inline-flex items-center px-1 py-1 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                        <path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/>
                                    </svg>
                                </button>
                                @endif
                            </x-slot>
            
                            <x-slot name="content">
                                <x-dropdown-link 
                                    style="cursor: pointer" 
                                    @click="selectedService = {{ json_encode($service) }}; $dispatch('open-modal', 'edit-service-modal');" 
                                    class="block px-4 py-2 text-sm text-gray-700">
                                    Edit
                                </x-dropdown-link>
                                <x-dropdown-link class="block px-4 py-2 text-sm text-gray-700 cursor-pointer">
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this branch?');">
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
            
                    <!-- Card Content -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $service->name }}</h2>
                        <p class="text-sm text-gray-600 mb-2">{{ $service->description }}</p>
                        <p class="text-sm font-bold text-gray-800 mb-1">Harga: Rp {{ number_format($service->price) }}</p>
                        <p class="text-sm text-gray-600">Durasi: {{ $service->duration }} menit</p>
                    </div>
                </div>
                @empty
                    <div class="bg-white shadow-md rounded-lg p-4 text-center">
                        <p class="text-gray-600">Belum ada layanan yang tersedia.</p>
                    </div>
                @endforelse
            
                {{-- Modal Edit Service --}}
                <x-modal name="edit-service-modal">
                    <div style="padding: 2.5rem" x-data="{ previewUrl: '', init() { this.previewUrl = selectedService.img_url } }">
                        <h2 style="font-weight: bold" class="text-2xl mb-6">Edit Layanan</h2>
                        <form method="POST" :action="`{{ route('services.update', '') }}/${selectedService.id}`" class="flex flex-col gap-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                
                            <!-- Branch Dropdown -->
                            <div class="hidden">
                                <x-input-label for="branch" :value="__('Nama Cabang')" />
                                <select 
                                    id="branch" 
                                    name="branch_id" 
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                    required
                                    x-model="selectedService.branch_id"
                                >
                                    <option value="" disabled selected>Pilih Cabang</option>
                                    @foreach ($branches as $branch)
                                        <option :selected="selectedService.branch_id == {{ $branch->id }}" value="{{ $branch->id }}">
                                            {{ $branch->name }} - {{ $branch->city }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('branch_id')" class="mt-2" />
                            </div>
                
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Nama Layanan')" />
                                <x-text-input 
                                    id="name" 
                                    class="block mt-1 w-full" 
                                    type="text" 
                                    name="name" 
                                    required 
                                    x-model="selectedService.name" 
                                />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                
                            <!-- Image -->
                            <div>
                                <x-input-label for="image" :value="__('Cover')" />
                                <x-text-input 
                                    id="image" 
                                    class="block mt-1 w-full" 
                                    type="file" 
                                    name="img_url" 
                                    accept="image/*"
                                    x-ref="imageInput"
                                    x-on:change="
                                        const file = $refs.imageInput.files[0];
                                        if (file) {
                                            previewUrl = URL.createObjectURL(file);
                                        } else {
                                            previewUrl = selectedService.img_url || '';
                                        }
                                    "
                                />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                
                                <!-- Image Preview -->
                                <img 
                                    :src="previewUrl || selectedService.img_url" 
                                    alt="Preview Image" 
                                    class="mt-4 rounded-md shadow-lg" 
                                    style="max-width: 200px; max-height: 200px;"
                                />
                                
                            </div>
                
                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Deskripsi')" />
                                <x-text-input 
                                    id="description" 
                                    class="block mt-1 w-full" 
                                    type="text" 
                                    name="description" 
                                    required 
                                    x-model="selectedService.description" 
                                />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                
                            <!-- Harga -->
                            <div>
                                <x-input-label for="price" :value="__('Harga (Rp)')" />
                                <x-text-input 
                                    id="price" 
                                    class="block mt-1 w-full" 
                                    type="number" 
                                    name="price" 
                                    required 
                                    x-model="selectedService.price" 
                                />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                
                            <!-- Durasi -->
                            <div>
                                <x-input-label for="duration" :value="__('Durasi (menit)')" />
                                <x-text-input 
                                    id="duration" 
                                    class="block mt-1 w-full" 
                                    type="number" 
                                    name="duration" 
                                    required 
                                    x-model="selectedService.duration" 
                                />
                                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                            </div>
                
                            <div class="flex items-center justify-end mt-4 gap-2">
                                <x-danger-button 
                                    class="ms-3" 
                                    type="button"
                                    @click="$dispatch('close-modal', 'edit-service-modal')"
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
            
        </div>
    </div>
</x-app-layout>
