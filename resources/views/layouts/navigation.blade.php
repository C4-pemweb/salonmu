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
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role === 'superadmin')
                        <x-nav-link :href="url('user')" :active="request()->routeIs('user')">
                            {{ __('Pengguna') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="sm:flex sm:items-center sm:ms-6">
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
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
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
                        @if(Auth::user()->role === 'superadmin')
                            <x-dropdown-link
                                style="cursor: pointer" 
                                @click="$dispatch('open-modal', 'add-user-modal')"
                                class="block px-4 py-2 text-sm text-gray-700">
                                Tambah User
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

                <div x-data="notificationHandler()" x-init="startPolling" class="relative">
                    <!-- Trigger Button -->
                    <button 
                        @click="showModal = true" 
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <span x-text="unreadCount" class="ml-2 text-red-500 font-bold"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                            <path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z"/>
                        </svg>
                    </button>
                
                    <!-- Modal -->
                    <div 
                        x-show="showModal" 
                        @click.away="showModal = false"
                        style="transform: translate(-15rem); width:25rem"
                        class="absolute mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-bold">Notifikasi</h2>
                                <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                                    &times;
                                </button>
                            </div>

                            <!-- Notifications List -->
                            <div class="max-h-64 overflow-y-auto">
                                <template x-if="notifications.length > 0">
                                    <template x-for="notification in notifications" :key="notification.id">
                                        <div class="p-2 border-b border-gray-200">
                                            <p class="text-sm font-bold text-gray-800" x-text="notification.title"></p>
                                            <p x-text="notification.message" class="text-sm text-gray-700"></p>
                                            <p x-text="new Date(notification.created_at).toLocaleString()" class="text-xs text-gray-500"></p>
                                            <button 
                                                @click="markAsRead(notification.id)" 
                                                class="text-xs text-blue-500 hover:underline mt-1">
                                                Tandai telah dibaca
                                            </button>
                                        </div>
                                    </template>
                                </template>
                                <template x-if="notifications.length === 0">
                                    <p class="text-gray-500 text-sm">Tidak ada notifikasi baru.</p>
                                </template>
                            </div>

                            <!-- Modal Footer -->
                            <div class="flex justify-between mt-4">
                                <a 
                                    href="{{ route('notifications.index') }}" 
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                    Lihat Semua Notifikasi
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
                
                
                
                

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

    <x-modal name="add-user-modal">
        <div style="padding: 2.5rem">
            <h2 style="font-weight: bold" class="text-2xl mb-6">Tambah Pengguna</h2>
            <form method="POST" action="{{ route('users.store') }}" class="flex flex-col gap-4">
                @csrf
        
                <!-- name -->
                <div>
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
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
                        <option value="" disabled selected>Pilih Role</option>
                            <option value="customer">
                                Customer
                            </option>
                            <option value="admin">
                                Admin
                            </option>
                            <option value="employee">
                                Karyawan
                            </option>
                    </select>
                    <x-input-error :messages="$errors->get('branch_id')" class="mt-2" />
                </div>

                <!-- province -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- province -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" :value="old('password')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- address -->
                <div>
                    <x-input-label for="balance" :value="__('Saldo')" />
                    <x-text-input id="balance" class="block mt-1 w-full" type="number" name="balance" :value="old('balance')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('balance')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end mt-4 gap-2">
                    <x-danger-button class="ms-3" type="button"
                    @click="$dispatch('close-modal', 'add-user-modal')"
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
        @if(session('error'))
            <script>
                alert('{{ session('error') }}');
            </script>
        @endif
        @if(session('success'))
            <script>
                alert('{{ session('success') }}');
            </script>
        @endif
        <script>
            function notificationHandler() {
    return {
        notifications: [],
        unreadCount: 0,
        showModal: false,

        // Fetch unread notifications
        async fetchNotifications() {
            try {
                const response = await fetch('/notifications/unread');
                if (response.ok) {
                    const data = await response.json();
                    this.notifications = data;
                    this.unreadCount = data.length;
                } else {
                    console.error('Failed to fetch notifications');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        },

        // Mark notification as read
        async markAsRead(notificationId) {
            try {
                const response = await fetch(`/notifications/${notificationId}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                });
                if (response.ok) {
                    // Remove the notification from the list
                    this.notifications = this.notifications.filter(
                        (notification) => notification.id !== notificationId
                    );
                    this.unreadCount--;
                } else {
                    console.error('Failed to mark notification as read');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        },

        // Polling to fetch notifications every 5 seconds
        startPolling() {
            this.fetchNotifications();
            setInterval(() => {
                this.fetchNotifications();
            }, 2000); // Poll every 5 seconds
        },
    };
}
        </script>

    </x-modal>
      
    
</nav>
