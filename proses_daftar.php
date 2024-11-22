<?php
include 'db.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $hp = $_POST["hp"];
    $semester = $_POST["semester"];
    $ipk = number_format((float)$_POST["ipk"], 2, '.', '');
    $beasiswa = $_POST["beasiswa"];
    $status_ajuan = "Belum Diverifikasi";

    // Log data input
    error_log("Debug: Data input diterima - Nama: $nama, Email: $email, Semester: $semester, IPK: $ipk, Beasiswa: $beasiswa");

    // Proses unggah file
    $berkas = $_FILES["berkas"]["name"];
    $target_dir = "upload/"; // Pastikan nama folder sesuai
    $target_file = $target_dir . basename($berkas);

    // Validasi ekstensi file
    $allowedExtensions = ['pdf'];
    $fileExtension = pathinfo($berkas, PATHINFO_EXTENSION);

    // Cek apakah ekstensi file diizinkan
    if (in_array($fileExtension, $allowedExtensions)) {
        // Coba unggah file ke folder
        if (move_uploaded_file($_FILES["berkas"]["tmp_name"], $target_file)) {
            error_log("Debug: File berhasil diunggah ke $target_file");

            // Siapkan query SQL untuk menyimpan data ke database
            $stmt = $conn->prepare("INSERT INTO registrasi (nama, email, hp, semester, ipk, beasiswa, berkas, status_ajuan) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiisss", $nama, $email, $hp, $semester, $ipk, $beasiswa, $berkas, $status_ajuan);

            // Eksekusi query
            if ($stmt->execute()) {
                error_log("Debug: Data berhasil disimpan ke database");
                header("Location: daftar.php?status=success");
                exit();
            } else {
                error_log("Database Error: " . $stmt->error);
                header("Location: daftar.php?status=error");
                exit();
            }
        } else {
            error_log("Error: Gagal mengunggah file ke folder $target_dir");
            header("Location: daftar.php?status=error_upload");
            exit();
        }
    } else {
        error_log("Error: Format file tidak valid ($fileExtension)");
        header("Location: daftar.php?status=invalid_file");
        exit();
    }
} else {
    error_log("Error: Akses ke proses_daftar.php tanpa metode POST");
    header("Location: daftar.php?status=error");
    exit();
}
?>
