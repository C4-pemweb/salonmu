<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEA Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1a1a2e; /* Warna latar belakang gelap */
            color: #fff; /* Warna teks putih */
        }

        nav {
            background-color: #1a1a2e;
        }

        nav .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        nav .nav-link {
            color: #fff;
            transition: color 0.3s;
        }

        nav .nav-link:hover {
            color: #ff6b6b;
        }

        .hero-section {
            text-align: center;
            padding: 80px 20px;
        }

        .hero-section {
        position: relative; /* Untuk mengatur posisi elemen di dalamnya */
        text-align: center;
        padding: 100px 20px; /* Perbesar padding untuk ruang yang lebih baik */
        color: #fff;
        background: url('https://your-image-url.jpg') no-repeat center center; /* Ganti dengan URL gambar latar belakang */
        background-size: cover; /* Pastikan gambar menutupi area */

        }

        .hero-section h1 {
            font-size: 4rem; /* Ukuran font lebih besar */
            color: #ff6b6b; /* Warna teks */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Menambahkan bayangan pada teks */
        }

        .hero-section p {
            font-size: 1.5rem;
            color: #f5f5f5;
            margin: 20px 0; /* Menambahkan jarak di atas dan bawah */
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Menambahkan bayangan pada teks */
        }

        .btn-primary {
            background-color: #ff6b6b;
            border: none;
            font-weight: bold;
            padding: 10px 20px; /* Tambahkan padding untuk tombol */
            border-radius: 25px; /* Membuat tombol lebih bulat */
            transition: background-color 0.3s, transform 0.3s; /* Tambahkan transisi untuk efek hover */
        }

        .btn-primary:hover {
            background-color: #ff4757; /* Ubah warna saat hover */
            transform: scale(1.05); /* Efek zoom saat hover */
        }


        .image-section {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .image-section img {
            border-radius: 20px;
            max-width: 100%;
            height: auto;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan */
            transition: transform 0.3s; /* Efek transisi saat hover */
        }

        .image-section img:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }


        /* About Us Section */
        .about-us {
            padding: 60px 20px;
            background-color: #0f0f1e; /* Warna latar belakang lebih gelap */
            text-align: center;
            margin-top: 40px;
        }

        .about-us h2 {
            font-size: 2.5rem;
            color: #ff6b6b;
            margin-bottom: 20px;
        }

        .about-us p {
            font-size: 1.2rem;
            color: #f5f5f5;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Footer */
        footer {
            background-color: #0f0f1e;
            padding: 20px 0;
            text-align: center;
            color: #ccc;
            font-size: 0.9rem;
            margin-top: 40px;
        }

        footer a {
            color: #ff6b6b;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #ff4757;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top"> <!-- Tambahkan sticky-top di sini -->
    <div class="container">
        <a class="navbar-brand" href="#">Salon MU</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary nav-link text-light" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Salon MU</h1>
        <p>Beauty and Elegance Redefined</p>
        <a href="#" class="btn btn-primary">Book Now</a>
    </div>


    <!-- Image Section -->
    <div class="image-section">
        <img src="https://static.dw.com/image/57034350_605.jpg" alt="Gambar 1">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRT1X3XNGdrAbAdcJBUqhuQWErBj2jtFkdXQ&s" alt="Gambar 2">
    </div>

    <!-- About Us Section -->
    <div class="about-us">
        <h2>About Us</h2>
        <p>
            Selamat datang di SEA Salon, tempat di mana kecantikan dan keanggunan didefinisikan ulang. 
            Kami berdedikasi untuk memberikan pelayanan terbaik dengan produk dan teknologi terkini. 
            Tim profesional kami siap membantu Anda tampil memukau di setiap momen. 
            Jadikan SEA Salon sebagai pilihan utama Anda untuk transformasi yang luar biasa.
        </p>
    </div>
    <!-- Map Section -->
    <div class="map-section" style="margin: 40px 0; text-align: center;">
        <h2>Lokasi Kami</h2>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.9083219487554!2d144.9630573156127!3d-37.81410797975159!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f0f9a17%3A0x50366df4342036a7!2sSEA%20Salon!5e0!3m2!1sen!2sid!4v1672567031962!5m2!1sen!2sid" 
            width="50%" 
            height="300"  <!-- Ubah tinggi peta di sini -->
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
    <!-- Contact Person Section -->
    <div class="contact-person" style="margin: 40px 0; text-align: center;">
        <h2>Contact Person</h2>
        <p>Jika Anda memiliki pertanyaan atau ingin melakukan pemesanan, silakan hubungi:</p>
        <p>
            <strong>Nama:</strong> John Doe<br>
            <strong>Telepon:</strong> +62 812 3456 7890<br>
            <strong>Email:</strong> johndoe@example.com
        </p>
    </div>


    <!-- Footer -->
    <footer>
        <p>&copy; 2025 SEA Salon. All rights reserved.</p>
        <p>
            Follow us on 
            <a href="#" target="_blank">Instagram</a>, 
            <a href="#" target="_blank">Facebook</a>, 
            and <a href="#" target="_blank">Twitter</a>.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
