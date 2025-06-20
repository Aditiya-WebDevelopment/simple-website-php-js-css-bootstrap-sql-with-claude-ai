<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Data Pendaftar</title>
    
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <!-- CSS -->
      <link rel="stylesheet" href="css/tambah.css">

</head>
<body>
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Header Navigation -->
    <header class="header-nav">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">U</div>
                <div class="logo-text">UNISKA</div>
            </div>
            
            <ul id="menu">
                <li><a href="index.php">HOME</a></li>
                <li><a href="data_pendaftar.php">PENDAFTARAN</a></li>
                <li><a href="jurusan.php">JURUSAN</a></li>
                <li><a href="jadwal.php">JADWAL</a></li>
                <li><a href="pendaftaran_pkl.php">PENDAFTARAN PKL</a></li>
                <li><a href="ukm_band.php">UKM BAND</a></li>
                <li><a href="pramuka.php">PRAMUKA</a></li>
            </ul>
        </div>
    </header>

    <div class="main-container">
        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                🎓 FORM PENDAFTARAN MAHASISWA BARU
            </div>
            <div class="card-body">
                <!-- Form for inputting data -->
                <form action="data_pendaftar.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">📝 Nama Lengkap:</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">📧 Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat">🏠 Alamat Lengkap:</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nilai">🏆 Nilai Rata-rata:</label>
                                <input type="number" step="0.01" name="nilai" class="form-control" placeholder="Contoh: 85.50" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telpon">📞 No. Telepon:</label>
                                <input type="text" name="telpon" class="form-control" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">
                            ✅ Daftar Sekarang
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            🔄 Reset Form
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        // Include database connection
        include "koneksi.php";

        if (isset($_POST['submit'])) {
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
            $nilai = mysqli_real_escape_string($koneksi, $_POST['nilai']);
            $email = mysqli_real_escape_string($koneksi, $_POST['email']);
            $telpon = mysqli_real_escape_string($koneksi, $_POST['telpon']);

            // Insert data into the database
            $query = "INSERT INTO pendaftaran (nama, alamat, nilai, email, telpon) VALUES ('$nama', '$alamat', '$nilai', '$email', '$telpon')";
            
            if(mysqli_query($koneksi, $query)) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data pendaftaran telah tersimpan.
                      </div>';
                // Refresh the page after 2 seconds
                echo "<meta http-equiv='refresh' content='2; url=data_pendaftar.php'>";
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">
                        <strong>Error!</strong> ' . mysqli_error($koneksi) . '
                      </div>';
            }
        }
        ?>

        <!-- Data Table Card -->
        <div class="card">
            <div class="card-header">
                📊 DATA PENDAFTAR MAHASISWA BARU
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Nilai</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all records from the database
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM pendaftaran ORDER BY id DESC");
                            
                            if(mysqli_num_rows($tampil) > 0) {
                                while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-success"><?php echo htmlspecialchars($row['nilai']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['telpon']); ?></td>
                                    <td class="text-center">
                                        <a href="edit_daftar.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm me-1">
                                            ✏️ Edit
                                        </a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            🗑️ Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                $no++; 
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="py-4">
                                            <h5>📋 Belum ada data pendaftar</h5>
                                            <p class="text-muted">Silakan tambahkan data pendaftar baru menggunakan form di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>