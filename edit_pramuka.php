<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISKA - Edit Data Pramuka</title>
    
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
                <li><a href="pramuka.php">PRAMUKA</a></li>
            </ul>
        </div>
    </header>

    <div class="main-container">
        <?php
        // Include database connection
        include "koneksi.php";

        // Check if ID is provided
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> ID tidak ditemukan. <a href="pramuka.php">Kembali ke halaman Pramuka</a>
                  </div>';
            exit;
        }

        $id = mysqli_real_escape_string($koneksi, $_GET['id']);

        // Fetch existing data
        $query = "SELECT * FROM pramuka WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Data tidak ditemukan. <a href="pramuka.php">Kembali ke halaman Pramuka</a>
                  </div>';
            exit;
        }

        $data = mysqli_fetch_array($result);

        // Process form submission
        if (isset($_POST['submit'])) {
            $nama_anggota = mysqli_real_escape_string($koneksi, $_POST['nama_anggota']);
            $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
            $tingkatan = mysqli_real_escape_string($koneksi, $_POST['tingkatan']);
            $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
            $tgl_bergabung = mysqli_real_escape_string($koneksi, $_POST['tgl_bergabung']);

            // Update data in the database
            $update_query = "UPDATE pramuka SET 
                            nama_anggota = '$nama_anggota', 
                            npm = '$npm', 
                            tingkatan = '$tingkatan', 
                            jabatan = '$jabatan', 
                            tgl_bergabung = '$tgl_bergabung' 
                            WHERE id = '$id'";
            
            if(mysqli_query($koneksi, $update_query)) {
                echo '<div class="alert alert-success mt-3" role="alert">
                        <strong>Berhasil!</strong> Data Pramuka telah diperbarui.
                      </div>';
                // Redirect to pramuka.php after 2 seconds
                echo "<meta http-equiv='refresh' content='2; url=pramuka.php'>";
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">
                        <strong>Error!</strong> ' . mysqli_error($koneksi) . '
                      </div>';
            }
        }
        ?>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                ✏️ EDIT DATA PRAMUKA
            </div>
            <div class="card-body">
                <!-- Form for editing data -->
                <form action="edit_pramuka.php?id=<?php echo $id; ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_anggota">👤 Nama Anggota:</label>
                                <input type="text" name="nama_anggota" class="form-control" 
                                       placeholder="Masukkan nama lengkap anggota" 
                                       value="<?php echo htmlspecialchars($data['nama_anggota']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="npm">🔢 NPM:</label>
                                <input type="text" name="npm" class="form-control" 
                                       placeholder="Masukkan NPM mahasiswa" 
                                       value="<?php echo htmlspecialchars($data['npm']); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tingkatan">⭐ Tingkatan:</label>
                                <select name="tingkatan" class="form-control" required>
                                    <option value="">Pilih Tingkatan</option>
                                    <option value="Siaga" <?php echo ($data['tingkatan'] == 'Siaga') ? 'selected' : ''; ?>>Siaga</option>
                                    <option value="Penggalang" <?php echo ($data['tingkatan'] == 'Penggalang') ? 'selected' : ''; ?>>Penggalang</option>
                                    <option value="Penegak" <?php echo ($data['tingkatan'] == 'Penegak') ? 'selected' : ''; ?>>Penegak</option>
                                    <option value="Pandega" <?php echo ($data['tingkatan'] == 'Pandega') ? 'selected' : ''; ?>>Pandega</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">👥 Jabatan:</label>
                                <input type="text" name="jabatan" class="form-control" 
                                       placeholder="Masukkan jabatan dalam pramuka" 
                                       value="<?php echo htmlspecialchars($data['jabatan']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_bergabung">📅 Tanggal Bergabung:</label>
                                <input type="date" name="tgl_bergabung" class="form-control" 
                                       value="<?php echo $data['tgl_bergabung']; ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">
                            💾 Update Data
                        </button>
                        <a href="pramuka.php" class="btn btn-secondary">
                            ↩️ Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Data Display Card -->
        <div class="card">
            <div class="card-header">
                📋 DATA SAAT INI
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> <span class="badge bg-info"><?php echo htmlspecialchars($data['id']); ?></span></p>
                        <p><strong>Nama Anggota:</strong> <?php echo htmlspecialchars($data['nama_anggota']); ?></p>
                        <p><strong>NPM:</strong> <span class="badge bg-secondary"><?php echo htmlspecialchars($data['npm']); ?></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tingkatan:</strong> <span class="badge bg-warning"><?php echo htmlspecialchars($data['tingkatan']); ?></span></p>
                        <p><strong>Jabatan:</strong> <?php echo htmlspecialchars($data['jabatan']); ?></p>
                        <p><strong>Tanggal Bergabung:</strong> <?php echo date('d-m-Y', strtotime($data['tgl_bergabung'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>