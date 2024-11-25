<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS untuk navbar */
        .navbar {
            background-color: white;
        }
        .nav-item .nav-link {
            color: white;
            padding: 10px 15px;
            border: 1px;
            background-color: transparent;
        }
        .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .container {
            display: table; /* Mengatur container seperti elemen tabel */
            margin: 20px auto; /* Memusatkan container secara horizontal */
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow-x: auto; /* Tambahan untuk scroll jika tabel sangat besar */
        }

        table {
            width: auto; /* Membiarkan tabel menentukan lebarnya sendiri */
            border-collapse: collapse;
            margin: 0; /* Tidak ada margin tambahan pada tabel */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Chart styling */
        .chart-container {
            width: 400px;
            height: 300px;
            margin: 20px auto;
        }
        h3{
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-color:#fffff4;">
    <!-- Navbar -->
    <header style="top:0; position:sticky; max-width: 90%; padding: 20px 0; margin: 20px auto; border-radius: 20px; border:10px; border: 1px solid #444444;">
    <nav class="navbar navbar-expand-lg navbar-light" style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Text "KampuskuAja" on the far left, adjusted to be before the navbar -->
        <span style="color: black; font-weight: bold; font-size: 20px; position: absolute; left: 0; padding-left: 30px;">KampuskuAja.</span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button class="nav-link" onclick="location.href='index.php'" style="color:black; font-weight: bold;">Pilihan Beasiswa</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" onclick="location.href='daftar.php'" style="color:black; font-weight: bold;">Daftar</button>
                    </li>
                    <li class="nav-item" style="background: #444444; border-radius: 10px;">
                        <button class="nav-link" onclick="location.href='hasil.php'" style="color:white; font-weight: bold;">Hasil</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <!-- Container -->
    <div class="container" style="border:10px;  border: 1px solid #444444;">
        <?php
        include 'db.php';

        // Ambil data registrasi untuk tabel
        $result = mysqli_query($conn, "SELECT * FROM registrasi");

        echo "<h2>Hasil Registrasi</h2>";
        echo "<table>
        <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Nomor HP</th>
        <th>Semester</th>
        <th>IPK</th>
        <th>Beasiswa</th>
        <th>Berkas</th>
        <th>Status Ajuan</th>
        </tr>";

        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            $filePath = 'upload/' . $row['berkas'];
            echo "<tr>

            <td>" . $no++ . "</td>
            <td>{$row['nama']}</td>
            <td>{$row['email']}</td>
            <td>{$row['hp']}</td>
            <td>{$row['semester']}</td>
            <td>{$row['ipk']}</td>
            <td>{$row['beasiswa']}</td>
        <td><a href='$filePath' download='{$row['berkas']}'>Unduh Berkas</a></td>
            <td>{$row['status_ajuan']}</td>
            </tr>";
        }
        echo "</table>";

        // Hitung distribusi IPK
        $ipkRanges = [
            "3.0 - 3.4" => 0,
            "3.5 - 4.0" => 0,
        ];

        $result = mysqli_query($conn, "SELECT ipk FROM registrasi");
        while ($row = mysqli_fetch_assoc($result)) {
            $ipk = (float)$row['ipk'];
            if ($ipk >= 3.0 && $ipk <= 3.4) {
                $ipkRanges["3.0 - 3.4"]++;
            } elseif ($ipk >= 3.5 && $ipk <= 4.0) {
                $ipkRanges["3.5 - 4.0"]++;
            }
        }
        // Encode data untuk digunakan oleh Chart.js
        $ipkData = json_encode(array_values($ipkRanges));
        $ipkLabels = json_encode(array_keys($ipkRanges));
        ?>
        <h3>Grafik IPK</h3>
        <!-- Chart JS Pie Chart -->
        <div class="chart-container">
            <canvas id="ipkChart"></canvas>
        </div>

    </div>

    <!-- Footer -->
    <footer style="text-align: center; margin-top: 50px; padding: 10px;">
        <p>&copy; 2024 kampuskuaja.ac.id</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk Chart.js
        const ipkData = <?php echo $ipkData; ?>;
        const ipkLabels = <?php echo $ipkLabels; ?>;

        // Buat grafik Pie Chart
        const ctx = document.getElementById('ipkChart').getContext('2d');
        const ipkChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ipkLabels,
                datasets: [{
                    label: 'Distribusi IPK',
                    data: ipkData,
                    backgroundColor: ['#FFC107', '#ff6384'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
            }
        });
    </script>
</body>
</html>
