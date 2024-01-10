<?php
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'data_mahasiswa';

$conn = new mysqli($localhost, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function sanitize($data)
{
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_to_update = sanitize($_POST['id']);
    $new_title = sanitize($_POST['title']);
    $new_author = sanitize($_POST['author']);
    $new_publish_year = sanitize($_POST['published_year']);
    $new_isbn = sanitize($_POST['isbn']);

    $update_query = "UPDATE perpustakaan SET title = '$new_title', author = '$new_author', published_year = '$new_publish_year', isbn = '$new_isbn' WHERE id = '$id_to_update'";
    $conn->query($update_query);

    header("Location: lihat_database.php");
    exit();
}

$stmt = $conn->prepare("SELECT id, title, author, published_year, isbn FROM perpustakaan WHERE id = ?");
$stmt->bind_param("i", $id);

$id = // Atur nilai id;

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Proses data
}

$stmt->close();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $edit_id = $row['id'];
    $edit_title = $row['title'];
    $edit_author = $row['author'];
    $edit_published_year = $row['published_year'];
    $edit_isbn = $row['isbn'];
} else {
    echo "Data tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data - perpustakaan</title>
    <style>
        /* ... (gaya CSS tetap sama) ... */
    </style>
</head>

<body>

    <header>
        <h1>MANAJEMEN BUKU</h1>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="lihat_database.php">Lihat Database</a>
        <a href="tambah_database.php">Tambah Database Baru</a>
    </nav>

    <section>
        <h2>Formulir Edit Data Buku</h2>
        <form method="post" action="">
            <!-- ... (formulir HTML tetap sama) ... -->
        </form>
    </section>

    <footer>
        <p> &copy; 2024 Manajemen Buku </p>
    </footer>

</body>
</html>
