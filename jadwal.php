<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Data Jadwal</title>
    
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
                📅 FORM DATA JADWAL
            </div>
            <div class="card-body">
                <!-- Form for inputting data -->
                <form action="jadwal.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gedung">🏢 Gedung:</label>
                                <input type="text" name="gedung" class="form-control" placeholder="Masukkan nama gedung" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kendaraan">🚗 Kendaraan:</label>
                                <select name="kendaraan" class="form-control" required>
                                    <option value="">Pilih Kendaraan</option>
                                    <option value="Motor">🏍️ Motor</option>
                                    <option value="Mobil">🚗 Mobil</option>
                                    <option value="Sepeda">🚲 Sepeda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">📅 Tanggal:</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu">⏰ Waktu:</label>
                                <input type="time" name="waktu" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">
                            ✅ Simpan Data
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
            $gedung = mysqli_real_escape_string($koneksi, $_POST['gedung']);
            $kendaraan = mysqli_real_escape_string($koneksi, $_POST['kendaraan']);
            $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
            $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu']);

            // Insert data into the database
            $query = "INSERT INTO jadwal (gedung, kendaraan, tanggal, waktu) VALUES ('$gedung', '$kendaraan', '$tanggal', '$waktu')";
            
            if(mysqli_query($koneksi, $query)) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data jadwal telah tersimpan.
                      </div>';
                // Refresh the page after 2 seconds
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
                                <th>ID</th>
                                <th>Gedung</th>
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
                                while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-info"><?php echo htmlspecialchars($row['id']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['gedung']); ?></td>
                                    <td class="text-center">
                                        <?php 
                                        $kendaraan_icon = '';
                                        switch($row['kendaraan']) {
                                            case 'Motor':
                                                $kendaraan_icon = '🏍️';
                                                break;
                                            case 'Mobil':
                                                $kendaraan_icon = '🚗';
                                                break;
                                            case 'Sepeda':
                                                $kendaraan_icon = '🚲';
                                                break;
                                        }
                                        echo $kendaraan_icon . ' ' . htmlspecialchars($row['kendaraan']); 
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                    <td class="text-center"><?php echo date('H:i', strtotime($row['waktu'])); ?></td>
                                    <td class="text-center">
                                        <a href="edit_jadwal.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm me-1">
                                            ✏️ Edit
                                        </a>
                                        <a href="delete_jadwal.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
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
                                            <p class="text-muted">Silakan tambahkan data jadwal baru menggunakan form di atas.</p>
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