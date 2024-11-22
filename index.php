<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Beasiswa</title>
  <link rel="stylesheet" href="styles.css">
  <style>
        /* CSS untuk mengubah warna navbar dan teks */
        .navbar {
            background-color: white; /* Mengubah warna navbar menjadi hitam */
        }
        .nav-item .nav-link {
            color: white; /* Mengubah warna teks navlist menjadi putih */
            padding: 10px 15px; /* Menambahkan padding untuk tampilan tombol */
            border: none; /* Menghilangkan border tombol */
            background-color: transparent; /* Menghilangkan latar belakang tombol */
        }
        .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Mengubah warna latar belakang saat hover */
        }
    </style>
</head>
<body style="background-color:#fffff5;">
  <!-- Navbar -->
  <header style="top:0; position:sticky; max-width: 90%; padding: 20px 0; margin: 20px auto; border-radius: 20px; border:10px; border: 1px solid #444444;">
    <nav class="navbar navbar-expand-lg navbar-light" style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Text "KampuskuAja" on the far left, adjusted to be before the navbar -->
        <span style="color: black; font-weight: bold; font-size: 20px; position: absolute; left: 0; padding-left: 30px;">KampuskuAja</span>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" style="background: #444444; border-radius: 10px;">
                    <button class="nav-link" onclick="location.href='index.php'" style="color:white; font-weight: bold;">Pilihan Beasiswa</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" onclick="location.href='daftar.php'" style="color:black; font-weight: bold;">Daftar</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" onclick="location.href='hasil.php'" style="color:black; font-weight: bold;">Hasil</button>
                </li>
            </ul>
        </div>
    </nav>
</header>

  <!-- Pilihan Beasiswa -->
   <div class="card" style="border:10px;  border: 1px solid #444444;">
  <section id="beasiswa">
    <h2>Pilihan Beasiswa</h2>
    <p>Berikut adalah ketentuan dan syarat untuk mendapatkan beasiswa:</p>
    <ul>
      <strong>Beasiswa Akademik:</strong> Minimal IPK 3.4
    </ul>
    <ul>
    <strong>Beasiswa Non-Akademik:</strong> Minimal IPK 3.0
    </ul>
  </section>
</div>

  <!-- Footer -->
  <footer style="text-align: center;  margin-top: 155px; padding: 10px; color:black;">
    <p>&copy; 2024 kampuskuaja.ac.id</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>