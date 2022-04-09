-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 Des 2020 pada 12.36
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ewshz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id_admin` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `level` varchar(50) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `no_hp` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `pass`, `level`, `nama_lengkap`, `no_hp`) VALUES
(1, 'User RSDH', 'rsdh@gmail.com', 'rsdh123', 'rsdh', 'Rumah Sakit Dr.Hafiz', '89630458220'),
(2, 'Hz', 'hafizurrachman@gmail.com', 'hafiz123', 'admin', 'Super Admin', ''),
(5, 'root', 'root@mail.com', 'root', 'admin', '', ''),
(6, 'SMK BPC', 'smk@mail.com', 'smk123', 'smk', 'SMK BPC', '0'),
(7, 'TK BPC', 'tk@gmail.com', 'tk123', 'tk', 'TK BPC', '0'),
(8, 'SD BCP', 'sd@gmail.com', 'sd123', 'sd', 'SD BPC', '0'),
(9, 'SMP BPC', 'smp@gmail.com', 'smp123', 'smp', 'SMP BPC', '0'),
(10, 'Bengkel Buana', 'bengkel@gmail.com', 'bengkel123', 'bengkel', 'Bengkel Buana', '0'),
(11, 'HZ Mart', 'hz@gmail.com', 'hz123', 'hz', 'HZ Mart', '0'),
(12, 'STIKES Cianjur', 'stikes@gmail.com', 'stikes123', 'stikes', 'Stikes Cianjur', '0'),
(13, 'STIKIM/STIKOM', 'stikim@gmail.com', 'stikim123', 'stikim', 'STIKIM/STIKOM', '0'),
(14, 'Doha Jaya', 'doha@gmail.com', 'doha123', 'doha-jaya', 'Doha Jaya', '0'),
(15, 'Yayasan Masjid', 'yayasan@gmail..com', 'yayasan123', 'yayasan', 'Yayasan Masjid', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alert_message`
--

