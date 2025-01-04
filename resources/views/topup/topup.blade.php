<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Topup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Top-Up Saldo</h2>
        <form id="topUpForm">
            <label for="amount" class="block text-gray-700 font-medium mb-2">Masukkan jumlah top-up (minimal Rp 10.000):</label>
            <input 
                type="number" 
                id="amount" 
                name="amount" 
                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 px-4 py-2 mb-4" 
                min="10000" 
                required 
            >
            <button 
                type="button" 
                onclick="submitTopUp()" 
                class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600">
                Top Up
            </button>
        </form>
    </div>

    <!-- Top-Up History -->
    <div class="w-full lg:w-1/2 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Histori Top-Up</h2>
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                    <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($histories as $history)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $history->created_at->format('d-m-Y H:i') }}</td>
                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($history->amount, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="px-2 py-1 rounded text-white {{ $history->status == 'sukses' ? 'bg-green-500' : ($history->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                            {{ $history->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">Belum ada histori top-up</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
