<?php
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'data_mahasiswa';

$conn = new mysqli($localhost, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$query = "SELECT id, title, author, published_year, isbn FROM perpustakaan";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANAJEMEN BUKU</title>

    <style>
        body {
            font-family: 'times new roman', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #007BFF; /* Warna biru */
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        footer {
            text-align: center;
            margin-top: auto;
        }

        nav {
            background-color: #0056b3; /* Warna biru tua */
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #003366; /* Warna biru gelap saat hover */
            color: black;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #cce5ff; /* Warna biru muda */
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .edit-button, .hapus-button, .detail-button {
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s;
        }

        .edit-button {
            background-color: #007BFF; /* Warna biru */
        }

        .hapus-button {
            background-color: #dc3545; /* Warna merah */
        }

        .detail-button {
            background-color: #28a745; /* Warna hijau */
        }

        .edit-button:hover, .hapus-button:hover, .detail-button:hover {
            background-color: #0056b3; /* Warna biru tua saat hover */
        }
    </style>
</head>

<body>

    <header>
        <h1>MANAJEMEN BUKU</h1>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="lihat_database.php">View Database</a>
        <a href="tambah_database.php">Add New Database</a>
    </nav>

    <section>
        <h2>Data Buku</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>ISBN</th>
                
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['published_year'] . "</td>";
                    echo "<td>" . $row['isbn'] . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='edit_data.php?id=" . $row['id'] . "' class='edit-button'>Edit</a>";
                    echo "<a href='hapus_data.php?id=" . $row['id'] . "' class='hapus-button'>Hapus</a>";
                    echo "<a href='detail_perpustakaan.php?id=" . $row['id'] . "' class='detail-button'>Detail</a>"; // Tambah tombol Detail
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
            }
            ?>
        </table>
    </section>
    <nav>
    <footer>
        <p> &copy; 2024 Manajemen Buku </p>
    </footer>
    </nav>

</body>

</html>

<?php
$conn->close();
?>
