<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Data Pendaftaran PKL</title>
    
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
                📝 FORM DATA PENDAFTARAN PKL
            </div>
            <div class="card-body">
                <!-- Form for inputting data -->
                <form action="pendaftaran_pkl.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_mahasiswa">👤 Nama Mahasiswa:</label>
                                <input type="text" name="nama_mahasiswa" class="form-control" placeholder="Masukkan nama lengkap mahasiswa" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="npm">🔢 NPM:</label>
                                <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM mahasiswa" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="instansi">🏢 Instansi:</label>
                                <input type="text" name="instansi" class="form-control" placeholder="Masukkan nama instansi/perusahaan tempat PKL" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_mulai">📅 Tanggal Mulai:</label>
                                <input type="date" name="tgl_mulai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_selesai">📅 Tanggal Selesai:</label>
                                <input type="date" name="tgl_selesai" class="form-control" required>
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
            $nama_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['nama_mahasiswa']);
            $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
            $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi']);
            $tgl_mulai = mysqli_real_escape_string($koneksi, $_POST['tgl_mulai']);
            $tgl_selesai = mysqli_real_escape_string($koneksi, $_POST['tgl_selesai']);

            // Insert data into the database
            $query = "INSERT INTO pendaftaran_pkl (nama_mahasiswa, npm, instansi, tgl_mulai, tgl_selesai) VALUES ('$nama_mahasiswa', '$npm', '$instansi', '$tgl_mulai', '$tgl_selesai')";
            
            if(mysqli_query($koneksi, $query)) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data pendaftaran PKL telah tersimpan.
                      </div>';
                // Refresh the page after 2 seconds
                echo "<meta http-equiv='refresh' content='2; url=pendaftaran_pkl.php'>";
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
                📊 DATA PENDAFTARAN PKL
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th>Instansi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all records from the database
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM pendaftaran_pkl ORDER BY id DESC");
                            
                            if(mysqli_num_rows($tampil) > 0) {
                                while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-info"><?php echo htmlspecialchars($row['id']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($row['npm']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['instansi']); ?></td>
                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($row['tgl_mulai'])); ?></td>
                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($row['tgl_selesai'])); ?></td>
                                    <td class="text-center">
                                        <a href="edit_pkl.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm me-1">
                                            ✏️ Edit
                                        </a>
                                        <a href="delete_pkl.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran PKL ini?')">
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
                                    <td colspan="8" class="text-center">
                                        <div class="py-4">
                                            <h5>📋 Belum ada data pendaftaran PKL</h5>
                                            <p class="text-muted">Silakan tambahkan data pendaftaran PKL baru menggunakan form di atas.</p>
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