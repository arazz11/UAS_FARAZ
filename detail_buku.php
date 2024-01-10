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
$book_id = isset($_GET['id']) ? $_GET['id'] : '';

// Ambil data buku dari database berdasarkan ID
$query = "SELECT * FROM perpustakaan WHERE id = $book_id";
$result = $conn->query($query);

// Check jika data buku ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $detail_title = $row['title'];
    $detail_author = $row['author'];
    $detail_publish_year = $row['published_year'];
    $detail_isbn = $row['isbn'];
} else {
    // Jika buku tidak ditemukan, redirect ke halaman lihat_database.php
    header("Location: lihat_database.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - Perpustakaan King Araz__</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #007BFF; /* Warna biru */
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        footer {
            text-align: center;
            margin-top: auto;
        }

        section {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        p {
            margin-bottom: 16px;
            color: #555;
        }
    </style>
</head>

<body>

    <header>
        <h1>PERPUSTAKAAN King Araz__</h1>
    </header>

    <section>
        <h2>Detail Buku</h2>
        <label for="title">Judul:</label>
        <p><?php echo $detail_title; ?></p>

        <label for="author">Penulis:</label>
        <p><?php echo $detail_author; ?></p>

        <label for="publish_year">Tahun Terbit:</label>
        <p><?php echo $detail_publish_year; ?></p>

        <label for="isbn">ISBN:</label>
        <p><?php echo $detail_isbn; ?></p>
    </section>
    <nav>
    <footer>
        <p> &copy; 2024 Manajemen Buku </p>
    </footer>
    </nav>
</body>
</html>
