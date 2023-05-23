<?php
include 'koneksi.php';

// Memeriksa apakah parameter 'nim' ada untuk menghapus data
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Mendapatkan data mahasiswa berdasarkan nim
    $query = "SELECT * FROM data_mahasiswa WHERE nim='$nim'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Memeriksa apakah permintaan konfirmasi penghapusan data dikirim
        if (isset($_POST['confirm_delete'])) {
            // Menghapus data mahasiswa berdasarkan nim
            $deleteQuery = "DELETE FROM data_mahasiswa WHERE nim='$nim'";
            
            if (mysqli_query($conn, $deleteQuery)) {
                // Notifikasi setelah penghapusan data berhasil dilakukan
                echo "<script>alert('Data berhasil dihapus.'); window.location.href='dashboard.php';</script>";
                exit();
            } else {
                echo "Error: " . $deleteQuery . "<br>" . mysqli_error($conn);
            }
        }
        ?>
        <style>
            .form-container {
                width: 400px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f2f2f2;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            
            .form-container h2 {
                text-align: center;
            }
            
            .form-container table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }
            
            .form-container th, .form-container td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            .form-container th {
                background-color: #f2f2f2;
            }
            
            .form-container .button-container {
                text-align: center;
                margin-top: 20px;
            }
            
            .form-container button {
                margin-right: 10px;
                padding: 8px 16px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            
            .form-container button.cancel {
                background-color: #808080;
            }
            
            .form-container button:hover {
                opacity: 0.8;
            }
        </style>
        <div class="form-container">
            <h2>Hapus Data</h2>
            <table>
                <tr>
                    <th>NIM</th>
                    <td><?php echo $row['nim']; ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo $row['nama']; ?></td>
                </tr>
                <tr>
                    <th>Prodi</th>
                    <td><?php echo $row['prodi']; ?></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td><?php echo $row['jurusan']; ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td><?php echo $row['tanggal_lahir']; ?></td>
                </tr>
            </table>
            <div class="button-container">
                <form method="POST">
                    <button type="submit" name="confirm_delete">Hapus Data</button>
                    <button type="button" class="cancel" onclick="window.location.href='dashboard.php'">Batal</button>
                </form>
            </div>
        </div>
        <?php
    } else {
        echo "Data mahasiswa tidak ditemukan.";
    }
} else {
    echo "NIM tidak valid.";
}

mysqli_close($conn);
?>
