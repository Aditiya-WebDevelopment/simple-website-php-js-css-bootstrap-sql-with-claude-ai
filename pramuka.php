<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Data Pendaftaran Pramuka</title>
    
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
                🏕️ FORM DATA PENDAFTARAN PRAMUKA
            </div>
            <div class="card-body">
                <!-- Form for inputting data -->
                <form action="pramuka.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_anggota">👤 Nama Anggota:</label>
                                <input type="text" name="nama_anggota" class="form-control" placeholder="Masukkan nama lengkap anggota" required>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tingkatan">⭐ Tingkatan:</label>
                                <select name="tingkatan" class="form-control" required>
                                    <option value="">Pilih Tingkatan</option>
                                    <option value="Siaga">Siaga</option>
                                    <option value="Penggalang">Penggalang</option>
                                    <option value="Penegak">Penegak</option>
                                    <option value="Pandega">Pandega</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">👥 Jabatan:</label>
                                <input type="text" name="jabatan" class="form-control" placeholder="Masukkan jabatan dalam pramuka">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_bergabung">📅 Tanggal Bergabung:</label>
                                <input type="date" name="tgl_bergabung" class="form-control" required>
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
            $nama_anggota = mysqli_real_escape_string($koneksi, $_POST['nama_anggota']);
            $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
            $tingkatan = mysqli_real_escape_string($koneksi, $_POST['tingkatan']);
            $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
            $tgl_bergabung = mysqli_real_escape_string($koneksi, $_POST['tgl_bergabung']);

            // Insert data into the database
            $query = "INSERT INTO pramuka (nama_anggota, npm, tingkatan, jabatan, tgl_bergabung) VALUES ('$nama_anggota', '$npm', '$tingkatan', '$jabatan', '$tgl_bergabung')";
            
            if(mysqli_query($koneksi, $query)) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data pendaftaran Pramuka telah tersimpan.
                      </div>';
                // Refresh the page after 2 seconds
                echo "<meta http-equiv='refresh' content='2; url=pramuka.php'>";
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
                📊 DATA PENDAFTARAN PRAMUKA
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Anggota</th>
                                <th>NPM</th>
                                <th>Tingkatan</th>
                                <th>Jabatan</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all records from the database
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM pramuka ORDER BY id DESC");
                            
                            if(mysqli_num_rows($tampil) > 0) {
                                while ($row = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-info"><?php echo htmlspecialchars($row['id']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['nama_anggota']); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($row['npm']); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning"><?php echo htmlspecialchars($row['tingkatan']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($row['tgl_bergabung'])); ?></td>
                                    <td class="text-center">
                                        <a href="edit_pramuka.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm me-1">
                                            ✏️ Edit
                                        </a>
                                        <a href="delete_pramuka.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran Pramuka ini?')">
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
                                            <h5>🏕️ Belum ada data pendaftaran Pramuka</h5>
                                            <p class="text-muted">Silakan tambahkan data pendaftaran Pramuka baru menggunakan form di atas.</p>
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