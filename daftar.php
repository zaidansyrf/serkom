<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <header style="top:0px; left:0; position:sticky; max-width: 90%; padding: 20px 0; margin: 20px auto; border-radius: 20px; border: 1px solid #444444;">
    <span style="color: black; font-weight: bold; font-size: 20px; position: absolute; left: 0; padding-left: 30px; margin-top:15px;">KampuskuAja</span>  
    <nav class="navbar navbar-expand-lg navbar-light" style="display: flex; justify-content: space-between; align-items: center;">  
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link" onclick="location.href='index.php'" style="color:black;">Pilihan Beasiswa</button>
                </li>
                <li class="nav-item" style="background: #444444; border-radius: 10px;">
                    <button class="nav-link" onclick="location.href='daftar.php'" style="color:white;">Daftar</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" onclick="location.href='hasil.php'" style="color:black;">Hasil</button>
                </li>
            </ul>
        </div>
    </nav>
</header>


    <!-- Form Pendaftaran -->
    <div class="container" style="border:10px;  border: 1px solid #444444;">
    <h2 class="text-center mt-4 font-weight-bold" style="font-family: Arial, Helvetica, sans-serif; padding: 40px; font-size: xx-large;">Daftar Beasiswa</h2>
        <section id="daftar">
            <form id="registrasiForm" enctype="multipart/form-data" method="POST" action="proses_daftar.php">
                <div class="form-group">
                    <label for="nama">Masukkan Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="email">Masukkan Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="hp">Nomor HP:</label>
                    <input type="text" class="form-control" id="hp" name="hp" required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester Saat Ini:</label>
                    <select class="form-control" id="semester" name="semester" required>
                        <?php
                        for ($i = 1; $i <= 8; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ipk">IPK Terakhir:</label>
                    <input type="text" class="form-control" id="ipk" name="ipk" readonly>
                </div>

                <div class="form-group">
                    <label for="beasiswa">Pilihan Beasiswa:</label>
                    <select class="form-control" id="beasiswa" name="beasiswa" required>
                        <option value="" disabled selected>Pilih Beasiswa</option>
                        <option value="non-akademik">Beasiswa Non-Akademik</option>
                        <option value="akademik">Beasiswa Akademik</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="berkas">Upload Berkas Syarat:</label>
                    <input type="file" class="form-control-file" id="berkas" name="berkas" accept=".pdf" required>
                </div>

                <div class="button-container text-center">
                    <button type="submit" class="btn btn-primary" id="daftarBtn">Daftar</button>
                    <button type="reset" class="btn btn-secondary" id="batalBtn">Batal</button>
                </div>
            </form>
        </section>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3" style="color:black;">
        <p>&copy; 2024 kampuskuaja.ac.id</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // Array IPK berdasarkan semester
    const ipkSemester = {
        1: 3.2,
        2: 4.0,
        3: 2.0,
        4: 2.2,
        5: 3.4,
        6: 0.2,
        7: 1.5,
        8: 4.0,
    };

    // Fungsi untuk menetapkan IPK berdasarkan semester yang dipilih
    function setIPK() {
        const semester = document.getElementById('semester').value;
        const ipk = ipkSemester[semester] || 0.0; // Ambil IPK dari array atau default 0.0
        document.getElementById('ipk').value = ipk.toFixed(2); // Tetapkan nilai IPK
        
        // Atur pilihan beasiswa dan upload berkas
        const beasiswaSelect = document.getElementById('beasiswa');
        const berkasInput = document.getElementById('berkas');

        if (ipk < 3.0) {
            beasiswaSelect.value = ''; // Tidak ada pilihan
            beasiswaSelect.disabled = true;
            berkasInput.disabled = true;
        } else if (ipk >= 3.0 && ipk <= 3.4) {
            beasiswaSelect.value = "non-akademik"; // Pilihan Non-Akademik
            beasiswaSelect.disabled = false;
            berkasInput.disabled = false;
        } else if (ipk > 3.4) {
            beasiswaSelect.value = "akademik"; // Pilihan Akademik
            beasiswaSelect.disabled = false;
            berkasInput.disabled = false;
        }
    }

    // Panggil fungsi saat semester berubah
    document.getElementById('semester').addEventListener('change', setIPK);

    // Panggil fungsi saat halaman dimuat
    window.onload = setIPK;

    // Memastikan elemen tidak bisa diubah setelah form disubmit
    window.onload = function() {
        // Memeriksa status URL
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        
        if (status === 'success') {
            // Jika pendaftaran sukses, disable semua input
            document.getElementById('registrasiForm').querySelectorAll('input, select').forEach(function(element) {
                element.disabled = true;  // Disable semua input
            });
            // Pastikan Beasiswa tidak bisa diubah
            const beasiswaSelect = document.getElementById('beasiswa');
            beasiswaSelect.disabled = true; // Disable dropdown beasiswa
        }
    };
</script>

</body>
</html>