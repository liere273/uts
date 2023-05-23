<?php
include 'koneksi.php';

$notification = '';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $jurusan = $_POST['jurusan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $kode_prodi = ($prodi == 'Teknologi dan Informatika') ? '01' : '02';

    $kode_jurusan = '';
    switch ($jurusan) {
        case 'Bisnis Digital':
            $kode_jurusan = '01';
            break;
        case 'Desain Komunikasi Visual':
            $kode_jurusan = '02';
            break;
        case 'Sistem Komputer':
            $kode_jurusan = '03';
            break;
        case 'TI – Desain Grafis dan Multimedia':
            $kode_jurusan = '04';
            break;
        case 'TI – Komputer Akuntansi dan Bisnis':
            $kode_jurusan = '05';
            break;
        case 'TI – Manajemen Data & Informasi':
            $kode_jurusan = '06';
            break;
        case 'TI – Pariwisata':
            $kode_jurusan = '07';
            break;
        default:
            $kode_jurusan = '00';
            break;
    }

    $kode_jenis_kelamin = ($jenis_kelamin == 'laki-laki') ? '01' : '02';

    $query = "SELECT COUNT(*) AS total FROM data_mahasiswa WHERE prodi = '$prodi'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $urutan_pendaftaran = str_pad($row['total'] + 1, 2, '0', STR_PAD_LEFT);

    $nim = '23' . $kode_prodi . $kode_jurusan . $kode_jenis_kelamin . $urutan_pendaftaran;

    $query = "INSERT INTO data_mahasiswa (nim, nama, prodi, jurusan, jenis_kelamin, tanggal_lahir)
              VALUES ('$nim', '$nama', '$prodi', '$jurusan', '$jenis_kelamin', '$tanggal_lahir')";

    if (mysqli_query($conn, $query)) {
        $notification = 'Data berhasil ditambahkan.';
        header("refresh:2; url=dashboard.php");
    } else {
        $notification = 'Error: ' . $query . '<br>' . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
        }

        .form-table th,
        .form-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .form-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .notification {
            background-color: #f2f2f2;
            padding: 10px;
            margin-bottom: 10px;
        }

        .button-container {
            text-align: center;
            margin-top: 10px;
        }

        .button-container button {
            padding: 5px 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Data</h2>

        <!-- Periksa apakah ada pesan notifikasi -->
        <?php if (!empty($notification)) { ?>
            <div class="notification">
                <?php echo $notification; ?>
            </div>
        <?php } ?>

        <form method="POST" action="tambah.php">
            <table class="form-table">
                <tr>
                    <th>Nama:</th>
                    <td><input type="text" name="nama" id="nama" required></td>
                </tr>
                <tr>
                    <th>Prodi:</th>
                    <td>
                        <select name="prodi" id="prodi" required>
                            <option value="">Pilih Prodi</option>
                            <option value="Teknologi dan Informatika">Teknologi dan Informatika</option>
                            <option value="Bisnis dan Desain Kreatif">Bisnis dan Desain Kreatif</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Jurusan:</th>
                    <td>
                        <select name="jurusan" id="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <option value="Bisnis Digital">Bisnis Digital</option>
                            <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                            <option value="Sistem Komputer">Sistem Komputer</option>
                            <option value="TI – Desain Grafis dan Multimedia">TI – Desain Grafis dan Multimedia</option>
                            <option value="TI – Komputer Akuntansi dan Bisnis">TI – Komputer Akuntansi dan Bisnis</option>
                            <option value="TI – Manajemen Data & Informasi">TI – Manajemen Data & Informasi</option>
                            <option value="TI – Pariwisata">TI – Pariwisata</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Kelamin:</th>
                    <td>
                        <select name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Lahir:</th>
                    <td><input type="date" name="tanggal_lahir" id="tanggal_lahir" required></td>
                </tr>
            </table>
            <div class="button-container">
                <button type="submit" name="submit">Tambah Data</button>
                <button type="button" onclick="window.location='dashboard.php'">Batal</button>
            </div>
        </form>
    </div>
</body>
</html>
