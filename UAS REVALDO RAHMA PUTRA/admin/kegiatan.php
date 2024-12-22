<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login/logout.php");
    exit();
}

// Add new activity
if (isset($_POST['tambah'])) {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $deskripsi = $_POST['deskripsi'];
    
    $query = "INSERT INTO kegiatan (nama_kegiatan, deskripsi) VALUES ('$nama_kegiatan', '$deskripsi')";
    mysqli_query($conn, $query);
}

// Delete activity
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id = $id");
}

// Edit activity
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $deskripsi = $_POST['deskripsi'];
    
    $query = "UPDATE kegiatan SET nama_kegiatan = '$nama_kegiatan', deskripsi = '$deskripsi' WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: kegiatan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Ekstrakurikuler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-primary">Kelola Ekstrakurikuler</h2>

        <!-- Form for adding or editing activity -->
        <?php if (isset($_GET['edit'])): ?>
            <!-- Edit Form -->
            <h3>Edit Kegiatan</h3>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo $row['nama_kegiatan']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <textarea name="deskripsi" class="form-control" required><?php echo $row['deskripsi']; ?></textarea>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="update" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <!-- Add new activity form -->
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan" required>
                    </div>
                    <div class="col-md-6">
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" required></textarea>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                    </div>
                    <div class="col-md-2">
                    <a href="dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        <?php endif; ?>

        <!-- Display activities -->
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM kegiatan");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_kegiatan']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>
                            <a href='?edit={$row['id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                            <a href='?hapus={$row['id']}' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
