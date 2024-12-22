<?php
session_start();
include "../koneksi.php";

// Check if user is logged in and has 'pimpinan' role
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'pimpinan') {
    header("Location: ../login/login.php");
    exit();
}

// Fetch data for the report (student names, addresses, registration date, etc.)
$query = "SELECT * FROM pendaftaran";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendaftar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary mb-4">Laporan Pendaftar</h2>
        
        <!-- Report Details -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Pendaftar</h4>
                <p class="card-text">Berikut adalah daftar siswa yang telah mendaftar:</p>
                
                <!-- Student Table -->
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Alamat</th>
                            <th>Jurusan</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama_siswa']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <td><?php echo $row['jurusan']; ?></td>
                                <td><?php echo $row['tanggal_daftar']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Button to generate printable report -->
                <a href="javascript:window.print()" class="btn btn-success"><i class="fas fa-print"></i> Cetak Laporan</a>

            </div><a href="../login/login.php class= "btn btn-success></i> Kembali</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
