<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login/logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Link ke CDN Bootstrap dan Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Add custom styles for animation */
        .animated-text {
            animation: fadeInUp 1s ease-in-out;
        }
        
        /* Slideshow styles */
        .carousel-item {
            height: 400px;
            background-color: #333;
            color: #fff;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-caption {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        /* Hover effect for buttons */
        .btn:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Revaldo title with animation -->
        <h1 class="text-center text-primary animated-text">Revaldo Rahma Putra 701230271</h1>
        <br><br>

        <!-- Dashboard Buttons -->
        <div class="row">
            <div class="col-md-3">
                <a href="siswa.php" class="btn btn-primary btn-lg w-100 mb-3"><i class="fas fa-users"></i> Kelola Siswa</a>
            </div>
            <div class="col-md-3">
                <a href="kegiatan.php" class="btn btn-primary btn-lg w-100 mb-3"><i class="fas fa-cogs"></i> Kelola Ekstrakurikuler</a>
            </div>
            <div class="col-md-3">
                <a href="laporan.php" class="btn btn-primary btn-lg w-100 mb-3"><i class="fas fa-print"></i> Cetak Laporan</a>
            </div>
            <div class="col-md-3">
                <a href="user.php" class="btn btn-primary btn-lg w-100 mb-3"><i class="fas fa-users-cog"></i> Kelola User</a>
            </div>
        </div>

        <!-- Logout button centered -->
        <div class="text-center mt-4">
            <a href="../login/logout.php" class="btn btn-danger btn-lg"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <!-- Greeting message with animation -->
        <div class="text-center mt-4 animated-text">
            <h3>Halo, disini kamu sebagai admin! Selamat datang!</h3>
        </div>

        <!-- Slideshow with animation -->
        <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/img/unduhan.jpeg" class="d-block w-100" alt="Image 1">
                    <div class="carousel-caption">
                        <h5>Welcome to the Admin Dashboard</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/OIP.jpeg" class="d-block w-100" alt="Image 2">
                    <div class="carousel-caption">
                        <h5>Manage Students and Activities</h5>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