CREATE TABLE IF NOT EXISTS `alert_message` (
`id` int(11) NOT NULL,
  `penerima` text NOT NULL,
  `tanggal_pesan` varchar(50) NOT NULL,
  `jam_pesan` varchar(20) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `alert_message`
--

INSERT INTO `alert_message` (`id`, `penerima`, `tanggal_pesan`, `jam_pesan`, `isi_pesan`, `status`) VALUES
(1, 'rsdh', '2020/12/19', '10:00', 'Kesalahan pada tanggal 27 jan 2020 perbaiki !!', 'on');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
`id_karyawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` varchar(40) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `umur` int(11) NOT NULL,
  `kontak` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
`id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(150) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `keterangan_kegiatan` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `id_perusahaan`, `keterangan_kegiatan`) VALUES
(1, 'BPJS', 1, 'pemasukan'),
(2, 'Rawat Inap', 1, 'pemasukan'),
(3, 'Rawat Jalan', 1, 'pemasukan'),
(4, 'Listrik', 1, 'pengeluaran'),
(5, 'Gaji Karyawan', 1, 'pengeluaran'),
(6, 'Internet', 1, 'pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE IF NOT EXISTS `pemasukan` (
`id_pemasukan` int(11) NOT NULL,
  `tgl_pemasukan` varchar(50) NOT NULL,
  `jam_pemasukan` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_perusahaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE IF NOT EXISTS `pengeluaran` (
`id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` varchar(50) NOT NULL,
  `jam_pengeluaran` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_perusahaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE IF NOT EXISTS `perusahaan` (
`id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(40) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `keterangan`) VALUES
(1, 'rsdh', 'Rumah Sakit Dr Hafiz Cianjur'),
(2, 'stikim', 'Sekolah Tinggi Ilmu Kesehatan Indonesia Maju Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber`
--

CREATE TABLE IF NOT EXISTS `sumber` (
`id_sumber` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `keterangan` varchar(15) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data untuk tabel `sumber`
--

INSERT INTO `sumber` (`id_sumber`, `nama`, `keterangan`) VALUES
(1, 'Kegiatan A', 'pemasukan'),
(2, 'Kegiatan B', 'pemasukan'),
(3, 'Kegiatan C', 'pemasukan'),
(4, 'Kegiatan D', 'pemasukan'),
(5, 'Kegiatan E', 'pemasukan'),
(6, 'Kegiatan F', 'pemasukan'),
(7, 'Kegiatan G', 'pemasukan'),
(8, 'Kegiatan H', 'pemasukan'),
(9, 'Kegiatan I', 'pemasukan'),
(10, 'Kegiatan J', 'pemasukan'),
(11, 'Gaji Karyawan', 'pengeluaran'),
(12, 'Listrik', 'pengeluaran'),
(13, 'Internet', 'pengeluaran'),
(14, 'Belanja ATK', 'pengeluaran'),
(15, 'Belanja Kertas', 'pengeluaran'),
(16, 'Belanja Keperluan Jilid', 'pengeluaran'),
(17, 'Service Alat Print', 'pengeluaran'),
(18, 'Service Mesin FC', 'pengeluaran'),
(19, 'Belanja Tinta Printer', 'pengeluaran'),
(20, 'Belanja Tinta Foto Copy', 'pengeluaran'),
(21, 'Lain-Lain', 'pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahan_hapus_pemasukan`
--

CREATE TABLE IF NOT EXISTS `tahan_hapus_pemasukan` (
`id` int(11) NOT NULL,
  `id_pemasukan` int(11) NOT NULL,
  `tgl_pemasukan` varchar(50) NOT NULL,
  `jam_pemasukan` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_perusahaan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahan_hapus_pengeluaran`
--

CREATE TABLE IF NOT EXISTS `tahan_hapus_pengeluaran` (
`id` int(11) NOT NULL,
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` varchar(50) NOT NULL,
  `jam_pengeluaran` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_perusahaan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahan_ubah_pemasukan`
--

CREATE TABLE IF NOT EXISTS `tahan_ubah_pemasukan` (
`id` int(11) NOT NULL,
  `id_pemasukan` int(11) NOT NULL,
  `tgl_pemasukan` varchar(50) NOT NULL,
  `jam_pemasukan` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_perusahaan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahan_ubah_pengeluaran`
--

CREATE TABLE IF NOT EXISTS `tahan_ubah_pengeluaran` (
`id` int(11) NOT NULL,
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` varchar(50) NOT NULL,
  `jam_pengeluaran` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_perusahaan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE IF NOT EXISTS `tahun` (
`id` int(11) NOT NULL,
  `tahun` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`id`, `tahun`) VALUES
(2, '2021'),
(3, '2022'),
(4, '2023'),
(5, '2024'),
(6, '2025'),
(7, '2026'),
(8, '2027'),
(9, '2028'),
(10, '2029'),
(11, '2030'),
(12, '2031'),
(13, '2032'),
(14, '2033'),
(15, '2034'),
(16, '2035'),
(17, '2036'),
(18, '2037'),
(19, '2038'),
(20, '2039'),
(21, '2040'),
(22, '2041'),
(23, '2042'),
(24, '2043'),
(25, '2044'),
(26, '2045'),
(27, '2046'),
(28, '2047'),
(29, '2048'),
(30, '2049'),
(31, '2050');

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang`
--

CREATE TABLE IF NOT EXISTS `uang` (
`id_uang` int(11) NOT NULL,
  `tgl_uang` date NOT NULL,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `id_pendapatan` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `uang`
--

INSERT INTO `uang` (`id_uang`, `tgl_uang`, `id_pengeluaran`, `id_pendapatan`, `jumlah`) VALUES
(1, '2019-10-23', NULL, 1, 500000),
(2, '2019-10-24', 2, NULL, 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alert_message`
--
ALTER TABLE `alert_message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
 ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
 ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
 ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
 ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
 ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `sumber`
--
ALTER TABLE `sumber`
 ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `tahan_hapus_pemasukan`
--
ALTER TABLE `tahan_hapus_pemasukan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahan_hapus_pengeluaran`
--
ALTER TABLE `tahan_hapus_pengeluaran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahan_ubah_pemasukan`
--
ALTER TABLE `tahan_ubah_pemasukan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahan_ubah_pengeluaran`
--
ALTER TABLE `tahan_ubah_pengeluaran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uang`
--
ALTER TABLE `uang`
 ADD PRIMARY KEY (`id_uang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `alert_message`
--
ALTER TABLE `alert_message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sumber`
--
ALTER TABLE `sumber`
MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tahan_hapus_pemasukan`
--
ALTER TABLE `tahan_hapus_pemasukan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tahan_hapus_pengeluaran`
--
ALTER TABLE `tahan_hapus_pengeluaran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tahan_ubah_pemasukan`
--
ALTER TABLE `tahan_ubah_pemasukan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tahan_ubah_pengeluaran`
--
ALTER TABLE `tahan_ubah_pengeluaran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `uang`
--
ALTER TABLE `uang`
MODIFY `id_uang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
