<?php
include 'koneksi.php';
$id = $_GET['id'] ? $_GET['id'] : "";
$sql = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id='$id'");
$row = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Edit Data Jadwal</title>
    
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
                <li><a href="#">UKM BAND</a></li>
                <li><a href="#">PRAMUKA</a></li>
            </ul>
        </div>
    </header>

    <div class="main-container">
        <!-- Edit Form Card -->
        <div class="card">
            <div class="card-header">
                ✏️ EDIT DATA JADWAL
            </div>
            <div class="card-body">
                <!-- Form for editing data -->
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gedung">🏢 Gedung:</label>
                                <input type="text" name="gedung" class="form-control" placeholder="Masukkan nama gedung" value="<?php echo htmlspecialchars($row['gedung']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ruangan">🚪 Ruangan:</label>
                                <input type="text" name="ruangan" class="form-control" placeholder="Masukkan nomor ruangan" value="<?php echo htmlspecialchars($row['ruangan']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kendaraan">🚗 Kendaraan:</label>
                                <select name="kendaraan" class="form-select" required>
                                    <option value="">Pilih Jenis Kendaraan</option>
                                    <option value="Motor" <?php echo ($row['kendaraan'] == 'Motor') ? 'selected' : ''; ?>>🏍️ Motor</option>
                                    <option value="Mobil" <?php echo ($row['kendaraan'] == 'Mobil') ? 'selected' : ''; ?>>🚗 Mobil</option>
                                    <option value="Sepeda" <?php echo ($row['kendaraan'] == 'Sepeda') ? 'selected' : ''; ?>>🚲 Sepeda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">📅 Tanggal:</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu">⏰ Waktu:</label>
                                <input type="time" name="waktu" class="form-control" value="<?php echo htmlspecialchars($row['waktu']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">
                            💾 Update Data
                        </button>
                        <a href="jadwal.php" class="btn btn-secondary">
                            🔙 Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $gedung = mysqli_real_escape_string($koneksi, $_POST['gedung']);
            $ruangan = mysqli_real_escape_string($koneksi, $_POST['ruangan']);
            $kendaraan = mysqli_real_escape_string($koneksi, $_POST['kendaraan']);
            $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
            $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu']);
            
            $update = mysqli_query($koneksi, "UPDATE jadwal SET 
                gedung='$gedung',
                ruangan='$ruangan',
                kendaraan='$kendaraan',
                tanggal='$tanggal',
                waktu='$waktu' 
                WHERE id='$id'");
                
            if ($update) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data jadwal telah berhasil diupdate.
                      </div>';
                echo "<meta http-equiv='refresh' content='2; url=jadwal.php'>";
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
                📊 DATA JADWAL
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gedung</th>
                                <th>Ruangan</th>
                                <th>Kendaraan</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all records from the database
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY id DESC");
                            
                            if(mysqli_num_rows($tampil) > 0) {
                                while ($data = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo htmlspecialchars($data['gedung']); ?></td>
                                    <td><?php echo htmlspecialchars($data['ruangan']); ?></td>
                                    <td>
                                        <?php 
                                        $kendaraan = htmlspecialchars($data['kendaraan']);
                                        $icon = '';
                                        switch($kendaraan) {
                                            case 'Motor':
                                                $icon = '🏍️';
                                                break;
                                            case 'Mobil':
                                                $icon = '🚗';
                                                break;
                                            case 'Sepeda':
                                                $icon = '🚲';
                                                break;
                                            default:
                                                $icon = '🚗';
                                        }
                                        echo $icon . ' ' . $kendaraan;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info"><?php echo htmlspecialchars($data['tanggal']); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning"><?php echo htmlspecialchars($data['waktu']); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit_jadwal.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm me-1">
                                            ✏️ Edit
                                        </a>
                                        <a href="delete_jadwal.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data jadwal ini?')">
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
                                            <h5>📋 Belum ada data jadwal</h5>
                                            <p class="text-muted">Silakan tambahkan data jadwal baru.</p>
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