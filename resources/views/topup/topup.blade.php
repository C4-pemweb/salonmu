<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="background-color: #4CAF50; color: white; padding: 10px;">
            {{ __('Topup') }}
        </h2>
    </x-slot>

    <!-- Menambahkan CSS langsung di dalam file -->
    <style>
        /* Menambahkan latar belakang di latar belakang konten utama */
        .main-container {
            background-color: #e0f7fa; /* Latar belakang biru muda untuk seluruh konten */
            padding: 50px 0; /* Memberikan sedikit ruang di bagian atas dan bawah */
        }

        /* Gaya tombol Top-Up */
        .top-up-button {
            background-color: #3b82f6; /* Warna biru */
            color: white; /* Warna teks */
            padding: 10px 20px; /* Padding tombol */
            border-radius: 6px; /* Sudut melengkung */
            border: none; /* Hilangkan border */
            cursor: pointer; /* Ubah kursor jadi pointer */
            transition: background-color 0.3s ease; /* Efek transisi hover */
        }

        .top-up-button:hover {
            background-color: #2563eb; /* Warna biru lebih gelap saat hover */
        }

        /* Gaya tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Margin untuk histori */
        .mt-8 {
            margin-top: 2rem; /* Margin atas */
        }

        .pb-12 {
            padding-bottom: 3rem; /* Padding bawah */
        }
    </style>

    <!-- Menggunakan kelas main-container pada elemen pembungkus utama -->
    <div class="main-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-4">Top-Up Saldo</h2>
                <form id="topUpForm">
                    <label for="amount" class="block text-gray-700 font-medium mb-2">
                        Masukkan jumlah top-up (minimal Rp 10.000):
                    </label>
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
                        class="top-up-button">
                        Top Up
                    </button>
                </form>
            </div>

            <!-- Top-Up History -->
            <div class="w-full lg:w-1/2 bg-white shadow-md rounded-lg p-4 px-6 mt-8 pb-12">
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
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $history->created_at->format('d-m-Y H:i') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                Rp {{ number_format($history->amount, 0, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span class="px-2 py-1 rounded text-black {{ $history->status == 'sukses' ? 'bg-green-500' : ($history->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
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
</x-app-layout>
