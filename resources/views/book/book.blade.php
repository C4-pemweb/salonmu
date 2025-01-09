<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ selectedBook: null, selectedReview: 'message' }">
            @if ($bookings->count() > 0)
                <div style="padding: 2.5rem; flex-wrap: wrap; width: fit-content" 
                     class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex gap-6 mx-auto">
                    @foreach ($bookings as $booking)
                        <div style="width: 20rem" 
                             class="bg-white shadow-md overflow-hidden flex-col rounded-lg flex items-start justify-between" 
                             x-data="{ open: false }">
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
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6">
                    <p class="text-gray-600 text-lg font-semibold">
                        {{ __('Tidak ada data reservasi yang ditemukan.') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
