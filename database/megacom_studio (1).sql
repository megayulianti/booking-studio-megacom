-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2024 pada 10.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `megacom_studio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(25) NOT NULL,
  `admin_username` varchar(25) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`) VALUES
(1, 'resti', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1352025327_avatar.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_nama` varchar(35) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_hp` varchar(13) NOT NULL,
  `customer_alamat` text NOT NULL,
  `customer_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_nama`, `customer_email`, `customer_hp`, `customer_alamat`, `customer_password`) VALUES
(3, 'Ahmad Jhony', 'jhony@gmail.com', '0927883733', 'jala sdjasl', ''),
(5, 'Jamaika Bob', 'jamaika@gmail.com', '08262122771', 'jalan rasta uye nomor 1', ''),
(6, 'Rosalina', 'rosalina@gmail.com', '082827287', 'jalan meruakaja', ''),
(7, 'suleha alala', 'suleha@gmail.com', '982737383737', 'sasdkajndkasjdn', ''),
(8, 'INDRA RAHMAWAN', 'indrar0104@gmail.com', '081382789716', 'Jl. Daan Mogot Raya No.25-171 KM.21 (Samping CV.JAPAINDO), Kel. Batu Ceper, Kec. Batu Ceper, Kota Tangerang 15122', ''),
(9, 'rah', 'rah@gmail.com', '085654765487', 'jakarta', ''),
(10, 'sahil', 'sahil@gmail.com', '0876765454', 'jakarta', ''),
(11, 'pai', 'pai@gmail.com', '086767323', 'padang', '202cb962ac59075b964b07152d234b70'),
(12, 'yuli', 'yuli@gmail.com', '081234565', 'padang', '202cb962ac59075b964b07152d234b70'),
(13, 'megaa', 'meg@gmail.com', '087656566', 'padang', '202cb962ac59075b964b07152d234b70'),
(14, 'yuliawitri', 'yulia@gmail.com', '082170509754', 'belanti indah nomor 3', 'a906449d5769fa7361d7ecc6aa3f6d28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_tanggal` date NOT NULL,
  `invoice_waktu` time NOT NULL,
  `invoice_customer` int(11) NOT NULL,
  `invoice_nama` varchar(25) NOT NULL,
  `invoice_hp` varchar(13) NOT NULL,
  `invoice_alamat` text NOT NULL,
  `invoice_total_bayar` int(11) NOT NULL,
  `invoice_status` int(11) NOT NULL,
  `invoice_resi` varchar(25) NOT NULL,
  `invoice_bukti` text NOT NULL,
  `layanan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_tanggal`, `invoice_waktu`, `invoice_customer`, `invoice_nama`, `invoice_hp`, `invoice_alamat`, `invoice_total_bayar`, `invoice_status`, `invoice_resi`, `invoice_bukti`, `layanan_id`) VALUES
