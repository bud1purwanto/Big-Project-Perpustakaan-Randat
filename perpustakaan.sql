-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2017 at 04:06 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` varchar(20) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `cover`, `judul`, `id_penerbit`, `tahun_terbit`, `id_kategori`, `stok`) VALUES
('AM223', 'THELAST.png', 'Amazing Malang', 6, 2004, 6, 12),
('HAC2121', 'djh2_sb_is_021.jpg', 'Hacking With 0 Day Exploit', 8, 2015, 2, 5),
('HDC221', 'pengertian-dan-fungsi-storyboard.png', 'Hidup Dengan Coding', 9, 2017, 13, 7),
('MIK221', 'jti.png', 'Hidup Dengan Mikrotik Sampai Tidur Malam Terus', 1, 1990, 18, 3),
('MMA2234', 'book.png', 'Manfaat Membaca Al-Qur\'an', 13, 1997, 12, 11),
('NG1080', 'wew.jpg', 'Nvidia GTX 1080', 11, 1990, 7, 4),
('PAS122', 'Pamflet.jpg', 'Pembantaian Ayam Sekolah', 1, 2015, 11, 0),
('PB1212', 'fundraising_BAKSOS.jpg', 'Pintar Bersama Pak Yusuf', 3, 1990, 21, 2),
('PU6921', 'BG.png', 'Pandai Unity', 11, 2017, 22, 21);

-- --------------------------------------------------------

--
-- Table structure for table `buku_pengarang`
--

CREATE TABLE `buku_pengarang` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `id_pengarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku_pengarang`
--

INSERT INTO `buku_pengarang` (`id`, `id_buku`, `id_pengarang`) VALUES
(26, 'HAC2121', 9),
(27, 'HAC2121', 10),
(28, 'AM223', 14),
(29, 'AM223', 17),
(30, 'PAS122', 8),
(31, 'PAS122', 18),
(32, 'NG1080', 27),
(33, 'MMA2234', 1),
(34, 'MIK221', 24),
(35, 'HDC221', 16),
(36, 'PU6921', 14),
(37, 'PU6921', 16),
(38, 'PB1212', 25);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `foto`) VALUES
(1, 'lib1.jpg'),
(2, 'lib2.jpg'),
(3, 'lib3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `no_identitas` int(11) NOT NULL,
  `jenis` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`no_identitas`, `jenis`) VALUES
(1, 'nip'),
(11111, 'nip'),
(1541180017, 'nim'),
(1541180042, 'nim'),
(1541180153, 'nip'),
(1541180222, 'nim'),
(1541180223, 'nim'),
(1921681731, 'nip'),
(2147483647, 'nip');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Security'),
(6, 'Story'),
(7, 'Teknologi'),
(11, 'Criminal'),
(12, 'Religi'),
(13, 'Edukasi'),
(14, 'Framework'),
(15, 'Kuliah'),
(16, 'Al-qur\'an'),
(17, 'Sport'),
(18, 'Jaringan Komputer'),
(19, 'Rekayasa Perangkat Lunak'),
(20, 'Bahasa Inggris'),
(21, 'Bahasa Indonesia'),
(22, 'Multimedia Terapan'),
(23, 'Artifical Intelligence'),
(24, 'Teknik Dokumentasi'),
(25, 'Basis Data');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(38, 16, 'PAS122', '2017-05-09', '2017-06-03', 'Belum Kembali'),
(39, 14, 'MIK221', '2017-05-18', '2017-06-19', 'Belum Kembali'),
(40, 16, 'AM223', '2017-05-26', '2017-06-24', 'Kembali'),
(41, 16, 'HAC2121', '2017-06-17', '2017-07-01', 'Belum Kembali'),
(42, 16, 'MIK221', '2017-06-17', '2017-07-01', 'Belum Kembali'),
(43, 16, 'MMA2234', '2017-06-17', '2017-07-01', 'Belum Kembali'),
(45, 14, 'AM223', '2017-06-17', '2017-07-02', 'Kembali'),
(46, 17, 'HAC2121', '2017-06-17', '2017-07-01', 'Kembali');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `no_hp`) VALUES
(1, 'Gajelas', 'Malang', '00202323434'),
(3, 'Kita Bersama', 'Indoenesia', '0852332277000'),
(5, 'Hidup Semati', 'Ngabar', '08523322770'),
(6, 'Gramedia', 'Jakarta', '0088232321212'),
(7, 'Samsung Sejahtera', 'Kuvukiland', '900922722244'),
(8, 'Kuvukiland', 'Kuvukiland', '09834434323'),
(9, 'Carabao', 'Kerbau', '09343434332'),
(10, 'Toga Mas', 'Malang', '09823232333'),
(11, 'Adidas Laminating', 'Manchester', '093434332399'),
(12, 'Wijaya Nyetak2', 'Pizza Hut', '002322223233'),
(13, 'Akeno Print2an', 'Pertigaan UB', '09883434343'),
(14, 'Sayonara', 'Japanese', '003434343434');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `alamat`, `no_hp`) VALUES
(1, 'Cahya Istimewa', 'Malang', '086533452333'),
(2, 'Tsukumoto Miyami', 'Jepang', '34902903023'),
(3, 'Michael Carrick', 'Ngabar', '232332121121'),
(8, 'Paul Pogba', 'Indooooo', '0989223231212'),
(9, 'Andrea Pirlo', 'Italy', '00292332323'),
(10, 'Zlatan Ibrahimovic', 'Swedia', '0882839232233'),
(11, 'Bambang Pamungkas', 'Jakarta', '092322334343'),
(12, 'King Cantona', 'Prancis', '0888283383283'),
(13, 'Victor Lindelof', 'Manchester', '098232323234'),
(14, 'Ander Herrera', 'Spanyol', '03438438443'),
(15, 'Daley Blind', 'Belanda', '08838483484'),
(16, 'Juan Mata', 'Pacitan', '08837443443'),
(17, 'David De Gea', 'Selorok', '028283823434'),
(18, 'Henrikh Mkhytaryan', 'Armenia', '087634347343'),
(19, 'Marouane Fellaini', 'Belgia', '099343434343'),
(20, 'Edvin Van Der Sar', 'Ajax', '098838434343'),
(21, 'David Beckham', 'Wong Ingland', '0838443443'),
(22, 'Luke Shaw', 'Southampton', '0883434343'),
(23, 'Marcos Rojo', 'Argentina', '08878232332'),
(24, 'Anthony Martial', 'France', '002323223323'),
(25, 'Marcus Rashford', 'Asli Manchester', '09343444343'),
(26, 'Sergio Romero', 'Argentinian', '092232323332'),
(27, 'Antonio Vaencia', 'Ekuador', '09343434344'),
(28, 'Matteo Darmian', 'Italy KW', '038438434343');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_kembali` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` varchar(15) NOT NULL,
  `jatuh_tempo` varchar(50) NOT NULL,
  `denda` varchar(100) NOT NULL,
  `tanggal_dikembalikan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_kembali`, `id_pinjam`, `id_user`, `id_buku`, `jatuh_tempo`, `denda`, `tanggal_dikembalikan`) VALUES
(4, 45, 14, 'AM223', '0', '0', '2017-06-17'),
(5, 46, 17, 'HAC2121', '0', '0', '2017-06-17'),
(6, 40, 16, 'AM223', '0', '0', '2017-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id_report` int(11) NOT NULL,
  `subjek` varchar(20) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id_report`, `subjek`, `isi`, `tanggal`, `id_user`) VALUES
(1, 'Fasilitas', 'asasas', '2017-05-28', 14),
(2, 'Buku', 'Hmm\r\n', '2017-06-10', 17);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `rentan` int(3) NOT NULL,
  `denda` int(11) NOT NULL,
  `peminjaman` int(3) NOT NULL,
  `toleransi` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`rentan`, `denda`, `peminjaman`, `toleransi`) VALUES
(2, 500, 5, '3');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id_token` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id_token`, `token`, `id_user`, `created`) VALUES
(26, '9340e4baf97ff1a216b30ae671d808', 2, '2017-05-27'),
(27, 'd8596f3dccf31f760ba63ba70ca48d', 2, '2017-05-27'),
(28, 'cfdd8ae943bdbd306fe5417377bec7', 2, '2017-05-27'),
(29, '3bb89008054e42a1c43e2665294bca', 2, '2017-05-27'),
(30, '4dc704e3fd8e957480fb98bff6fbd7', 2, '2017-05-27'),
(31, 'a42c3f0310ff4e445e32950f8346cf', 2, '2017-05-27'),
(32, '73270466fdc6152bef87b10288aa8c', 2, '2017-05-27'),
(33, 'a0de941f31fc6f81ca38a2266a2e75', 2, '2017-05-27'),
(34, '415643bedf6ea5f7709b5f5f64efca', 2, '2017-05-27'),
(35, 'e99773cc4205626a0e1a71c2be0ec9', 2, '2017-05-27'),
(36, '4cc106e5dd883e2b844497bf69b552', 2, '2017-05-27'),
(37, 'f2c759159174281041736cd967a02a', 2, '2017-05-27'),
(38, '2e9b03ec43700a03dbb184a435edeb', 2, '2017-05-28'),
(39, '868a67203f2b02f0f8da6d70e02f41', 2, '2017-05-28'),
(40, 'a4ac8cfa9f0848eb03381981709669', 2, '2017-05-28'),
(41, '58d6b2e7abc3bc6670a4e089272f81', 2, '2017-06-01'),
(42, 'e70dd90801b9471f163c649f6abf95', 2, '2017-06-02'),
(43, 'fda41b49ec15d743e73fe3eb05d798', 2, '2017-06-02'),
(44, 'a94123e17c5e24dedbfc3a284304c9', 2, '2017-06-02'),
(45, '5205c9b6cd624265719561b2b3f307', 2, '2017-06-02'),
(46, '663d46b8221abd247afaff6113f1cc', 16, '2017-06-02'),
(47, '26658dffbac24826c878fb84541e63', 2, '2017-06-04'),
(48, 'f0595ccf66db268afcc05619ce2e2e', 2, '2017-06-04'),
(49, 'dcc18de9bb15da2aca2400becc85d9', 2, '2017-06-04'),
(50, '3f660ddabdf0b3404f560ebd94c635', 2, '2017-06-09'),
(51, '7f9348ebade2d0f2ab05b9b1b6851c', 2, '2017-06-10'),
(52, 'b6a37f80b7a8cb319eb9b0bde0fc62', 2, '2017-06-17'),
(53, '7120c2b2a5a9bc81cc37a20be92bcc', 2, '2017-06-17'),
(54, '24dca8a943f47e115f30a8374dbdab', 2, '2017-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_identitas` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `no_identitas`, `email`, `no_hp`, `username`, `password`, `jenis_kelamin`, `alamat`, `foto`, `status`) VALUES
(1, 'Admin', 1, 'admin@admin.com', '085233233770', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Laki-laki', 'Admin', '3fa3a5f25e72ac8876b5c72ca0a1b312.png', 'admin'),
(2, 'Budi Purwanto', 11111, 'budi.purwanto15@gmail.com', '08523322770', 'budi', 'eecba96bd7dda234fcf173c62aa38a84', 'Laki-laki', 'Pasuruan', '1.jpg', 'admin'),
(13, 'Musdari', 1541180153, 'musdari844@gmail.com', '08523322770', 'musdari', 'a16f44a48ff0543c5ea7844d536c8a39', 'Laki-laki', 'Malang', 'Screenshot_(76).png', 'admin'),
(14, 'Zangga', 1541180042, 'zangga@gmail.com', '08523322770', 'zangga', '093dfdf777f39160394fa5c2406f2e33', 'Laki-laki', 'Zangga', 'Screenshot_(76)1.png', 'user'),
(16, 'Dell', 1541180017, 'dani@gmial.com', '08523322770', 'dell', 'a3d24b555bc2ee180607ef34377d8996', 'Laki-laki', 'dell', 'Screenshot_from_2017-05-18_14-55-301.png', 'user'),
(17, 'Toshiba', 1541180223, 'toshiba@gmail.com', '096123232322', 'toshiba', '4ff91e76d84ade3951324d764d4c89a2', 'Laki-laki', 'Toshiba', '5fa79fb5430dded18ce32b1f5c062104.jpg', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`ip`, `tanggal`, `hits`, `online`) VALUES
('::1', '2017-05-18', 22, '1495126537'),
('172.69.69.01', '2017-05-18', 1, '134431'),
('::1', '2017-05-19', 5, '1495211269'),
('::1', '2017-05-20', 6, '1495317285'),
('::1', '2017-05-21', 30, '1495397035'),
('::1', '2017-05-22', 13, '1495490180'),
('::1', '2017-05-23', 3, '1495566395'),
('::1', '2017-05-24', 10, '1495649111'),
('::1', '2017-05-25', 1, '1495665704'),
('::1', '2017-05-26', 1, '1495754667'),
('::1', '2017-05-27', 49, '1495922114'),
('::1', '2017-05-28', 43, '1496008717'),
('::1', '2017-05-29', 14, '1496081057'),
('::1', '2017-05-30', 25, '1496163702'),
('::1', '2017-05-31', 9, '1496255714'),
('::1', '2017-06-01', 15, '1496344952'),
('::1', '2017-06-02', 24, '1496432961'),
('::1', '2017-06-03', 34, '1496515378'),
('::1', '2017-06-04', 27, '1496607652'),
('::1', '2017-06-05', 7, '1496694766'),
('::1', '2017-06-06', 3, '1496754809'),
('::1', '2017-06-07', 18, '1496858394'),
('::1', '2017-06-08', 2, '1496934005'),
('::1', '2017-06-09', 43, '1497032654'),
('::1', '2017-06-10', 14, '1497119107'),
('192.168.2.254', '2017-06-10', 3, '1497120240'),
('192.168.2.253', '2017-06-10', 3, '1497122751'),
('::1', '2017-06-11', 3, '1497211778'),
('::1', '2017-06-13', 7, '1497386424'),
('::1', '2017-06-14', 6, '1497464971'),
('::1', '2017-06-15', 2, '1497557199'),
('127.0.0.1', '2017-06-17', 8, '1497731365'),
('127.0.0.1', '2017-06-18', 3, '1497739482'),
('::1', '2017-06-18', 8, '1497819396'),
('::1', '2017-06-19', 4, '1497875977'),
('::1', '2017-06-20', 2, '1497990483');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indexes for table `buku_pengarang`
--
ALTER TABLE `buku_pengarang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_pengarang` (`id_pengarang`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`no_identitas`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_kembali`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id_report`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `no_identitas` (`no_identitas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku_pengarang`
--
ALTER TABLE `buku_pengarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`),
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `buku_pengarang`
--
ALTER TABLE `buku_pengarang`
  ADD CONSTRAINT `buku_pengarang_ibfk_1` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`),
  ADD CONSTRAINT `buku_pengarang_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`),
  ADD CONSTRAINT `pengembalian_ibfk_3` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`no_identitas`) REFERENCES `identitas` (`no_identitas`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
