-- Buat database
CREATE DATABASE sipm_trantibum;
USE sipm_trantibum;

-- Tabel users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','camat','kasi','petugas') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel pengaduan
CREATE TABLE pengaduan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  no_surat VARCHAR(50) UNIQUE NOT NULL,
  tgl_diterima DATE NOT NULL,
  nama_pelapor VARCHAR(100),
  alamat VARCHAR(255) NOT NULL,
  isi_pengaduan TEXT NOT NULL,
  berkas VARCHAR(255),
  status ENUM(
    'Diterima',
    'Menunggu Persetujuan Camat',
    'Disetujui',
    'Ditolak',
    'Ditindaklanjuti',
    'Selesai'
  ) DEFAULT 'Diterima',
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Tabel disposisi (Camat)
CREATE TABLE disposisi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pengaduan_id INT NOT NULL,
  camat_id INT NOT NULL,
  keputusan ENUM('Disetujui','Ditolak') NOT NULL,
  catatan TEXT,
  tgl_disposisi DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pengaduan_id) REFERENCES pengaduan(id),
  FOREIGN KEY (camat_id) REFERENCES users(id)
);

-- Tabel arahan (Kasi Trantibum)
CREATE TABLE arahan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pengaduan_id INT NOT NULL,
  kasi_id INT NOT NULL,
  petugas_id INT NOT NULL,
  instruksi TEXT NOT NULL,
  tgl_arahan DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pengaduan_id) REFERENCES pengaduan(id),
  FOREIGN KEY (kasi_id) REFERENCES users(id),
  FOREIGN KEY (petugas_id) REFERENCES users(id)
);

-- Tabel penanganan (Petugas)
CREATE TABLE penanganan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pengaduan_id INT NOT NULL,
  petugas_id INT NOT NULL,
  hasil TEXT NOT NULL,
  dokumentasi VARCHAR(255),
  tgl_penanganan DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pengaduan_id) REFERENCES pengaduan(id),
  FOREIGN KEY (petugas_id) REFERENCES users(id)
);

-- Insert user default
-- Password: 123456 (di-hash pakai password_hash PHP)
INSERT INTO users (nama, username, password, role) VALUES
('Administrator', 'admin',   '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1HlCS4bZJ18JuywdBz0Z0n0eC7n0e7C', 'admin'),
('Camat Medan Petisah', 'camat',   '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1HlCS4bZJ18JuywdBz0Z0n0eC7n0e7C', 'camat'),
('Kasi Trantibum', 'kasi',    '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1HlCS4bZJ18JuywdBz0Z0n0eC7n0e7C', 'kasi'),
('Petugas Lapangan 1', 'petugas', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1HlCS4bZJ18JuywdBz0Z0n0eC7n0e7C', 'petugas');