(53, '2024-06-30', '13:00:00', 11, 'rara', '081243546', 'padang', 650000, 1, '', '2046038765.png', 0),
(54, '2024-06-06', '10:02:00', 11, 'rahmad', '086757363', 'solok selatan', 1500000, 1, '', '1819343084.png', 0),
(55, '2024-06-20', '14:05:00', 11, 'santi', '0856374348', 'pariaman', 200000, 1, '', '964621824.png', 0),
(56, '2024-06-17', '15:07:00', 11, 'yulia', '084523747', 'pasaman barat', 400000, 0, '', '470773983.png', 0),
(58, '2024-07-19', '14:34:00', 12, 'arham', '0758698', 'papua', 250000, 6, '', '', 0),
(59, '2024-07-08', '14:50:00', 12, 'yemi', '54535', 'afrika', 350000, 6, '', '', 0),
(60, '2024-07-10', '09:22:00', 13, 'nadi', '0878678', 'pdad', 450000, 3, '', '1887144158.png', 0),
(61, '2024-07-29', '16:00:00', 14, 'yulia witri', '082170509754', 'jl belanti indah nomor 3', 300000, 6, '', '467532251.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `invoice_detail_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `layanan_nama` varchar(25) NOT NULL,
  `layanan_foto1` varchar(255) NOT NULL,
  `layanan_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `invoice_detail`
--

INSERT INTO `invoice_detail` (`invoice_detail_id`, `invoice_id`, `layanan_id`, `layanan_nama`, `layanan_foto1`, `layanan_harga`) VALUES
(3, 50, 6, 'Celana Tenun Dingin', '1677114666_02274f49979c5062b85f01fbd51b256b.jpg', 200000),
(4, 51, 11, 'Kain Tenun Untuk Baju', '611138101_Bahan_Pakaian_Tenun_Kain_Tenun_Ikat_Bali_CSM_05.jpg', 80000),
(5, 52, 12, 'Baju Daster Tenun', '1602884192_Dress_Etnik_Unik_Tenun_Troso_Jepara_Motif_Batik_Toraja.jpg', 120000),
(6, 52, 10, 'Celana Tenun Cewek Berkua', '1517011641_CT82_1U.jpg', 400000),
(7, 53, 18, 'PAKET 4 KELUARGA', '931521423_k4.jpeg', 650000),
(8, 54, 13, 'PAKET 1 WEDDING', '1083339072_foto1.jpg', 1500000),
(9, 55, 9, 'PAKET 1 WISUDA', '2083254336_w1.jpeg', 200000),
(10, 56, 6, 'PAKET 3 WISUDA', '1493489026_w3.jpeg', 400000),
(11, 57, 9, 'PAKET 1 WISUDA', '2083254336_w1.jpeg', 200000),
(12, 58, 15, 'PAKET 1 KELUARGA', '341044874_k1.jpeg', 250000),
(13, 59, 16, 'PAKET 2 KELUARGA', '112811396_k2.jpeg', 350000),
(14, 60, 17, 'PAKET 3 KELUARGA', '906814279_k3.jpeg', 450000),
(15, 61, 8, 'PAKET 2 WISUDA', '861135095_w2.jpeg', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(25) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `jumlah`) VALUES
(1, 'Tidak Berkategori', 0),
(2, 'PAKET FOTO WEDDING', 4),
(3, 'PAKET FOTO WISUDA', 4),
(4, 'PAKET FOTO KELUARGA', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `layanan_id` int(11) NOT NULL,
  `layanan_nama` varchar(25) NOT NULL,
  `layanan_kategori` int(11) NOT NULL,
  `layanan_harga` int(11) NOT NULL,
  `layanan_keterangan` text NOT NULL,
  `layanan_foto1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`layanan_id`, `layanan_nama`, `layanan_kategori`, `layanan_harga`, `layanan_keterangan`, `layanan_foto1`) VALUES
