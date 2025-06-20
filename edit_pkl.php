<?php
include 'koneksi.php';
$id = $_GET['id'] ? $_GET['id'] : "";
$sql = mysqli_query($koneksi, "SELECT * FROM pendaftaran_pkl WHERE id='$id'");
$row = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Edit Data Pendaftaran PKL</title>
    
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
                ✏️ EDIT DATA PENDAFTARAN PKL
            </div>
            <div class="card-body">
                <!-- Form for editing data -->
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_mahasiswa">👤 Nama Mahasiswa:</label>
                                <input type="text" name="nama_mahasiswa" class="form-control" placeholder="Masukkan nama lengkap mahasiswa" value="<?php echo htmlspecialchars($row['nama_mahasiswa']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="npm">🔢 NPM:</label>
                                <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM mahasiswa" value="<?php echo htmlspecialchars($row['npm']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="instansi">🏢 Instansi:</label>
                                <input type="text" name="instansi" class="form-control" placeholder="Masukkan nama instansi/perusahaan tempat PKL" value="<?php echo htmlspecialchars($row['instansi']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_mulai">📅 Tanggal Mulai:</label>
                                <input type="date" name="tgl_mulai" class="form-control" value="<?php echo htmlspecialchars($row['tgl_mulai']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_selesai">📅 Tanggal Selesai:</label>
                                <input type="date" name="tgl_selesai" class="form-control" value="<?php echo htmlspecialchars($row['tgl_selesai']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">
                            💾 Update Data
                        </button>
                        <a href="pendaftaran_pkl.php" class="btn btn-secondary">
                            🔙 Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $nama_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['nama_mahasiswa']);
            $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
            $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi']);
            $tgl_mulai = mysqli_real_escape_string($koneksi, $_POST['tgl_mulai']);
            $tgl_selesai = mysqli_real_escape_string($koneksi, $_POST['tgl_selesai']);
            
            $update = mysqli_query($koneksi, "UPDATE pendaftaran_pkl SET 
                nama_mahasiswa='$nama_mahasiswa',
                npm='$npm',
                instansi='$instansi',
                tgl_mulai='$tgl_mulai',
                tgl_selesai='$tgl_selesai' 
                WHERE id='$id'");
                
            if ($update) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data pendaftaran PKL telah berhasil diupdate.
                      </div>';
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
                                while ($data = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-info"><?php echo htmlspecialchars($data['id']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($data['nama_mahasiswa']); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($data['npm']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($data['instansi']); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-success"><?php echo date('d-m-Y', strtotime($data['tgl_mulai'])); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning"><?php echo date('d-m-Y', strtotime($data['tgl_selesai'])); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit_pkl.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm me-1">
                                            ✏️ Edit
                                        </a>
                                        <a href="delete_pkl.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" 
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
                                            <p class="text-muted">Silakan tambahkan data pendaftaran PKL baru.</p>
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