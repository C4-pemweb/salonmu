<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notification') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Pesan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .aksi button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .aksi button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Daftar Pesan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pesan</th>
                <th>Status</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Reservasi Anda untuk Hair Spa telah dikonfirmasi!</td>
                <td>Belum Dibaca</td>
                <td>10 menit lalu</td>
                <td class="aksi"><button>Tandai Dibaca</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Promo Potongan 20% untuk semua perawatan rambut akhir pekan ini!</td>
                <td>Dibaca</td>
                <td>1 jam lalu</td>
                <td class="aksi"><button>Selesai</button></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Pengingat: Janji temu Anda untuk Manicure besok pukul 10:00 AM.</td>
                <td>Belum Dibaca</td>
                <td>1 hari lalu</td>
                <td class="aksi"><button>Tandai Dibaca</button></td>
            </tr>
        </tbody>
    </table>
</body>
</html>

</x-app-layout>
