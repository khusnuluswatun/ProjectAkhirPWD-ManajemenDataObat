CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    nama_lengkap VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL
    -- tgl_lahir date DEFAULT NUL,
    -- no_hp VARCHAR(13) NOT NULL,
    -- alamat VARCHAR(50) NOT NULL
);

CREATE TABLE obat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nama_obat VARCHAR(100) NOT NULL,
    dosis VARCHAR(50),
    jumlah INT,
    kategori ENUM('Tablet', 'Sirup', 'Kapsul', 'Salep'),
    resep_dokter BOOLEAN DEFAULT FALSE,
    -- file_resep VARCHAR(255),
    cara_penggunaan VARCHAR(100),
    frekuensi_pemakaian INT,
    efek_samping VARCHAR(100),
    tanggal_kadaluarsa DATE,
    -- tanggal_input DATE,
    catatan VARCHAR(1000),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);