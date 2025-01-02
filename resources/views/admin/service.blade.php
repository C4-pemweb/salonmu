<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Layanan di Cabang: {{ $branch->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style="padding: 2.5rem; flex-wrap: wrap; width: fit-content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex gap-6 mx-auto">
                @forelse ($services as $service)
                <div style="width: 20rem;" class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Cover Image -->
                    <img
                        style="height: 10rem" 
                        src="{{ $service->img_url }}" 
                        alt="Cover {{ $service->name }}" 
                        class="w-full object-cover"
                    />

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

            </div>
        </div>
    </div>
</x-app-layout>
