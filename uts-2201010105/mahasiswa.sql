CREATE DATABASE mahasiswa

CREATE TABLE data_mahasiswa (
    nim BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    prodi VARCHAR(50) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    jenis_kelamin VARCHAR(20) NOT NULL,
    tanggal_lahir DATE NOT NULL
);