(6, 'PAKET 3 WISUDA', 3, 400000, '<p>paket 3 yang didapatkan :<br>1. foto sepuasnya 20 menit<br>2. cetak foto 10 lbr ukuran 4R<br>3. cetak foto 7 lbr ukuran 10R<br>4. 1 frame 10R<br></p>', '1493489026_w3.jpeg'),
(8, 'PAKET 2 WISUDA', 3, 300000, '<p>paket 2 yang didapatkan :<br>1. foto sepuasnya 20 menit<br>2. cetak foto 6 lbr ukuran 4R<br>3. cetak foto 5 lbr ukuran 10R<br>4. 1 frame 10R<br></p>', '861135095_w2.jpeg'),
(9, 'PAKET 1 WISUDA', 3, 200000, '<p>paket 1 yang didapatkan :<br>1. foto sepuasnya 20 menit<br>2. cetak foto 3 lbr ukuran 4R<br>3. cetak foto 3 lbr ukuran 10R<br>4. 1 frame 10R<br></p>', '2083254336_w1.jpeg'),
(10, 'PAKET 4 WEDDING', 2, 3400000, '<p>paket 4 yang didapatkan :<br>1. foto 24R 1 lbr + frame<br>2. foto 20R 1 lbr +frame<br>3. video cinemtic pernikahan<br>4. stand foto wedding 1 buah<br>5. cetak foto ukuran 4R sebanyak 250 lbr<br>6. cetak foto ukuran 10R sebanyak 4 lbr<br>7. buku album foto<br><br></p>', '612185313_foto3.jpg'),
(11, 'PAKET 3 WEDDING', 2, 2600000, '<p>paket 3 yang didapatkan :<br>1. foto 24R 1 lbr + frame<br>2. foto 20R 1lbr +frame<br>3. vdeo cinematic pernikahan<br>4. stand foto wedding 1 buah<br>5. cetak foto ukuran 4R ebanyak 150 lbr<br>6. buku album foto<br></p>', '1073997983_gambar10.jpg'),
(12, 'PAKET 2 WEDDING', 2, 2000000, '<p>paket 2 yang didapatkan :<br>1. foto 24R 1 lbr +frame<br>2. foto 20R 1 lbr<br>3. video cinematic pernikahan<br>4. stand foto wedding 1 buah<br>5. cetak foto ukuran 4R sebanyak 100 lbr<br><br></p>', '276759266_gambar.jpg'),
(13, 'PAKET 1 WEDDING', 2, 1500000, '<p>paket 1 yang didapatkan :<br>1. foto 20R 1 lbr + frame<br>2. video cinematic pernikahan<i></i></p>', '1083339072_foto1.jpg'),
(14, 'PAKET 4 WISUDA', 3, 650000, '<p>paket 4 yang didapatkan :<br>1. foto sepuasnya 20 menit<br>2. cetak foto 10 lbr ukuran 4R<br>3. cetak foto 7 lbr ukuran 10R<br>4. 1 frame 10R<br>5. cetak foto 1 lbr ukuran 20R<br>6. 1 frame 20R<br></p>', '286167302_w4.jpeg'),
(15, 'PAKET 1 KELUARGA', 4, 250000, '<p>paket 1 yang didapatkan:<br>1. foto sepuasnya selama 40 menit<br>2. cetak foto 4 lbr ukuran 4R<br>3. cetak foto 3 lbr ukuran 10R<br>4. 1 frame 10R<br></p>', '341044874_k1.jpeg'),
(16, 'PAKET 2 KELUARGA', 4, 350000, '<p>paket 2 yang didapatkan :<br>1. foto sepuasnya selama 40 menit<br>2. cetak foto 6 lbr ukuran 4R<br>3. cetak foto 4 lbr ukuran 10R<br>4. 1 frame 10R<br></p>', '112811396_k2.jpeg'),
(17, 'PAKET 3 KELUARGA', 4, 450000, '<p>paket 3 yang didapatkan ;<br>1. foto sepuasnya selama 40 menit<br>2. cetak foto 7 lbr ukuran 4R<br>3. cetak foto 5 lbr ukuran 10R<br>4. 1 frame 10R<br></p>', '906814279_k3.jpeg'),
(18, 'PAKET 4 KELUARGA', 4, 650000, '<p>paket 4 yang didapatkan :<br>1. foto sepuasnya selama 40 menit<br>2. cetak foto 7 lbr ukuran 4R<br>3. cetak foto 5 lbr ukuran 10R<br>4. 1 frame 10R<br>5. cetak foto 1lbr ukuran 20R<br>6. 1 frame 20R<br></p>', '931521423_k4.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik`
--

CREATE TABLE `pemilik` (
  `pemilik_id` int(11) NOT NULL,
  `pemilik_nama` varchar(25) NOT NULL,
  `pemilik_username` varchar(25) NOT NULL,
  `pemilik_password` varchar(100) NOT NULL,
  `pemilik_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`pemilik_id`, `pemilik_nama`, `pemilik_username`, `pemilik_password`, `pemilik_foto`) VALUES
(1, 'mega', 'pemilik', '21232f297a57a5a743894a0e4a801fc3', '1352025327_avatar.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_invoice` int(11) NOT NULL,
  `transaksi_layanan` int(11) NOT NULL,
  `transaksi_jumlah` int(11) NOT NULL,
  `transaksi_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_invoice`, `transaksi_layanan`, `transaksi_jumlah`, `transaksi_harga`) VALUES
(1, 0, 3, 1, 120000),
(2, 0, 1, 1, 1234),
(3, 0, 3, 1, 120000),
(4, 0, 1, 1, 1234),
(5, 1, 3, 1, 120000),
(6, 1, 1, 1, 1234),
(9, 3, 3, 1, 120000),
(10, 4, 4, 1, 123000),
(11, 5, 7, 2, 240000),
(12, 5, 8, 1, 80000),
(13, 5, 10, 1, 400000),
(14, 6, 10, 1, 400000),
(15, 6, 9, 1, 300500),
(16, 7, 11, 2, 80000),
(17, 7, 12, 1, 120000),
(18, 8, 13, 2, 130000),
(19, 8, 11, 1, 80000),
(20, 9, 11, 1, 80000),
(21, 11, 6, 1, 200000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indeks untuk tabel `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`invoice_detail_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indeks untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`pemilik_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `invoice_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `pemilik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
