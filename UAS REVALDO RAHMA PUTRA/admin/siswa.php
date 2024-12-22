<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login/logout.php");
    exit();
}

// Add new student
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];

    if ($foto) {
        move_uploaded_file($tmp_name, "../assets/img/$foto");
        $query = "INSERT INTO siswa (nama, foto) VALUES ('$nama', '$foto')";
        mysqli_query($conn, $query);
    }
}

// Delete student
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
}

// Edit student
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];

    // Update only if new photo is uploaded
    if ($foto) {
        move_uploaded_file($tmp_name, "../assets/img/$foto");
        $query = "UPDATE siswa SET nama = '$nama', foto = '$foto' WHERE id = $id";
    } else {
        // Keep the existing photo if no new one is uploaded
        $query = "UPDATE siswa SET nama = '$nama' WHERE id = $id";
    }

    mysqli_query($conn, $query);
    header("Location: siswa.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-primary">Kelola Siswa</h2>

        <!-- Form for adding or editing student -->
        <?php if (isset($_GET['edit'])): ?>
            <!-- Edit Form -->
            <h3>Edit Siswa</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="foto" class="form-control">
                        <small>Current photo: <img src="../assets/img/<?php echo $row['foto']; ?>" width="50" alt="Current Photo"></small>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="update" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <!-- Add new student form -->
            <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Siswa" required>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

        <!-- Display students -->
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM siswa");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td><img src='../assets/img/{$row['foto']}' width='50'></td>
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
