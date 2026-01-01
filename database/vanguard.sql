
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL
);

CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT,
    nama_produk VARCHAR(100) NOT NULL,
    brand VARCHAR(50),
    harga INT NOT NULL,
    stok INT DEFAULT 0,
    rating DECIMAL(2,1) DEFAULT 0.0,
    terjual INT DEFAULT 0,
    gambar VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori)
        REFERENCES kategori(id_kategori)
        ON DELETE SET NULL
);

CREATE TABLE detail_produk (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_produk INT UNIQUE,
    deskripsi TEXT,
    bahan VARCHAR(100),
    ukuran VARCHAR(100),
    warna VARCHAR(100),
    berat INT,
    FOREIGN KEY (id_produk)
        REFERENCES produk(id_produk)
        ON DELETE CASCADE
);

CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total INT NOT NULL,

    alamat TEXT NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    metode_pembayaran ENUM('COD','DANA') NOT NULL,
    bukti_transfer VARCHAR(100),

    status ENUM(
        'pending',
        'menunggu_verifikasi',
        'dibayar',
        'dikirim',
        'selesai',
        'batal'
    ) DEFAULT 'pending',

    FOREIGN KEY (id_user)
        REFERENCES users(id_user)
        ON DELETE CASCADE
);

CREATE TABLE detail_transaksi (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT NOT NULL,
    id_produk INT NOT NULL,
    qty INT NOT NULL,
    harga INT NOT NULL,

    FOREIGN KEY (id_transaksi)
        REFERENCES transaksi(id_transaksi)
        ON DELETE CASCADE,

    FOREIGN KEY (id_produk)
        REFERENCES produk(id_produk)
        ON DELETE CASCADE
);


CREATE TABLE testimoni (
    id_testimoni INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_produk INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    komentar TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_user)
        REFERENCES users(id_user)
        ON DELETE CASCADE,

    FOREIGN KEY (id_produk)
        REFERENCES produk(id_produk)
        ON DELETE CASCADE
);
