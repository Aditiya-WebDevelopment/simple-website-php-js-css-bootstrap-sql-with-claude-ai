<?php
// Include database connection
include "koneksi.php";

// Check if ID parameter exists
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Delete query
    $query = "DELETE FROM pendaftaran_pkl WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        // Success - redirect back to data_pendaftar.php with success message
        echo "<script>
                alert('Data PKL berhasil dihapus!');
                window.location.href = 'pendaftaran_pkl.php';
              </script>";
    } else {
        // Error - redirect back with error message
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = 'pendaftaran_pkl.php';
              </script>";
    }
} else {
    // No ID parameter - redirect back
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'pendaftaran_pkl.php';
          </script>";
}

// Close database connection
mysqli_close($koneksi);
?>