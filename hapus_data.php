<?php
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'data_mahasiswa';

$conn = new mysqli($localhost, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID buku dari parameter URL
$delete_id = isset($_GET['id']) ? $_GET['id'] : '';

// Hapus buku dari database
$delete_query = $conn->prepare("DELETE FROM perpustakaan WHERE id = ?");
$delete_query->bind_param("i", $delete_id);

if ($delete_query->execute()) {
    // Redirect ke halaman lihat_database.php setelah menghapus
    header("Location: lihat_database.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
