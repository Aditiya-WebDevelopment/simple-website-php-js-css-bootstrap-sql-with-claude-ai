<?php
// Include database connection
include "koneksi.php";

// Get ID from URL parameter
$id = $_GET['id'] ? $_GET['id'] : "";

if ($id != "") {
    // Delete query
    $delete = mysqli_query($koneksi, "DELETE FROM ukm_band WHERE id='$id'");
    
    if ($delete) {
        // Redirect back to main page with success message
        echo "<script>
                alert('Data UKM Band berhasil dihapus!');
                window.location.href = 'ukm_band.php';
              </script>";
    } else {
        // Redirect back with error message
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = 'ukm_band.php';
              </script>";
    }
} else {
    // If no ID provided, redirect back
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'ukm_band.php';
          </script>";
}
?>