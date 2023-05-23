<?php
include 'koneksi.php';

// Memeriksa apakah parameter 'nim' ada untuk mengupdate data
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Mendapatkan data mahasiswa berdasarkan nim
    $query = "SELECT * FROM data_mahasiswa WHERE nim='$nim'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Memeriksa apakah permintaan update data dikirim
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $prodi = $_POST['prodi'];
            $jurusan = $_POST['jurusan'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $tanggal_lahir = $_POST['tanggal_lahir'];

            // Memperbarui data mahasiswa berdasarkan nim
            $updateQuery = "UPDATE data_mahasiswa SET nama='$nama', prodi='$prodi', jurusan='$jurusan', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir' WHERE nim='$nim'";
            
            if (mysqli_query($conn, $updateQuery)) {
                // Notifikasi setelah pembaruan data berhasil dilakukan
                echo "<script>alert('Data berhasil diperbarui.'); window.location.href='dashboard.php';</script>";
                exit();
            } else {
                echo "Error: " . $updateQuery . "<br>" . mysqli_error($conn);
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
            
            .form-container label {
                display: block;
                margin-bottom: 10px;
            }
            
            .form-container input[type="text"],
            .form-container select,
            .form-container input[type="date"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
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
            <h2>Update Data</h2>
            <form method="POST" action="update.php?nim=<?php echo $nim; ?>">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>
                <label for="prodi">Prodi:</label>
                <select name="prodi" required>
                    <option value="">Pilih Prodi</option>
                    <option value="Teknologi dan Informatika" <?php if ($row['prodi'] == 'Teknologi dan Informatika') echo 'selected'; ?>>Teknologi dan Informatika</option>
                    <option value="Bisnis dan Desain Kreatif" <?php if ($row['prodi'] == 'Bisnis dan Desain Kreatif') echo 'selected'; ?>>Bisnis dan Desain Kreatif</option>
                </select>
                <label for="jurusan">Jurusan:</label>
                <select name="jurusan" required>
                    <option value="">Pilih Jurusan</option>
                    <option value="Bisnis Digital" <?php if ($row['jurusan'] == 'Bisnis Digital') echo 'selected'; ?>>Bisnis Digital</option>
                    <option value="Desain Komunikasi Visual" <?php if ($row['jurusan'] == 'Desain Komunikasi Visual') echo 'selected'; ?>>Desain Komunikasi Visual</option>
                    <option value="Sistem Komputer" <?php if ($row['jurusan'] == 'Sistem Komputer') echo 'selected'; ?>>Sistem Komputer</option>
                    <option value="TI – Desain Grafis dan Multimedia" <?php if ($row['jurusan'] == 'TI – Desain Grafis dan Multimedia') echo 'selected'; ?>>TI – Desain Grafis dan Multimedia</option>
                    <option value="TI – Komputer Akuntansi dan Bisnis" <?php if ($row['jurusan'] == 'TI – Komputer Akuntansi dan Bisnis') echo 'selected'; ?>>TI – Komputer Akuntansi dan Bisnis</option>
                    <option value="TI – Manajemen Data & Informasi" <?php if ($row['jurusan'] == 'TI – Manajemen Data & Informasi') echo 'selected'; ?>>TI – Manajemen Data & Informasi</option>
                    <option value="TI – Pariwisata" <?php if ($row['jurusan'] == 'TI – Pariwisata') echo 'selected'; ?>>TI – Pariwisata</option>
                </select>
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki" <?php if ($row['jenis_kelamin'] == 'laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="perempuan" <?php if ($row['jenis_kelamin'] == 'perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']; ?>" required>
                <div class="button-container">
                    <button type="submit" name="submit">Update Data</button>
                    <button type="button" class="cancel" onclick="window.location.href='dashboard.php'">Batal</button>
                </div>
            </form>
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
