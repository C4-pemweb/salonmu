<nav x-data="{ open: false, dropdownOpen: false}" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('branch') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- @if(Auth::user()->role === 'admin') --}}
                        <x-nav-link :href="url('branch')" :active="request()->routeIs('branch')">
                            {{ __('Cabang') }}
                        </x-nav-link>
                    {{-- @endif --}}
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- @if(Auth::user()->role === 'admin') --}}
                        <x-nav-link :href="url('book')" :active="request()->routeIs('book')">
                            {{ __('Reservasi') }}
                        </x-nav-link>
                    {{-- @endif --}}
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- add dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <svg class="h-6 w-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->role === 'admin')
                            <x-dropdown-link
                                style="cursor: pointer" 
                                @click="$dispatch('open-modal', 'add-branch-modal')" 
                                class="block px-4 py-2 text-sm text-gray-700">
                                Tambah Cabang
                            </x-dropdown-link>
                            <x-dropdown-link
                                style="cursor: pointer" 
                                @click="$dispatch('open-modal', 'add-service-modal')" 
                                class="block px-4 py-2 text-sm text-gray-700 cursor-pointer">
                                Tambah Layanan
                            </x-dropdown-link>
                        @endif
                        @if(Auth::user()->role === 'customer')
                            <x-dropdown-link
                                style="cursor: pointer" 
                                @click="$dispatch('open-modal', 'add-booking-modal')"
                                class="block px-4 py-2 text-sm text-gray-700">
                                Reservasi
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="url('/top-up')">
                            {{ __('Topup') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    {{-- modal add branch --}}
    <x-modal name="add-branch-modal">
        <div style="padding: 2.5rem">
            <h2 style="font-weight: bold" class="text-2xl mb-6">Tambah Cabang</h2>
            <form method="POST" action="{{ route('branches.store') }}" class="flex flex-col gap-4">
                @csrf
        
                <!-- name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Cabang')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- province -->
                <div>
                    <x-input-label for="province" :value="__('Provinsi')" />
                    <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('province')" class="mt-2" />
                </div>

                <!-- province -->
                <div>
                    <x-input-label for="city" :value="__('Kota')" />
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <!-- address -->
                <div>
                    <x-input-label for="address" :value="__('Alamat')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end mt-4 gap-2">
                    <x-danger-button class="ms-3" type="button"
                    @click="$dispatch('close-modal', 'add-branch-modal')"
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

    {{-- modal add service --}}
    <x-modal name="add-service-modal">
        <div style="padding: 2.5rem" x-data="{ previewUrl: '' }">
            <h2 style="font-weight: bold" class="text-2xl mb-6">Tambah Layanan</h2>
            <form method="POST" action="{{ route('services.store') }}" class="flex flex-col gap-4" enctype="multipart/form-data">
                @csrf
    
                <!-- Branch Dropdown -->
                <div>
                    <x-input-label for="branch" :value="__('Nama Cabang')" />
                    <select 
                        id="branch" 
                        name="branch_id" 
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        required
                    >
                        <option value="" disabled selected>Pilih Cabang</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">
                                {{ $branch->name }} - {{ $branch->city }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('branch_id')" class="mt-2" />
                </div>
    
                <!-- name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Layanan')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
    
                <!-- image -->
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
                                previewUrl = '';
                            }
                        "
                    />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
    
                    <!-- Image Preview -->
                    <template x-if="previewUrl">
                        <img 
                            :src="previewUrl" 
                            alt="Preview Image" 
                            class="mt-4 rounded-md shadow-lg" 
                            style="max-width: 200px; max-height: 200px;"
                        />
                    </template>
                </div>
    
                <!-- description -->
                <div>
                    <x-input-label for="description" :value="__('Deskripsi')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
    
                <!-- harga -->
                <div>
                    <x-input-label for="price" :value="__('Harga (Rp)')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
    
                <!-- durasi -->
                <div>
                    <x-input-label for="duration" :value="__('Durasi (menit)')" />
                    <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" :value="old('duration')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end mt-4 gap-2">
                    <x-danger-button 
                        class="ms-3" 
                        type="button"
                        @click="$dispatch('close-modal', 'add-service-modal')"
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

    {{-- modal add booking --}}
    <x-modal name="add-booking-modal">
        <div style="padding: 2.5rem" 
        x-data="{
            branchId: '',
            services: [],
            fetchServices(branchId) {
                fetch(`/branches/${branchId}/services`)
                    .then(response => response.json())
                    .then(data => {
                        this.services = data; // Update services dengan data baru
                    });
            }
        }">
            <h2 style="font-weight: bold" class="text-2xl mb-6">Reservasi</h2>
            <form method="POST" action="{{ route('bookings.store') }}" class="flex flex-col gap-4" enctype="multipart/form-data">
                @csrf
                <div class="hidden">
                    <x-input-label for="user_id" :value="__('Tanggal')" />
                    <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="Auth::user()->id" required />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div class="hidden">
                    <x-input-label for="status" :value="__('Tanggal')" />
                    <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" value="pending" required />
                </div>
    
                <!-- Branch Dropdown -->
                <div>
                    <x-input-label for="branch" :value="__('Nama Cabang')" />
                    <select 
                        id="branch" 
                        name="branch_id" 
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        x-model="branchId"
                        @change="fetchServices(branchId)"
                        required
                    >
                        <option value="" disabled selected>Pilih Cabang</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">
                                {{ $branch->name }} - {{ $branch->city }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('branch_id')" class="mt-2" />
                </div>
    
                <!-- Service Dropdown -->
                <div>
                    <x-input-label for="service" :value="__('Nama Layanan')" />
                    <select 
                        id="service" 
                        name="service_id" 
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        x-bind:disabled="services.length === 0"
                        required
                    >
                        <option value="" disabled selected>Pilih Layanan</option>
                        <template x-for="service in services" :key="service.id">
                            <option :value="service.id" x-text="service.name"></option>
                        </template>
                    </select>
                    <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                </div>
    
                <!-- Employee Dropdown -->
                <div>
                    <x-input-label for="employee" :value="__('Nama Karyawan')" />
                    <select 
                        id="employee" 
                        name="employee_id" 
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        required
                    >
                        <option value="" disabled selected>Pilih Karyawan</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                </div>
    
                <!-- Date -->
                <div>
                    <x-input-label for="date" :value="__('Tanggal')" />
                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>
    
                <!-- Time -->
                <div>
                    <x-input-label for="time" :value="__('Waktu')" />
                    <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" :value="old('time')" required />
                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                </div>
    
                <!-- Buttons -->
                <div class="flex items-center justify-end mt-4 gap-2">
                    <x-danger-button 
                        class="ms-3" 
                        type="button"
                        @click="$dispatch('close-modal', 'add-booking-modal')"
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
      
    
</nav>
