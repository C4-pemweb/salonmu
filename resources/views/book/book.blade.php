<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon MU - Reservasi</title>
    <style>
        /* Warna dan latar belakang sesuai foto */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #0f172a; /* Navy gelap */
            color: #ffffff; /* Putih */
        }
        header {
            text-align: center;
            padding: 20px;
            color: #ff7f7f; /* Merah muda sesuai gambar */
            font-size: 2.5rem;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            background-color: #1e293b; /* Warna kotak lebih terang */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }
        .card p {
            color: #f8fafc; /* Putih */
            font-size: 1.2rem;
        }
        button {
            background-color: #ff7f7f; /* Tombol merah muda */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #ff4d4d; /* Warna lebih cerah saat hover */
        }
    </style>
</head>
<body>
    <header>
        Reservasi
    </header>
    <div class="container">
        <div class="card">
            <p>You're logged in!</p>
            <button>Book Now</button>
        </div>
    </div>
</body>
</html>

</x-app-layout>
