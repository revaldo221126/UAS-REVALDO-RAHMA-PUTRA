<?php
session_start();
include "../koneksi.php"; // Sertakan file koneksi ke database

// Cek apakah user sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login/logout.php");
    exit();
}

// Ambil data dari tabel siswa dan kegiatan
$siswa_query = "SELECT * FROM siswa";
$kegiatan_query = "SELECT * FROM kegiatan";

$siswa_result = mysqli_query($conn, $siswa_query);
$kegiatan_result = mysqli_query($conn, $kegiatan_query);

// Debugging: Cek apakah query berhasil
if (!$siswa_result) {
    die('Query gagal: ' . mysqli_error($conn));
}
if (!$kegiatan_result) {
    die('Query gagal: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-primary">Halaman Laporan</h2>
        
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" onclick="window.print()"><i class="fas fa-print"></i> Print Laporan</button>
            </div>
        </div>

        

        <!-- Tabel Daftar Kegiatan -->
        <h3 class="mt-5">Daftar Kegiatan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kegiatan</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Cek jika ada hasil dari query
                if (mysqli_num_rows($kegiatan_result) > 0) {
                    while ($row = mysqli_fetch_assoc($kegiatan_result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama_kegiatan']; ?></td>
                            <td><?php echo $row['deskripsi']; ?></td>
                        </tr>
                    <?php endwhile; 
                } else {
                    echo "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
