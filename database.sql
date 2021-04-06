-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2020 pada 17.23
-- Versi server: 10.1.39-MariaDB
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20_korden`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_order`
--

CREATE TABLE `tb_detail_order` (
  `iddetail` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `idorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_order`
--

INSERT INTO `tb_detail_order` (`iddetail`, `idproduk`, `qty`, `subtotal`, `idorder`) VALUES
(3, 7, 2, 180000, 200717123),
(4, 5, 2, 200000, 200717123),
(5, 1, 1, 10000, 200719580),
(6, 2, 1, 10000, 200719580),
(7, 4, 1, 40000, 200719298),
(8, 6, 1, 40000, 200719298),
(9, 3, 1, 19000, 200719441),
(10, 4, 1, 40000, 200721895);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`idkaryawan`, `nama`, `email`, `password`, `created_at`) VALUES
(3, 'admin', 'admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-06-23 15:01:59'),
(4, 'asd', 'zotabitem@mailinator.net', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-24 13:37:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `idkategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`idkategori`, `nama_kategori`, `keterangan`, `created_at`) VALUES
(4, 'Polos', 'polos aja', '2020-07-01 15:44:35'),
(5, 'Motif batik', 'korden varisi batik', '2020-07-01 15:45:21'),
(6, 'Tirai Jendela', 'tirai jendela', '2020-07-10 15:51:40'),
(7, 'Kartun', 'motif kartun\r\n', '2020-07-10 15:51:57'),
(8, 'Doraemon', '', '2020-07-10 15:52:06'),
(9, 'Onepiece', '', '2020-07-10 15:52:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konfirmasi`
--

CREATE TABLE `tb_konfirmasi` (
  `idkonfirmasi` int(11) NOT NULL,
  `idorder` int(11) NOT NULL,
  `rek_nama` varchar(100) NOT NULL,
  `rek_bank` varchar(50) NOT NULL,
  `status_bayar` enum('valid','tidak valid') DEFAULT NULL,
  `bukti_tf` varchar(100) NOT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_konfirmasi`
--

INSERT INTO `tb_konfirmasi` (`idkonfirmasi`, `idorder`, `rek_nama`, `rek_bank`, `status_bayar`, `bukti_tf`, `waktu_upload`) VALUES
(1, 200717123, 'Eligendi quaerat ut ', 'Consequuntur pariatu', 'tidak valid', '885ea12ca6b1a3ba21a87e02936c7c71.png', '2020-07-18 10:45:53'),
(2, 200719298, 'addin 123', 'BCA', 'valid', 'c785213071b3b2e4c18934d5ef150b00.png', '2020-07-19 10:29:57'),
(3, 200719441, 'addin678', 'BRI Syariah', 'valid', 'eb2f73508469449156f0e4815fd5e731.png', '2020-07-19 10:38:06'),
(4, 200719580, 'addin000', 'Mandiri Syariah', 'valid', 'e7d73a568efe8ddc694dd2b51ae98cbf.png', '2020-07-19 10:52:51'),
(5, 200721895, 'john doe', 'bri', NULL, 'aa59db2446067528384d4c36ba2035d3.jpg', '2020-07-21 14:51:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `idmember` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `jenis_kel` varchar(20) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`idmember`, `nama`, `email`, `password`, `jenis_kel`, `hp`, `created_at`) VALUES
(1, 'akhul syaifudin', 'member@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'laki-laki', '085747377444', '2020-06-25 15:41:56'),
(2, 'Minim rerum qui qui ', 'kozuzytux@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'Perempuan', '10', '2020-07-15 14:55:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `idorder` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `status` enum('pending','terkirim','selesai') NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `no_resi` varchar(50) DEFAULT NULL,
  `expedisi` varchar(100) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`idorder`, `idmember`, `total_harga`, `ongkir`, `status`, `atas_nama`, `alamat`, `phone`, `no_resi`, `expedisi`, `total_berat`, `total_qty`, `created_at`) VALUES
(200717123, 1, 380000, 26000, 'pending', 'addin', 'nusa indah 45', '0927538946', NULL, 'jne - OKE', 1376, 2, '2020-07-17 11:19:38'),
(200719298, 1, 80000, 12500, 'terkirim', 'addin123', 'bandung no 23 bandung raya selatan', '0987783465', '45454545454', 'tiki - ECO', 688, 2, '2020-07-19 05:14:13'),
(200719441, 1, 19000, 16000, 'terkirim', 'addin777', 'jombang no 9 jawa timur selatan', '093486983467873', '4535363ffgf', 'pos - Paket Kilat Kh', 344, 1, '2020-07-19 10:17:00'),
(200719580, 1, 20000, 20000, 'pending', 'addin789', 'jl buntu nomor 45 banyumas ', '08756745672', NULL, 'jne - REG', 688, 2, '2020-07-19 05:11:17'),
(200721895, 1, 40000, 17000, 'pending', 'addin009', 'bojonegoro jawa timur', '09459426', NULL, 'pos - Paket Kilat Kh', 344, 1, '2020-07-21 14:50:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` varchar(255) NOT NULL,
  `berat` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `dijual` enum('ya','tidak') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`idproduk`, `idkategori`, `namaproduk`, `berat`, `gambar`, `stok`, `harga`, `deskripsi`, `dijual`, `created_at`) VALUES
(1, 4, 'satu dua tiga empat lima enam tujuh delapan', 344, '48affc32ae5544ad5f148e3f19a0d175.jpg', 3, 10000, 'lorem', 'ya', '2020-07-01 16:06:51'),
(2, 4, 'dua lima belas lima sepuluh lorem pixel', 344, 'f8767d6b1a63b87f5af3913bc640ae9e.jpg', 3, 10000, '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</div><div>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</div><div>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</div><div>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</div><div>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</div><div>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>', 'ya', '2020-07-01 16:07:40'),
(3, 4, ' Korden Doraemon nobita suneo giant mama giant', 344, '8736092dfb87353b6d314fe1293f2096.png', 3, 19000, '<span xss=removed>HORDENG KARAKTER DORAEMON 3D / GORDEN KARAKTER DORAEMON 3 DIMENSI\r\n\r\n- Dilengkapi renda\r\n- Lebar : 75cm\r\n- Tinggi : -+200cm\r\n- Motif : Doraemon\r\n- Bahan : Poly Micro\r\n\r\n\r\nMotif Doraemon\r\n\r\nspesifikasi bahan :\r\nPolymicro yang memiliki permukaan yang sangat lembut dan mengkilap jika dipandang dari kejauhan mampu memberikan tampilan yang sedikit mewah pada sebuah ruangan. Pilihan warna dan motifnya yang cukup beragam, ditambah dengan jalinan benangnya yang sangat rapat terkesan begitu elegan ketika digunakan untuk menutupi jendela . </span>', 'ya', '2020-07-10 15:37:44'),
(4, 8, 'GKM (GALON KULKAS MAGICOM) ALMAFI HIJAU', 344, '1839762fb72b046394fcad6aecd8ef9c.png', 38, 40000, '<span xss=removed>Paket sarung galon kulkas magicom HANYA 120.000\r\n\r\nBisa dibeli ecer \r\nSarung kulkas : 55.000 + handle\r\nSarung galon : 30.000\r\nMagicom : 35.000 + handle 1\r\n\r\n#sarunggalon #sarungkulkas #tutupkulkas #shabbychic #vintage #decoupage #sprai #sprei #gorden #sarungbantal #gkm #cussion #produsengkm #coverset #taplakkulkas #produsensarunggalon</span>', 'ya', '2020-07-10 16:39:53'),
(5, 4, 'KORDEN SMOKERING TUMPUK MOTIF PEVITA', 344, '1e1ab6cb84bc36a33d411cd96eaa64a3.png', 14, 100000, '<span xss=removed>SMOKRING RUMBAI \r\n\r\nDI GAMBAR MENGGUNAKAN 2 PCS GORDEN. \r\n1 PCS GORDEN HARGA 115.000\r\n1 PCS GORDEN UKURAN TINGGI 2 X LEBAR 1M .\r\n\r\nBAHAN : KATUN CVC\r\n\r\nHARGA TERJANGKAU, DESAIN MEWAH. \r\n\r\n#gorden #korden #hordeng #gordyn #gordenminimalis #hordengminimalis #gordensimpel #gordynshabbychic</span>', 'ya', '2020-07-10 16:40:57'),
(6, 6, 'SARUNG GALON, KULKAS, MAGICOM ANNISA PINK', 344, 'c6018078ea381b1a0b9d92880ba1e283.png', 3, 40000, '<span xss=removed>Paket sarung galon kulkas magicom HANYA 135.000 \r\n\r\nSudah Termasuk handle 2 pcs#\r\n\r\nBisa dibeli ecer \r\nSarung kulkas : 55.000\r\nSarung galon : (30.000 biasa) & (45.000 tumpuk tiga) \r\nMagicom : 35.000 + handle 1\r\n\r\n#sarunggalon #sarungkulkas #tutupkulkas #shabbychic #vintage #decoupage #sprai #sprei #gorden #sarungbantal #gkm #cussion #produsengkm #coverset #taplakkulkas #produsensarunggalon</span>', 'ya', '2020-07-10 16:41:46'),
(7, 4, 'KORDEN Doraemon sinchan naruton onepiece', 344, 'b66ae0ae6dbac9abe6cf0a74be519845.png', 5, 90000, 'lorem', 'ya', '2020-07-10 16:42:19'),
(8, 4, 'tirau bambu unik hanya satu saja buruan beli', 1000, '6e40578b74b17188b9422112eac58c18.jpg', 23, 90000, '<p>lorem </p><p>ipsum dolor sit amet</p><p><br></p><p>hanaya tersedia 2 warna</p>', 'ya', '2020-07-20 12:14:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `idorder` (`idorder`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indeks untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`idkaryawan`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indeks untuk tabel `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD PRIMARY KEY (`idkonfirmasi`),
  ADD KEY `idorder` (`idorder`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`idmember`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `idmember` (`idmember`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `id_kategori` (`idkategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  MODIFY `iddetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `idkaryawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  MODIFY `idkonfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200721896;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD CONSTRAINT `tb_detail_order_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `tb_produk` (`idproduk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_order_ibfk_2` FOREIGN KEY (`idorder`) REFERENCES `tb_order` (`idorder`);

--
-- Ketidakleluasaan untuk tabel `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD CONSTRAINT `tb_konfirmasi_ibfk_1` FOREIGN KEY (`idorder`) REFERENCES `tb_order` (`idorder`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_2` FOREIGN KEY (`idmember`) REFERENCES `tb_member` (`idmember`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `tb_kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
