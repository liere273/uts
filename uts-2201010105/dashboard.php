<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #e0e0e0;
            color: #333333;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .navbar a {
            color: #333333;
            text-decoration: none;
            padding: 10px;
            margin-right: 10px;
        }
        .navbar a:hover {
            background-color: #cccccc;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h3 {
            margin: 0;
            color: #333333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #dddddd;
            color: #333333;
            text-align: left;
        }
        th {
            background-color: #cccccc;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .action-links {
            display: flex;
            justify-content: center;
        }
        .action-links a {
            margin-right: 10px;
            padding: 6px 12px;
            background-color: #cccccc;
            color: #333333;
            border: none;
            text-decoration: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .action-links a:hover {
            background-color: #999999;
        }
        .no-data {
            color: #333333;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="tambah.php">Tambah Data Mahasiswa</a>
    </div>

    <div class="header">
        <h3>Data Mahasiswa</h3>
    </div>

    <?php
    include 'koneksi.php';

    $query = "SELECT * FROM data_mahasiswa";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        ?>
        <table>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Jurusan</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['prodi']; ?></td>
                    <td><?php echo $row['jurusan']; ?></td>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                    <td><?php echo $row['tanggal_lahir']; ?></td>
                    <td class="action-links">
                        <a href="update.php?nim=<?php echo $row['nim']; ?>">Edit</a>
                        <a href="delete.php?nim=<?php echo $row['nim']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        echo "<p class='no-data'>Tidak ada data mahasiswa.</p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
