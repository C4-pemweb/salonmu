<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div  class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ selectedBook: null, selectedReview : 'message' }">
            <div style="padding: 2.5rem; flex-wrap: wrap; width: fit-content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex gap-6 mx-auto">
                @foreach ($bookings as $booking)
                <div style="width: 20rem" class="bg-white shadow-md overflow-hidden flex-col rounded-lg flex items-start justify-between" x-data="{ open: false }">
            <!-- Left Section: Info -->
        
            <div 
                style="
                    height: 10rem; 
                    background-image: url('{{ $booking->service->img_url }}'); 
                    background-size: cover; 
                    background-position: center;" 
                class="w-full relative rounded-t-lg flex justify-end p-2"
            ></div>
            <div class="p-4">
            <div class="flex items-center gap-2">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">
                        {{ $booking->service->branch->name }}
                    </h3>
                    <h3 class="text-lg font-semibold text-gray-700">
                        {{ $booking->service->name }}
                    </h3>
                </div>
            </div>
            <div class="text-sm text-gray-600">
                <p>Status: <span class="font-semibold">{{ ucfirst($booking->status) }}</span></p>
                <p>Tanggal: {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</p>
                <p>Waktu: {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}</p>
                <p>Karyawan: {{ $booking->employee->name }}</p>
                <p>Customer: {{ $booking->user->name }}</p>
            </div>
            <div>
                <div class="mt-4 flex gap-2">
                    @if (Auth::user()->role === 'customer')
                        <!-- Jika role customer dan statusnya pending -->
                        @if ($booking->status === 'pending')
                            <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}">
                                @csrf
                                <x-danger-button>
                                    {{ __('Batal') }}
                                </x-danger-button>
                            </form>
                        @elseif ($booking->status === 'selesai')
                            @if ($booking->review)
                                <x-primary-button
                                    x-on:click="selectedReview = {{ $booking->review }}; $dispatch('open-modal', 'edit-review-modal');"
                                >
                                    {{ __('Lihat Review') }}
                                </x-primary-button>
                            @else
                                <x-primary-button
                                    x-on:click="selectedBook = {{ $booking->id }}; $dispatch('open-modal', 'add-review-modal');"
                                >
                                    {{ __('Review') }}
                                </x-primary-button>
                            @endif
                        @endif
                    @else
                        <!-- Jika role selain customer -->
                        @if ($booking->status === 'pending')
                            <form method="POST" action="{{ route('bookings.accept', $booking->id) }}">
                                @csrf
                                <x-primary-button>
                                    {{ __('Terima') }}
                                </x-primary-button>
                            </form>
                            <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}">
                                @csrf
                                <x-danger-button>
                                    {{ __('Batal') }}
                                </x-danger-button>
                            </form>
                        @elseif ($booking->status === 'diterima')
                            <form method="POST" action="{{ route('bookings.complete', $booking->id) }}">
                                @csrf
                                <x-primary-button>
                                    {{ __('Selesai') }}
                                </x-primary-button>
                            </form>
                        @endif
                    @endif
                </div>                
            </div>
            </div>
            <x-modal name="add-review-modal">
                <div style="padding: 2.5rem" x-data="{
                    branch: window.selectedBranch || { name: '', province: '', city: '', address: '' },
                    init() {
                        this.branch = window.selectedBranch;
                    }
                }" x-init="init()">
                    <h2 style="font-weight: bold" class="text-2xl mb-6">Review</h2>
                    <form method="POST" action="{{ route('reviews.store') }}" class="flex flex-col gap-4">
                        @csrf
                    
                        <!-- Rating -->
                        <div x-data="{ rating: 0 }">
                            <x-input-label for="rating" :value="__('Rating')" />
                            <div class="flex gap-1">
                                <template x-for="i in 5" :key="i">
                                    <svg 
                                        :style="i <= rating ? 'fill: yellow;' : 'fill: none; stroke: gray;'" 
                                        class="h-6 w-6 cursor-pointer" 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        viewBox="0 0 24 24" 
                                        stroke="none"
                                        :stroke-width="i <= rating ? 2 : 1"
                                        @click="rating = i"
                                    >
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </template>
                            </div>
                            <input 
                                type="hidden" 
                                name="rate" 
                                :value="rating" 
                                x-model="rating" 
                                required
                            />
                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
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
                            />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    
                        <!-- Hidden Booking ID -->
                        <input type="hidden" name="booking_id" :value="selectedBook">
                    
                        <div class="flex items-center justify-end mt-4 gap-2">
                            <x-danger-button type="button" class="ms-3" @click="$dispatch('close-modal', 'add-review-modal')">
                                {{ __('Tutup') }}
                            </x-danger-button>
                            <x-primary-button class="ms-3" type="submit">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>                                        
                </div>
            </x-modal>
            <x-modal name="edit-review-modal">
                <div style="padding: 2.5rem" x-data="{
                    branch: window.selectedBranch || { name: '', province: '', city: '', address: '' },
                    init() {
                        this.branch = window.selectedBranch;
                    }
                }" x-init="init()">
                    <div class="flex justify-end">
                        <button @click="$dispatch('close-modal', 'edit-review-modal')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                        </button>
                    </div>
                    <h2 style="font-weight: bold" class="text-2xl mb-6">Review</h2>
                    <form method="POST" :action="`{{ route('reviews.update', '') }}/${selectedReview.id}`" class="flex flex-col gap-4">
                        @csrf
                        @method('PUT')
                        <!-- Rating -->
                        <div x-data="{ rating: selectedReview.rate || 0 }" x-init="rating = selectedReview.rate || 0">
                            <x-input-label for="rating" :value="__('Rating')" />
                            <div class="flex gap-1">
                                <template x-for="i in 5" :key="i">
                                    <svg 
                                        :style="i <= selectedReview.rate ? 'fill: yellow;' : 'fill: none; stroke: gray;'" 
                                        class="h-6 w-6 cursor-pointer" 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        viewBox="0 0 24 24" 
                                        stroke="none"
                                        @click="selectedReview.rate = i; selectedReview.rate = i"
                                    >
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </template>
                            </div>
                            <input 
                                type="hidden" 
                                name="rate"  
                                x-model="selectedReview.rate" 
                                required
                            />
                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                        </div>
                    
                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <x-text-input 
                                id="description" 
                                class="block mt-1 w-full" 
                                type="text" 
                                x-model="selectedReview.description"
                                name="description" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    
                        <div class="flex items-center justify-end mt-4 gap-2">
                            <x-primary-button class="ms-3" type="submit">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>                                        
                    <form method="POST" :action="`{{ route('reviews.destroy', '') }}/${selectedReview.id}`">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit" class="ms-3">
                            {{ __('Hapus') }}
                        </x-danger-button>
                    </form>
                </div>
            </x-modal>
    </div>
@endforeach   
            </div>
        </div>
    </div>
</x-app-layout>
