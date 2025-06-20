<?php
include 'koneksi.php';
$id = $_GET['id'] ? $_GET['id'] : "";
$sql = mysqli_query($koneksi, "SELECT * FROM ukm_band WHERE id='$id'");
$row = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Edit Data UKM Band</title>
    
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/edit.css">
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
                <li><a href="#">PRAMUKA</a></li>
            </ul>
        </div>
    </header>

    <div class="main-container">
        <!-- Edit Form Card -->
        <div class="card">
            <div class="card-header">
                ✏️ EDIT DATA UKM BAND
            </div>
            <div class="card-body">
                <!-- Form for editing data -->
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_band">🎵 Nama Band:</label>
                                <input type="text" name="nama_band" class="form-control" placeholder="Masukkan nama band" value="<?php echo htmlspecialchars($row['nama_band']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ketua_band">👨‍🎤 Ketua Band:</label>
                                <input type="text" name="ketua_band" class="form-control" placeholder="Masukkan nama ketua band" value="<?php echo htmlspecialchars($row['ketua_band']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah_anggota">👥 Jumlah Anggota:</label>
                                <input type="number" name="jumlah_anggota" class="form-control" placeholder="Masukkan jumlah anggota" min="1" value="<?php echo htmlspecialchars($row['jumlah_anggota']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="genre">🎶 Genre:</label>
                                <input type="text" name="genre" class="form-control" placeholder="Masukkan genre musik" value="<?php echo htmlspecialchars($row['genre']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tanggal_terbentuk">📅 Tanggal Terbentuk:</label>
                                <input type="date" name="tanggal_terbentuk" class="form-control" value="<?php echo htmlspecialchars($row['tanggal_terbentuk']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">
                            💾 Update Data
                        </button>
                        <a href="ukm_band.php" class="btn btn-secondary">
                            🔙 Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $nama_band = mysqli_real_escape_string($koneksi, $_POST['nama_band']);
            $ketua_band = mysqli_real_escape_string($koneksi, $_POST['ketua_band']);
            $jumlah_anggota = mysqli_real_escape_string($koneksi, $_POST['jumlah_anggota']);
            $genre = mysqli_real_escape_string($koneksi, $_POST['genre']);
            $tanggal_terbentuk = mysqli_real_escape_string($koneksi, $_POST['tanggal_terbentuk']);
            
            $update = mysqli_query($koneksi, "UPDATE ukm_band SET 
                nama_band='$nama_band',
                ketua_band='$ketua_band',
                jumlah_anggota='$jumlah_anggota',
                genre='$genre',
                tanggal_terbentuk='$tanggal_terbentuk' 
                WHERE id='$id'");
                
            if ($update) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data UKM Band telah berhasil diupdate.
                      </div>';
                echo "<meta http-equiv='refresh' content='2; url=ukm_band.php'>";
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
                🎸 DATA UKM BAND
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Band</th>
                                <th>Ketua Band</th>
                                <th>Jumlah Anggota</th>
                                <th>Genre</th>
                                <th>Tanggal Terbentuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all records from the database
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM ukm_band ORDER BY id DESC");
                            
                            if(mysqli_num_rows($tampil) > 0) {
                                while ($data = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo htmlspecialchars($data['nama_band']); ?></td>
                                    <td><?php echo htmlspecialchars($data['ketua_band']); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-success"><?php echo htmlspecialchars($data['jumlah_anggota']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($data['genre']); ?></td>
                                    <td class="text-center"><?php echo date('d/m/Y', strtotime($data['tanggal_terbentuk'])); ?></td>
                                    <td class="text-center">
                                        <a href="edit_ukm_band.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm me-1">
                                            ✏️ Edit
                                        </a>
                                        <a href="delete_ukm_band.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data UKM Band ini?')">
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
                                            <h5>🎸 Belum ada data UKM Band</h5>
                                            <p class="text-muted">Silakan tambahkan data UKM Band baru menggunakan form di atas.</p>
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