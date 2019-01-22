-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2019 at 04:39 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pembelian`
--

-- --------------------------------------------------------

--
-- Table structure for table `cek_barang`
--

CREATE TABLE `cek_barang` (
  `id_cek` int(5) NOT NULL,
  `kode_pembelian` varchar(8) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cek_barang`
--

INSERT INTO `cek_barang` (`id_cek`, `kode_pembelian`, `jumlah`, `ket`, `id_user`) VALUES
(1, 'TR000001', 4, 'OK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `id_user`) VALUES
(1, 'Busa Kasur', 1),
(2, 'Bantal', 1),
(3, 'Sprey', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(8) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `kode_pembelian` varchar(8) NOT NULL,
  `id_user` int(5) NOT NULL,
  `jumlah_bayar` int(12) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `tgl_pembayaran`, `kode_pembelian`, `id_user`, `jumlah_bayar`, `ket`) VALUES
(11, '2019-01-09', 'TR000001', 1, 500000, 'Pembayaran ke 1'),
(12, '2019-01-09', 'TR000001', 1, 500000, 'Pembayaran ke 2'),
(13, '2019-01-10', 'TR000001', 1, 30700000, '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kode_pembelian` varchar(8) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `id_supplier` int(5) NOT NULL,
  `lama_tempo` int(3) NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `total_jumlah` int(10) NOT NULL,
  `total_harga` int(12) NOT NULL,
  `sisa_pembayaran` int(12) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_user` int(3) NOT NULL,
  `tanggal_buat` date NOT NULL,
  `id_user_edit` int(3) NOT NULL,
  `tanggal_edit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`kode_pembelian`, `tgl_pembelian`, `id_supplier`, `lama_tempo`, `jatuh_tempo`, `total_jumlah`, `total_harga`, `sisa_pembayaran`, `status`, `id_user`, `tanggal_buat`, `id_user_edit`, `tanggal_edit`) VALUES
('TR000001', '2019-01-09', 2, 30, '2019-02-08', 4, 31700000, 0, 'lunas', 1, '2019-01-09', 1, '2019-01-10'),
('TR000002', '2019-01-10', 3, 30, '2019-02-09', 2, 15850000, 0, 'hutang', 1, '2019-01-10', 1, '2019-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id_detail` int(5) NOT NULL,
  `kode_pembelian` varchar(8) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_detail`, `kode_pembelian`, `id_produk`, `harga`, `jumlah`, `subtotal`) VALUES
(1, 'TR000001', 1, 15800000, 2, 31600000),
(2, 'TR000001', 2, 50000, 2, 100000),
(3, 'TR000002', 2, 50000, 1, 50000),
(4, 'TR000002', 1, 15800000, 1, 15800000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_temp`
--

CREATE TABLE `pembelian_temp` (
  `id_temp` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `stok` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `id_kategori`, `satuan`, `stok`, `harga`, `ukuran`, `deskripsi`, `id_user`) VALUES
(1, 'Busa Kasur', 1, 'lbr', -15799980, 15800000, '30x180x200', 'Warna Hijau', 1),
(2, 'Sprey', 3, 'pcs', -49990, 50000, '-', 'Kuning Polos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(5) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `no_telp`, `id_user`) VALUES
(1, 'PT DUA BERSODARA', 'Tangerang', '021-5951810', 1),
(2, 'PT ARYA SENTOSA', ' Banten', '021-5105210', 1),
(3, 'PT MAJU BERSAMA', 'Jakarta', '021-1103521', 1),
(4, 'PT SATU DUA TIGA', 'Bandung', '021-8810530', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `alamat`, `password`, `level`) VALUES
(1, 'admin', 'Iqbal Rizqi Purnama', 'Tangerang', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin'),
(2, 'pimpi', 'Roy', 'Tangerang', '59335c9f58c78597ff73f6706c6c8fa278e08b3a', 'pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cek_barang`
--
ALTER TABLE `cek_barang`
  ADD PRIMARY KEY (`id_cek`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kode_pembelian`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `pembelian_temp`
--
ALTER TABLE `pembelian_temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cek_barang`
--
ALTER TABLE `cek_barang`
  MODIFY `id_cek` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pembelian_temp`
--
ALTER TABLE `pembelian_temp`
  MODIFY `id_temp` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
