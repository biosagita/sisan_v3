-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2015 pada 22.42
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `antrian_fresh`
--
CREATE DATABASE IF NOT EXISTS `antrian_fresh` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `antrian_fresh`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_adminuserlevel`
--

CREATE TABLE IF NOT EXISTS `anf_adminuserlevel` (
  `aulv_id` int(11) NOT NULL AUTO_INCREMENT,
  `aulv_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `aulv_entryuser` varchar(100) CHARACTER SET latin1 NOT NULL,
  `aulv_entrydate` datetime NOT NULL,
  `aulv_changeuser` varchar(100) CHARACTER SET latin1 NOT NULL,
  `aulv_changedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aulv_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `anf_adminuserlevel`
--

INSERT INTO `anf_adminuserlevel` (`aulv_id`, `aulv_name`, `aulv_entryuser`, `aulv_entrydate`, `aulv_changeuser`, `aulv_changedate`) VALUES
(1, 'Admin', '', '0000-00-00 00:00:00', '', '2015-03-08 04:24:14'),
(2, 'Counter', '', '0000-00-00 00:00:00', '', '2015-03-14 13:37:34'),
(3, 'Demo', '', '0000-00-00 00:00:00', '', '2015-03-08 04:24:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_adminusers`
--

CREATE TABLE IF NOT EXISTS `anf_adminusers` (
  `admusr_id` int(3) NOT NULL AUTO_INCREMENT,
  `admusr_username` varchar(60) DEFAULT NULL,
  `admusr_userpasswd` varchar(255) DEFAULT NULL,
  `admusr_userdesc` varchar(100) DEFAULT NULL,
  `admusr_aulv_id` int(11) DEFAULT NULL,
  `admusr_usrgro_id` int(11) NOT NULL,
  `admusr_user_status` enum('y','n') DEFAULT 'y',
  `admusr_entryuser` varchar(100) NOT NULL,
  `admusr_entrydate` datetime NOT NULL,
  `admusr_changeuser` varchar(100) NOT NULL,
  `admusr_changedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`admusr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data untuk tabel `anf_adminusers`
--

INSERT INTO `anf_adminusers` (`admusr_id`, `admusr_username`, `admusr_userpasswd`, `admusr_userdesc`, `admusr_aulv_id`, `admusr_usrgro_id`, `admusr_user_status`, `admusr_entryuser`, `admusr_entrydate`, `admusr_changeuser`, `admusr_changedate`) VALUES
(24, 'andy', 'da41bceff97b1cf96078ffb249b3d66e', NULL, 1, 0, 'y', '', '0000-00-00 00:00:00', '', '2015-03-07 03:20:41'),
(2, 'insan', '527b81568234d9d90f7f5477e14ca9b0', 'superadministrator', 1, 0, 'y', '', '0000-00-00 00:00:00', '', '2015-01-30 08:09:45'),
(40, 'kampret', 'b6ecbac45c48a94105a88bf44a9eaf46', NULL, 2, 2, 'y', '', '0000-00-00 00:00:00', '', '2015-03-15 05:55:15'),
(26, 'cobananti', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 3, 3, 'y', '', '0000-00-00 00:00:00', '', '2015-03-12 20:33:45'),
(25, 'test', '098f6bcd4621d373cade4e832627b4f6', NULL, 2, 1, 'y', '', '0000-00-00 00:00:00', '', '2015-03-12 20:24:54'),
(34, 'joey', 'b59c67bf196a4758191e42f76670ceba', NULL, 2, 2, 'y', '', '0000-00-00 00:00:00', '', '2015-03-14 06:56:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_applicationmodules`
--

CREATE TABLE IF NOT EXISTS `anf_applicationmodules` (
  `appmod_id` int(11) NOT NULL AUTO_INCREMENT,
  `appmod_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `appmod_type` varchar(20) CHARACTER SET latin1 NOT NULL,
  `appmod_desc` text CHARACTER SET latin1 NOT NULL,
  `appmod_link` varchar(100) CHARACTER SET latin1 NOT NULL,
  `appmod_entryuser` varchar(100) CHARACTER SET latin1 NOT NULL,
  `appmod_entrydate` datetime NOT NULL,
  `appmod_changeuser` varchar(100) CHARACTER SET latin1 NOT NULL,
  `appmod_changedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`appmod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `anf_applicationmodules`
--

INSERT INTO `anf_applicationmodules` (`appmod_id`, `appmod_name`, `appmod_type`, `appmod_desc`, `appmod_link`, `appmod_entryuser`, `appmod_entrydate`, `appmod_changeuser`, `appmod_changedate`) VALUES
(1, 'Backend Application Modules', 'backend', 'Semua module backend / frontend yang ada di aplikasi ini', 'backend_applicationmodules', '', '0000-00-00 00:00:00', '', '2015-03-12 21:02:26'),
(2, 'Backend Admin', 'backend', 'Membuat user admin baru', 'backend_admin', '', '0000-00-00 00:00:00', '', '2015-03-12 21:03:44'),
(3, 'Backend Admin Level', 'backend', 'Membuat admin user level baru', 'backend_adminlevel', '', '0000-00-00 00:00:00', '', '2015-03-12 21:04:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_callers`
--

CREATE TABLE IF NOT EXISTS `anf_callers` (
  `call_id` int(11) NOT NULL AUTO_INCREMENT,
  `call_address` int(11) DEFAULT NULL,
  `call_lokets_id` int(11) DEFAULT NULL,
  `call_status_off` bit(2) DEFAULT NULL,
  PRIMARY KEY (`call_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `anf_callers`
--

INSERT INTO `anf_callers` (`call_id`, `call_address`, `call_lokets_id`, `call_status_off`) VALUES
(1, 99, 1, b'00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_companyprofile`
--

CREATE TABLE IF NOT EXISTS `anf_companyprofile` (
  `comprf_id` int(2) NOT NULL AUTO_INCREMENT,
  `comprf_code` varchar(10) NOT NULL,
  `comprf_name` varchar(100) NOT NULL,
  `comprf_address1` varchar(150) NOT NULL,
  `comprf_address2` varchar(150) NOT NULL,
  `comprf_city` varchar(100) NOT NULL,
  `comprf_post_code` int(9) NOT NULL,
  `comprf_phone` varchar(50) NOT NULL,
  `comprf_fax` varchar(50) NOT NULL,
  `comprf_entryuser` varchar(100) NOT NULL,
  `comprf_entrydate` datetime NOT NULL,
  `comprf_changeuser` varchar(100) NOT NULL,
  `comprf_changedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comprf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `anf_companyprofile`
--

INSERT INTO `anf_companyprofile` (`comprf_id`, `comprf_code`, `comprf_name`, `comprf_address1`, `comprf_address2`, `comprf_city`, `comprf_post_code`, `comprf_phone`, `comprf_fax`, `comprf_entryuser`, `comprf_entrydate`, `comprf_changeuser`, `comprf_changedate`) VALUES
(5, '', 'Company 1', 'Kemang', 'Pancoran', 'Jakarta', 112233, '0814567', '556677', '', '0000-00-00 00:00:00', '', '2015-01-30 10:46:56'),
(6, '', 'Company 2', 'Bali', 'Kuta', 'Bali', 12342, '0811334', '55345', '', '0000-00-00 00:00:00', '', '2015-01-30 11:15:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_counter_display`
--

CREATE TABLE IF NOT EXISTS `anf_counter_display` (
  `coudis_id_counter_display` int(11) NOT NULL AUTO_INCREMENT,
  `coudis_address_cd` int(11) DEFAULT NULL,
  `coudis_id_loket` int(11) DEFAULT NULL,
  PRIMARY KEY (`coudis_id_counter_display`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `anf_counter_display`
--

INSERT INTO `anf_counter_display` (`coudis_id_counter_display`, `coudis_address_cd`, `coudis_id_loket`) VALUES
(1, 995, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_grouplokets`
--

CREATE TABLE IF NOT EXISTS `anf_grouplokets` (
  `grolok_id` int(10) NOT NULL AUTO_INCREMENT,
  `grolok_name` varchar(100) NOT NULL,
  `grolok_desc` text NOT NULL,
  PRIMARY KEY (`grolok_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `anf_grouplokets`
--

INSERT INTO `anf_grouplokets` (`grolok_id`, `grolok_name`, `grolok_desc`) VALUES
(1, 'Group Loket 1', 'Keterangan 11'),
(2, 'Group Loket 2', 'Keterangan group loket 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_group_layanan`
--

CREATE TABLE IF NOT EXISTS `anf_group_layanan` (
  `grolay_id_group_layanan` int(10) NOT NULL AUTO_INCREMENT,
  `grolay_nama_group_layanan` varchar(100) NOT NULL,
  `grolay_no_awal` varchar(50) NOT NULL,
  `grolay_no_start` int(10) NOT NULL,
  `grolay_no_end` int(10) NOT NULL,
  `grolay_jml_tiket` int(10) NOT NULL,
  `grolay_keterangan` text NOT NULL,
  `grolay_status_reg` int(11) NOT NULL,
  PRIMARY KEY (`grolay_id_group_layanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `anf_group_layanan`
--

INSERT INTO `anf_group_layanan` (`grolay_id_group_layanan`, `grolay_nama_group_layanan`, `grolay_no_awal`, `grolay_no_start`, `grolay_no_end`, `grolay_jml_tiket`, `grolay_keterangan`, `grolay_status_reg`) VALUES
(1, 'Group Layanan Umum', 'A', 1, 100, 1, '', 0),
(2, 'Group Layanan MTBS', 'B', 101, 199, 2, '', 0),
(3, 'Group Layanan Gigi', 'C', 200, 299, 4, '', 0),
(4, 'Group Layanan KIA', 'D', 300, 399, 1, '', 0),
(5, 'Group Layanan KB', 'X', 400, 499, 1, '', 0),
(6, 'Group Layanan Lansia', 'Y', 500, 599, 1, '', 0),
(7, 'Group Layanan PKPR', 'Z', 600, 699, 1, '', 0),
(8, 'Group Layanan RB', 'M', 700, 799, 1, '', 0),
(9, 'Group Layanan UGD', 'E', 800, 899, 1, 'Test', 0),
(10, 'Group Layanan Test', 'F', 900, 999, 1, 'Test aja', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_layanan`
--

CREATE TABLE IF NOT EXISTS `anf_layanan` (
  `lay_id_layanan` int(10) NOT NULL AUTO_INCREMENT,
  `lay_nama_layanan` varchar(100) NOT NULL,
  `lay_id_group_layanan` int(10) NOT NULL,
  `lay_layanan_status` smallint(2) NOT NULL DEFAULT '0',
  `lay_id_layanan_forward` int(10) NOT NULL,
  `lay_stok` int(10) NOT NULL,
  `lay_status_barcode` tinyint(2) NOT NULL,
  `lay_status_popup` tinyint(2) NOT NULL,
  `lay_estimasi` int(10) NOT NULL,
  `lay_id_waktu_layanan` int(10) NOT NULL,
  `lay_keterangan` text NOT NULL,
  PRIMARY KEY (`lay_id_layanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `anf_layanan`
--

INSERT INTO `anf_layanan` (`lay_id_layanan`, `lay_nama_layanan`, `lay_id_group_layanan`, `lay_layanan_status`, `lay_id_layanan_forward`, `lay_stok`, `lay_status_barcode`, `lay_status_popup`, `lay_estimasi`, `lay_id_waktu_layanan`, `lay_keterangan`) VALUES
(1, 'Poli MTBS', 1, 1, 0, 10, 0, 0, 5, 1, 'Keterangan Aja'),
(2, 'Poli PKPR', 7, 1, 1, 20, 0, 1, 15, 1, 'Keterangan lagi'),
(3, 'Poli PKPRX', 10, 1, 0, 0, 0, 1, 0, 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_lokets`
--

CREATE TABLE IF NOT EXISTS `anf_lokets` (
  `lokets_id` int(10) NOT NULL AUTO_INCREMENT,
  `lokets_type` varchar(100) NOT NULL,
  `lokets_name` varchar(100) NOT NULL,
  `lokets_grolok_id` int(10) NOT NULL,
  `lokets_status` int(10) NOT NULL,
  `lokets_ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`lokets_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `anf_lokets`
--

INSERT INTO `anf_lokets` (`lokets_id`, `lokets_type`, `lokets_name`, `lokets_grolok_id`, `lokets_status`, `lokets_ip_address`) VALUES
(1, 'MTBS', 'Loket 1', 1, 0, '192.168.1.48'),
(2, 'Loket Type 2', 'Loket 2', 2, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_loket_log`
--

CREATE TABLE IF NOT EXISTS `anf_loket_log` (
  `loklog_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `loklog_user_id` int(9) NOT NULL DEFAULT '0' COMMENT 'User ID from table User',
  `loklog_lokets_id` int(11) NOT NULL,
  `loklog_login_date` datetime NOT NULL COMMENT 'Login Date & time',
  `loklog_login_ip` varchar(50) NOT NULL,
  `loklog_logout_date` datetime NOT NULL,
  PRIMARY KEY (`loklog_log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Logs for User Login' AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `anf_loket_log`
--

INSERT INTO `anf_loket_log` (`loklog_log_id`, `loklog_user_id`, `loklog_lokets_id`, `loklog_login_date`, `loklog_login_ip`, `loklog_logout_date`) VALUES
(1, 40, 1, '2015-03-15 16:48:31', '127.0.0.1', '2015-03-15 16:48:47'),
(2, 24, 1, '2015-03-15 16:49:53', '127.0.0.1', '0000-00-00 00:00:00'),
(3, 24, 1, '2015-03-15 16:51:10', '127.0.0.1', '2015-03-15 16:51:41'),
(4, 40, 1, '2015-03-16 22:05:26', '127.0.0.1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_prioritas_layanan`
--

CREATE TABLE IF NOT EXISTS `anf_prioritas_layanan` (
  `prilay_id_prioritas` int(11) NOT NULL AUTO_INCREMENT,
  `prilay_id_group_loket` int(11) DEFAULT NULL,
  `prilay_id_group_layanan` int(11) DEFAULT NULL,
  `prilay_prioritas` int(11) DEFAULT NULL,
  `prilay_keterangan` text,
  PRIMARY KEY (`prilay_id_prioritas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `anf_prioritas_layanan`
--

INSERT INTO `anf_prioritas_layanan` (`prilay_id_prioritas`, `prilay_id_group_loket`, `prilay_id_group_layanan`, `prilay_prioritas`, `prilay_keterangan`) VALUES
(1, 1, 1, 2, 'Test aja'),
(2, 1, 2, 2, '2'),
(3, 1, 10, 1, '1'),
(4, 1, 4, 2, '3'),
(5, 1, 3, 3, '6'),
(6, 2, 10, 3, '18'),
(7, 2, 7, 2, 'Demo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_roleaccess`
--

CREATE TABLE IF NOT EXISTS `anf_roleaccess` (
  `rolacc_id` int(11) NOT NULL AUTO_INCREMENT,
  `rolacc_aulv_id` int(11) NOT NULL,
  `rolacc_appmod_id` int(11) NOT NULL,
  `rolacc_create` bit(2) NOT NULL,
  `rolacc_read` bit(2) NOT NULL,
  `rolacc_update` bit(2) NOT NULL,
  `rolacc_delete` bit(2) NOT NULL,
  `rolacc_entryuser` varchar(100) CHARACTER SET latin1 NOT NULL,
  `rolacc_entrydate` datetime NOT NULL,
  `rolacc_changeuser` varchar(100) CHARACTER SET latin1 NOT NULL,
  `rolacc_changedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rolacc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `anf_roleaccess`
--

INSERT INTO `anf_roleaccess` (`rolacc_id`, `rolacc_aulv_id`, `rolacc_appmod_id`, `rolacc_create`, `rolacc_read`, `rolacc_update`, `rolacc_delete`, `rolacc_entryuser`, `rolacc_entrydate`, `rolacc_changeuser`, `rolacc_changedate`) VALUES
(1, 3, 1, b'00', b'00', b'00', b'00', '', '0000-00-00 00:00:00', '', '2015-03-12 21:02:40'),
(2, 1, 1, b'00', b'00', b'00', b'00', '', '0000-00-00 00:00:00', '', '2015-03-12 21:02:53'),
(3, 1, 2, b'00', b'00', b'00', b'00', '', '0000-00-00 00:00:00', '', '2015-03-12 21:04:52'),
(4, 1, 3, b'00', b'00', b'00', b'00', '', '0000-00-00 00:00:00', '', '2015-03-12 21:05:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_running_text`
--

CREATE TABLE IF NOT EXISTS `anf_running_text` (
  `runtex_id_running_text` int(10) NOT NULL AUTO_INCREMENT,
  `runtex_text` varchar(100) NOT NULL,
  `runtex_created_date` varchar(20) NOT NULL,
  `runtex_modified_date` varchar(20) NOT NULL,
  `runtex_start_date` varchar(20) NOT NULL,
  `runtex_expired_date` varchar(20) NOT NULL,
  `runtex_keterangan` text NOT NULL,
  PRIMARY KEY (`runtex_id_running_text`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `anf_running_text`
--

INSERT INTO `anf_running_text` (`runtex_id_running_text`, `runtex_text`, `runtex_created_date`, `runtex_modified_date`, `runtex_start_date`, `runtex_expired_date`, `runtex_keterangan`) VALUES
(1, 'KENYAMANAN ANDA MERUPAKAN PRIORITAS UTAMA KAMI', '2014-11-12', '2014-11-13', '2014-11-14', '2014-11-15', 'Keterangan Aja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_setting`
--

CREATE TABLE IF NOT EXISTS `anf_setting` (
  `sett_id_setting` int(10) NOT NULL AUTO_INCREMENT,
  `sett_setting` varchar(255) NOT NULL,
  `sett_nilai` varchar(100) NOT NULL,
  `sett_keterangan` text NOT NULL,
  `sett_type_input` varchar(100) NOT NULL,
  `sett_refer_table` varchar(100) NOT NULL,
  `sett_status` int(11) NOT NULL,
  PRIMARY KEY (`sett_id_setting`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1001 ;

--
-- Dumping data untuk tabel `anf_setting`
--

INSERT INTO `anf_setting` (`sett_id_setting`, `sett_setting`, `sett_nilai`, `sett_keterangan`, `sett_type_input`, `sett_refer_table`, `sett_status`) VALUES
(1, 'Port Counter Display', '11', 'Hardware', '', '', 0),
(2, 'Baudrate Counter Display', '2', 'Hardware', '', '', 1),
(3, 'volume video', '18', 'Display', 'slider', '', 1),
(4, 'text speed', '49', 'Display', 'slider', '', 1),
(5, 'touch screen', '5', 'Screen', '', '', 1),
(6, 'LCD Display', '6', 'Screen', '', '', 1),
(7, 'form2', '7', 'Screen', '', '', 1),
(8, 'port console', '4', 'Hardware', '', '', 1),
(9, 'baudrate console', '19200', 'Hardware', '', '', 1),
(100, 'Port Printer', '8', 'Printer', '', '', 1),
(101, 'baudrate Printer', '19', 'Printer', '', '', 1),
(200, 'Shutdown', '07:32:00', 'Utility', 'timespinner', '', 1),
(11, 'Port Button', '37', 'Hardware', 'slider', '', 1),
(12, 'Baudrate button', '19200', 'Hardware', '', '', 1),
(102, 'lebar printer', '2405', 'Printer', '', '', 1),
(500, 'Tv', '800 x 600', 'Apaaja', 'refertable', 'demo_table', 1),
(1000, 'Direktori Image Transaksi', 'D:\\Private\\Foto\\', 'Direktori', '', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_transaksi`
--

CREATE TABLE IF NOT EXISTS `anf_transaksi` (
  `trans_id_transaksi` int(10) NOT NULL AUTO_INCREMENT,
  `trans_tanggal_transaksi` int(20) NOT NULL,
  `trans_waktu_ambil` time NOT NULL,
  `trans_waktu_panggil` time NOT NULL DEFAULT '00:00:00',
  `trans_no_ticket_awal` char(50) NOT NULL DEFAULT '0',
  `trans_no_ticket` int(10) NOT NULL DEFAULT '0',
  `trans_id_layanan` int(10) NOT NULL DEFAULT '0',
  `trans_id_group_layanan` int(10) NOT NULL DEFAULT '0',
  `trans_status_transaksi` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0: wait, 1: next, 2: call, 3: skip, 5: finish',
  `trans_id_user` int(10) NOT NULL DEFAULT '0',
  `trans_id_loket` int(10) NOT NULL DEFAULT '0',
  `trans_id_visitor` int(10) NOT NULL DEFAULT '0',
  `trans_id_caller` int(10) NOT NULL DEFAULT '0',
  `trans_waktu_finish` time NOT NULL DEFAULT '00:00:00',
  `trans_nama_file` varchar(100) NOT NULL,
  PRIMARY KEY (`trans_id_transaksi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data untuk tabel `anf_transaksi`
--

INSERT INTO `anf_transaksi` (`trans_id_transaksi`, `trans_tanggal_transaksi`, `trans_waktu_ambil`, `trans_waktu_panggil`, `trans_no_ticket_awal`, `trans_no_ticket`, `trans_id_layanan`, `trans_id_group_layanan`, `trans_status_transaksi`, `trans_id_user`, `trans_id_loket`, `trans_id_visitor`, `trans_id_caller`, `trans_waktu_finish`, `trans_nama_file`) VALUES
(1, 20141228, '15:00:27', '15:00:53', 'A', 1, 1, 1, 2, 24, 1, 0, 0, '15:01:22', ''),
(2, 20141228, '15:00:30', '00:00:00', 'C', 200, 3, 3, 0, 0, 0, 0, 0, '00:00:00', ''),
(3, 20141228, '15:00:37', '15:01:22', 'A', 2, 1, 1, 2, 24, 1, 0, 0, '15:02:29', ''),
(4, 20141228, '15:00:40', '15:06:10', 'C', 201, 3, 3, 5, 24, 1, 0, 0, '15:06:37', ''),
(5, 20141228, '15:05:40', '15:06:37', 'A', 3, 1, 1, 2, 24, 1, 0, 0, '15:06:52', ''),
(6, 20141228, '15:05:43', '00:00:00', 'A', 4, 1, 1, 0, 0, 0, 0, 0, '00:00:00', ''),
(7, 20141228, '15:05:46', '00:00:00', 'A', 5, 1, 1, 0, 0, 0, 0, 0, '00:00:00', ''),
(8, 20141228, '15:05:49', '00:00:00', 'C', 202, 3, 3, 0, 0, 0, 0, 0, '00:00:00', ''),
(9, 20141230, '21:24:07', '21:25:38', 'A', 1, 1, 1, 2, 24, 1, 0, 0, '21:26:48', ''),
(10, 20141230, '21:24:11', '22:00:17', 'A', 2, 1, 1, 2, 24, 1, 0, 0, '22:03:01', ''),
(11, 20141230, '21:24:14', '00:00:00', 'C', 200, 3, 3, 0, 0, 0, 0, 0, '00:00:00', ''),
(12, 20141231, '00:21:25', '00:30:25', 'A', 1, 1, 1, 2, 24, 1, 0, 0, '00:30:34', ''),
(13, 20141231, '00:21:30', '00:32:29', 'A', 2, 1, 1, 2, 24, 1, 0, 0, '00:32:45', ''),
(14, 20141231, '00:21:33', '00:00:00', 'C', 200, 3, 3, 0, 0, 0, 0, 0, '00:00:00', ''),
(15, 20141231, '00:21:37', '00:00:00', 'C', 201, 3, 3, 0, 0, 0, 0, 0, '00:00:00', ''),
(16, 20141231, '00:21:40', '00:00:00', 'A', 3, 1, 1, 0, 0, 0, 0, 0, '00:00:00', ''),
(17, 20150219, '17:10:34', '17:22:20', 'A', 1, 1, 1, 2, 24, 1, 0, 0, '17:22:25', '1407134447167.jpg'),
(18, 20150219, '17:10:39', '17:21:37', 'A', 2, 1, 1, 2, 24, 1, 0, 0, '17:21:40', ''),
(19, 20150219, '17:10:42', '17:21:57', 'A', 3, 1, 1, 5, 24, 1, 0, 0, '17:22:06', '1407134447167.jpg'),
(20, 20150219, '17:10:48', '17:21:40', 'A', 4, 1, 1, 5, 24, 1, 0, 0, '17:21:44', ''),
(21, 20150219, '17:10:52', '17:18:10', 'A', 5, 1, 1, 5, 24, 1, 0, 0, '17:19:54', '1407134447167.jpg'),
(22, 20150309, '17:54:02', '19:52:54', 'A', 1, 1, 1, 5, 0, 1, 0, 0, '19:53:02', ''),
(23, 20150309, '17:54:08', '19:53:02', 'A', 2, 1, 1, 5, 0, 1, 0, 0, '19:53:12', ''),
(24, 20150309, '17:54:13', '19:53:12', 'A', 3, 1, 1, 5, 0, 1, 0, 0, '19:53:23', ''),
(25, 20150309, '17:54:17', '19:57:27', 'C', 200, 3, 3, 5, 0, 1, 0, 0, '19:59:38', ''),
(31, 20150315, '14:03:12', '15:58:57', 'A', 6, 1, 1, 5, 0, 1, 0, 0, '16:00:02', ''),
(32, 20150315, '15:54:13', '00:00:00', 'A', 5, 2, 7, 0, 0, 0, 0, 0, '00:00:00', ''),
(33, 20150315, '15:57:55', '00:00:00', 'A', 4, 2, 7, 0, 0, 0, 0, 0, '00:00:00', ''),
(30, 20150315, '14:03:07', '15:54:01', 'A', 5, 1, 1, 5, 0, 1, 0, 0, '15:54:13', ''),
(26, 20150315, '14:02:47', '15:35:13', 'A', 1, 1, 1, 5, 0, 1, 0, 0, '15:35:43', ''),
(27, 20150315, '14:02:53', '15:35:55', 'A', 2, 1, 1, 5, 0, 1, 0, 0, '15:37:45', ''),
(28, 20150315, '14:02:57', '15:47:54', 'A', 3, 1, 1, 5, 0, 1, 0, 0, '15:50:49', ''),
(29, 20150315, '14:03:01', '15:57:46', 'A', 4, 1, 1, 5, 0, 1, 0, 0, '15:57:55', ''),
(34, 20150315, '16:00:02', '00:00:00', 'A', 6, 2, 7, 0, 0, 0, 0, 0, '00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_user_group`
--

CREATE TABLE IF NOT EXISTS `anf_user_group` (
  `usrgro_id` int(10) NOT NULL AUTO_INCREMENT,
  `usrgro_nama_user_group` varchar(100) NOT NULL,
  PRIMARY KEY (`usrgro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `anf_user_group`
--

INSERT INTO `anf_user_group` (`usrgro_id`, `usrgro_nama_user_group`) VALUES
(1, 'User Group 1'),
(2, 'User Group 2'),
(3, 'User Group 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_user_group_layanan`
--

CREATE TABLE IF NOT EXISTS `anf_user_group_layanan` (
  `usrgrolay_id` int(10) NOT NULL AUTO_INCREMENT,
  `usrgrolay_usrgro_id` varchar(100) NOT NULL,
  `usrgrolay_grolay_id` varchar(100) NOT NULL,
  PRIMARY KEY (`usrgrolay_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `anf_user_group_layanan`
--

INSERT INTO `anf_user_group_layanan` (`usrgrolay_id`, `usrgrolay_usrgro_id`, `usrgrolay_grolay_id`) VALUES
(1, '1', '1'),
(2, '1', '2'),
(3, '1', '3'),
(4, '2', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_user_log`
--

CREATE TABLE IF NOT EXISTS `anf_user_log` (
  `usrlog_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `usrlog_user_id` int(9) NOT NULL DEFAULT '0' COMMENT 'User ID from table User',
  `usrlog_login_date` datetime NOT NULL COMMENT 'Login Date & time',
  `usrlog_login_ip` varchar(50) NOT NULL DEFAULT ' ' COMMENT 'Login IP Address',
  `usrlog_logout_date` datetime NOT NULL,
  PRIMARY KEY (`usrlog_log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Logs for User Login' AUTO_INCREMENT=27 ;

--
-- Dumping data untuk tabel `anf_user_log`
--

INSERT INTO `anf_user_log` (`usrlog_log_id`, `usrlog_user_id`, `usrlog_login_date`, `usrlog_login_ip`, `usrlog_logout_date`) VALUES
(1, 24, '2015-03-15 04:19:31', '127.0.0.1', '0000-00-00 00:00:00'),
(2, 24, '2015-03-15 10:03:51', '127.0.0.1', '2015-03-15 10:04:47'),
(3, 40, '2015-03-15 10:19:03', '127.0.0.1', '2015-03-15 10:44:21'),
(4, 24, '2015-03-15 10:44:32', '127.0.0.1', '2015-03-15 10:44:57'),
(5, 24, '2015-03-15 10:51:24', '127.0.0.1', '2015-03-15 10:52:14'),
(6, 24, '2015-03-15 11:05:33', '127.0.0.1', '2015-03-15 11:17:36'),
(7, 40, '2015-03-15 11:21:22', '127.0.0.1', '2015-03-15 12:13:06'),
(8, 24, '2015-03-15 12:13:21', '127.0.0.1', '2015-03-15 12:14:21'),
(9, 40, '2015-03-15 12:14:31', '127.0.0.1', '2015-03-15 12:14:41'),
(10, 24, '2015-03-15 12:15:44', '127.0.0.1', '2015-03-15 12:18:12'),
(11, 24, '2015-03-15 12:18:57', '127.0.0.1', '2015-03-15 12:19:01'),
(12, 24, '2015-03-15 12:20:05', '127.0.0.1', '2015-03-15 12:20:22'),
(13, 40, '2015-03-15 12:20:34', '127.0.0.1', '2015-03-15 12:25:06'),
(14, 24, '2015-03-15 12:26:21', '127.0.0.1', '2015-03-15 12:43:20'),
(15, 40, '2015-03-15 12:43:31', '127.0.0.1', '2015-03-15 12:43:44'),
(16, 40, '2015-03-15 12:45:05', '127.0.0.1', '2015-03-15 12:45:21'),
(17, 24, '2015-03-15 12:46:25', '127.0.0.1', '2015-03-15 12:49:03'),
(18, 24, '2015-03-15 12:49:27', '127.0.0.1', '2015-03-15 12:51:04'),
(19, 24, '2015-03-15 12:51:50', '127.0.0.1', '2015-03-15 12:56:33'),
(20, 24, '2015-03-15 12:57:01', '127.0.0.1', '2015-03-15 12:58:27'),
(21, 24, '2015-03-15 12:59:23', '127.0.0.1', '2015-03-15 13:01:57'),
(22, 40, '2015-03-15 13:02:03', '127.0.0.1', '2015-03-15 16:33:28'),
(23, 40, '2015-03-15 16:48:31', '127.0.0.1', '2015-03-15 16:48:47'),
(24, 24, '2015-03-15 16:49:53', '127.0.0.1', '0000-00-00 00:00:00'),
(25, 24, '2015-03-15 16:51:10', '127.0.0.1', '2015-03-15 16:51:41'),
(26, 40, '2015-03-16 22:05:26', '127.0.0.1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_video`
--

CREATE TABLE IF NOT EXISTS `anf_video` (
  `vid_id_video` int(10) NOT NULL AUTO_INCREMENT,
  `vid_nama_video` varchar(255) NOT NULL,
  `vid_desc` text NOT NULL,
  PRIMARY KEY (`vid_id_video`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `anf_video`
--

INSERT INTO `anf_video` (`vid_id_video`, `vid_nama_video`, `vid_desc`) VALUES
(7, 'blank_user.jpg', 'test yo'),
(8, 'Jacinta-Fish_1.JPG', 'keterangan aja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anf_waktu_layanan`
--

CREATE TABLE IF NOT EXISTS `anf_waktu_layanan` (
  `waklay_id_waktu_layanan` int(11) NOT NULL AUTO_INCREMENT,
  `waklay_waktu_awal_1` time DEFAULT NULL,
  `waklay_waktu_akhir_1` time DEFAULT NULL,
  `waklay_waktu_awal_2` time DEFAULT NULL,
  `waklay_waktu_akhir_2` time DEFAULT NULL,
  `waklay_waktu_awal_3` time DEFAULT NULL,
  `waklay_waktu_akhir_3` time DEFAULT NULL,
  `waklay_keterangan` text,
  PRIMARY KEY (`waklay_id_waktu_layanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `anf_waktu_layanan`
--

INSERT INTO `anf_waktu_layanan` (`waklay_id_waktu_layanan`, `waklay_waktu_awal_1`, `waklay_waktu_akhir_1`, `waklay_waktu_awal_2`, `waklay_waktu_akhir_2`, `waklay_waktu_awal_3`, `waklay_waktu_akhir_3`, `waklay_keterangan`) VALUES
(1, '05:00:00', '09:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 'Keterangan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
