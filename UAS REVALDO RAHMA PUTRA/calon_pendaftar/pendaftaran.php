<?php
session_start();
include "../koneksi.php"; // Koneksi ke database

// Proses pendaftaran
if (isset($_POST['daftar'])) {
    // Ambil data dari form
    $nama_siswa = $_POST['nama_siswa'];
    $alamat = $_POST['alamat'];
    $jurusan = $_POST['jurusan'];
    $tanggal_daftar = date('Y-m-d');  // Tanggal pendaftaran hari ini

    // Query untuk memasukkan data
    $query = "INSERT INTO pendaftaran (nama_siswa, alamat, jurusan, tanggal_daftar) 
              VALUES ('$nama_siswa', '$alamat', '$jurusan', '$tanggal_daftar')";

    // Mengeksekusi query dan memberi notifikasi
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href = 'pendaftaran.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat pendaftaran.');</script>";
    }
}

// Menampilkan data pendaftaran
$query = "SELECT * FROM pendaftaran";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran dan Tabel Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <!-- Form Pendaftaran -->
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="text-center text-primary">Pendaftaran Siswa</h2>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control" required>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="Bahasa">Bahasa</option>
                                </select>
                            </div>
                            <button type="submit" name="daftar" class="btn btn-primary w-100">Daftar</button>
                            <br><br>
                            <a href="dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Pendaftaran -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="text-center text-primary">Daftar Pendaftaran Siswa</h3>
                <?php
                // Cek jika ada data pendaftaran
                if (mysqli_num_rows($result) > 0) {
                    // Tampilkan data dalam tabel
                    echo "<table class='table table-bordered'>";
                    echo "<thead><tr><th>ID Pendaftaran</th><th>Nama Siswa</th><th>Alamat</th><th>Jurusan</th><th>Tanggal Daftar</th></tr></thead>";
                    echo "<tbody>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_pendaftaran'] . "</td>";
                        echo "<td>" . $row['nama_siswa'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['jurusan'] . "</td>";
                        echo "<td>" . $row['tanggal_daftar'] . "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "<p class='text-center'>Tidak ada data pendaftaran.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
