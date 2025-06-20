<?php
$koneksi = mysqli_connect("localhost", "root", "", "uniska");
if (mysqli_connect_error()) {
    echo "koneksi Gagal:" . mysqli_connect_error();
}
