-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 02:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(10) NOT NULL,
  `userid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `userid`) VALUES
(20, 28),
(21, 33),
(22, 34),
(23, 35),
(24, 36),
(26, 37);

-- --------------------------------------------------------

--
-- Table structure for table `cartinfo`
--

CREATE TABLE `cartinfo` (
  `cartid` int(10) NOT NULL,
  `productid` int(10) NOT NULL,
  `count` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cartinfo`
--

INSERT INTO `cartinfo` (`cartid`, `productid`, `count`) VALUES
(20, 5, 1),
(22, 32, 1),
(23, 3, 1),
(20, 4, 1),
(20, 6, 1),
(24, 5, 1),
(24, 6, 1),
(24, 7, 1),
(25, 3, 5),
(25, 5, 1),
(26, 3, 2),
(26, 56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `EMstatus` varchar(30) NOT NULL,
  `countOrder` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `lastname`, `gender`, `phone`, `EMstatus`, `countOrder`) VALUES
(8912, 'สหวุฒิ', 'บุญยืน', 'ชาย', '0927373320', 'ผู้จัดการ', 0),
(10131, 'วิศรุต', 'จันทร์ดาตุ่ย', 'ชาย', '0968833400', 'พนักงานส่ง', 0),
(10132, 'สุภาวรรณ', 'บุตระ', 'หญิง', '0655197843', 'พนักงานส่ง', 0),
(10133, 'ศุภณัฏฐ์', ' จั่นวิลัย', 'ชาย', '0610105454', 'ผู้จัดการ', 0),
(10134, 'ชัยธินิน ', 'รัตนทารส', 'ชาย', '0628945615', 'พนักงานส่ง', 0),
(10135, 'เจษฎา ', 'ชาติแพงตา', 'ชาย', '0835981585', 'พนักงานส่ง', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(3) NOT NULL,
  `typeid` int(3) NOT NULL,
  `brandid` int(3) NOT NULL,
  `PDname` varchar(50) NOT NULL,
  `price` int(7) NOT NULL,
  `count` int(3) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `typeid`, `brandid`, `PDname`, `price`, `count`, `picture`, `info`) VALUES
(2, 1, 1, 'LG GN-C222SLC', 8700, 49, '5fa3f0450dc6d7.23366225.jpg', '5fa4396b1430a9.35897699.txt'),
(3, 7, 1, 'LG 24MT48VF', 3900, 100, '5fa3f06bb199b1.70165602.jpg', '5fa439da072e07.71237001.txt'),
(4, 2, 1, 'LG WP-1650WST', 7690, 0, '5fa3f0c4acfd81.15835834.jpg', '5fa43a45b8c7a2.84248466.txt'),
(5, 6, 5, 'Toshiba ER-SM20(W)TH', 1490, 14, '5fa3f0f1ac1fa4.58710085.jpg', '5fa43a8f4da120.91060016.txt'),
(6, 4, 2, 'SAMSUNG AR13MRF', 12900, 8, '5fa3f1234ce9c7.22549862.jpg', '5fa3f2dd17fd80.31452205.txt'),
(7, 2, 5, 'TOSHIBA AW-A750', 5200, 12, '5f9ea43aa74589.06228217.jpg', '5fa43ada7e61a5.58207109.txt'),
(8, 5, 6, 'PANASONIC NI-27A', 850, 15, '5f9ea4683d7966.58706893.jpg', '5f9ea4683dd3f7.23323102.txt'),
(19, 1, 9, 'HITACHI R-20NP', 4590, 9, '5f9ea4a705a736.94187403.jpg', '5f9ea4a7066137.04829130.txt'),
(25, 3, 10, 'HATARI HB-S16M4', 820, 12, '5fa047f2f3c9f3.40325786.jpg', '5fa047f3000f04.00173202.txt'),
(26, 4, 2, 'SAMSUNG  AR10TYHZCWKNST', 11990, 900, '5fa3fb57ec5a58.82032777.jpg', '5fa3fd53110869.56116226.txt'),
(27, 7, 1, 'LG 70UN7300PTC', 35000, 35, '5fa43c4ce97542.41630350.jpg', '5fa43c4ce9dd15.33645656.txt'),
(28, 7, 1, ' LG 75UK6500PTB', 44900, 24, '5fa43cfa6cad94.69657569.jpg', '5fa43cfa6d33d7.62448472.txt'),
(29, 7, 2, 'Samsung QA75Q800TA', 130000, 2, '5fa43d83269f53.82872172.jpg', '5fa43d8326d6e1.32472583.txt'),
(30, 7, 2, 'Samsung QA65Q80TA', 42000, 16, '5fa43dfe23a1f7.25887054.jpg', '5fa43dfe23dda2.72460219.txt'),
(31, 7, 2, 'Samsung QA65Q950TS', 103000, 6, '5fa43eccb912f3.96695558.jpg', '5fa43eccb96ba7.57949074.txt'),
(32, 7, 3, 'SONY 85Z8H', 206000, 3, '5fa446aa9528b7.63578341.jpg', '5fa43f4ebd6754.68849388.txt'),
(33, 7, 3, 'SONY 65X9500H', 53000, 8, '5fa44057ad1b86.97903797.jpg', '5fa43ff27ad308.05460608.txt'),
(34, 7, 4, 'SHARP 4T-C70AH1X', 22900, 64, '5fa4410b0f1163.60364688.jpg', '5fa4410b0f84c9.61819937.txt'),
(35, 7, 6, 'PANASONIC 75HX600T', 32299, 54, '5fa4419052dd54.94117701.jpg', '5fa44190535855.68849359.txt'),
(36, 7, 7, 'philip 43PFT4002S/67', 9900, 29, '5fa44230a16e34.39906963.jpg', '5fa44230a1de62.71341755.txt'),
(37, 7, 5, 'Toshiab 43L3750VT ', 8700, 500, '5fa447b665ee28.75366884.jpg', '5fa447b6665e84.47663453.txt'),
(38, 1, 8, ' Mitsubishi MR-V46EP-ST', 12000, 5, '5fa44877b624e5.46344644.jpg', '5fa44877b697b4.93614024.txt'),
(39, 1, 8, 'Mitsubishi MR-FV22P', 6000, 51, '5fa449af33d3c3.77460460.jpg', '5fa449af345023.54244871.txt'),
(40, 1, 4, 'Sharp SJ-X330TC-SL', 11530, 0, '5fa44a5d74b955.74556893.jpg', '5fa44a5d751a16.22013832.txt'),
(41, 1, 4, 'Sharp SJ-FX79T', 36990, 58, '5fa44b0e43e184.31546803.jpg', '5fa44b0e444ba6.20555989.txt'),
(42, 6, 5, 'Toshiba MW2-AG24PC(BK)', 3100, 99, '5fa44c11d2ec29.58988105.jpg', '5fa44c11d34a02.55268886.txt'),
(43, 1, 5, ' Toshiba GR-B22KPSS', 5600, 8, '5fa44c46e2c134.62475046.jpg', '5fa44c46e301c3.90626132.txt'),
(44, 6, 4, 'SHARP R-220 ', 1990, 101, '5fa44c67426803.16003147.jpg', '5fa44c6742d6a8.72397481.txt'),
(45, 6, 4, 'SHARP R-29D1', 3390, 122, '5fa44cc093ba06.02015851.jpg', '5fa44cc09437e0.24406579.txt'),
(46, 6, 6, 'Pana NN-GD692S', 3000, 0, '5fa44d203fd1a2.46897449.jpg', '5fa44d20401429.96232523.txt'),
(47, 1, 6, 'PANASONIC NR-CY550AKTH ', 60000, 80, '5fa44d29947b82.33438767.jpg', '5fa44d2994b634.58346842.txt'),
(48, 6, 6, 'Pana NN-ST342M', 3990, 23, '5fa44d70c11d81.07550290.jpg', '5fa44d70c16106.05136300.txt'),
(49, 6, 1, 'LG MH-6324DAR', 2000, 0, '5fa44dbd16be40.46554500.jpg', '5fa44dbd1711d5.30102433.txt'),
(50, 2, 9, 'HITACHI PS-100LJ', 6900, 15, '5fa44ddd278891.35643591.jpg', '5fa44ddd280809.64013929.txt'),
(51, 6, 1, 'LG MS2843BAR', 3000, 0, '5fa44dfdde8c75.25106531.jpg', '5fa44dfddf2178.63652436.txt'),
(52, 5, 7, 'philip GC9622', 13500, 14, '5fa44e757098f8.70526853.jpg', '5fa44e757121d7.27721032.txt'),
(53, 5, 7, 'philip GC3811', 2590, 52, '5fa44edf981761.54082995.jpg', '5fa44edf985ea3.79349369.txt'),
(54, 4, 5, 'TOSHIBA RAS-18PKSG-T', 18500, 23, '5fa44fb05f8821.95744605.jpg', '5fa44fb05ff109.93444983.txt'),
(55, 4, 4, 'SHARP AH-PGX10', 15200, 45, '5fa45066b6bad3.12423584.jpg', '5fa45066b70ea1.85595495.txt'),
(56, 2, 6, ' Panasonic NA-VX93GL', 21000, 50, '5fa450ce574435.26978518.jpg', '5fa450ce57a7b6.32400316.txt'),
(57, 4, 6, 'PANASONIC CS-PN18SKT', 21700, 5, '5fa450fa06f230.69012499.jpg', '5fa450fa077135.21782116.txt'),
(58, 4, 6, 'PANASONIC CS-PU18SKT', 25100, 17, '5fa4517f8a4bc8.52204792.jpg', '5fa4517f8ab786.24383179.txt'),
(59, 2, 4, ' SHARP ES-W11HT-SL', 8690, 26, '5fa4528d4cd486.48145870.jpg', '5fa4528d4d19d5.93111754.txt'),
(60, 4, 8, 'MITSUBISHI HEAVY DUTY SRK-19CNS', 23900, 24, '5fa452960f46f7.49009214.jpg', '5fa452960fbb32.25346690.txt'),
(61, 4, 9, 'HITACHI RAS-X30HGT', 48000, 5, '5fa45351f2bd26.39986102.jpg', '5fa45351f30627.39235064.txt'),
(62, 4, 9, 'HITACHI RAS-S10CGT', 14500, 90, '5fa4543b24dbd1.98395206.jpg', '5fa4543b255bc1.70359679.txt'),
(63, 3, 10, 'HATARI HT-S18M2', 1190, 260, '5fa454c71680c5.01429002.jpg', '5fa454c716f9e8.30352124.txt'),
(64, 3, 4, 'SHARP PJ-TA181', 540, 300, '5fa4559a7c1f84.13453199.jpg', '5fa4559a7c9154.90700427.txt');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `brandid` int(3) NOT NULL,
  `pdbrand` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`brandid`, `pdbrand`) VALUES
(1, 'LG'),
(2, 'Samsung'),
(3, 'Sony'),
(4, 'Sharp'),
(5, 'Toshiba'),
(6, 'Panasonic'),
(7, 'Philips'),
(8, 'Mitsubishi'),
(9, 'Hitachi'),
(10, 'Hatari');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `typeid` int(3) NOT NULL,
  `pdtype` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`typeid`, `pdtype`) VALUES
(1, 'ตู้เย็น'),
(2, 'เครื่องซักผ้า'),
(3, 'พัดลม'),
(4, 'เครื่องปรับอากาศ'),
(5, 'เตารีด'),
(6, 'ไมโครเวฟ'),
(7, 'ทีวี');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sellid` int(3) NOT NULL,
  `userid` int(5) NOT NULL,
  `date` varchar(8) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `idEmployee` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sellid`, `userid`, `date`, `status`, `idEmployee`) VALUES
(55, 33, '05/11/20', 'ส่งแล้ว', 10131),
(56, 34, '05/11/20', 'ส่งแล้ว', 10134),
(57, 35, '06/11/20', 'กำลังดำเนินการ', 10135);

-- --------------------------------------------------------

--
-- Table structure for table `sellinfo`
--

CREATE TABLE `sellinfo` (
  `sellid` int(5) NOT NULL,
  `pdid` int(5) NOT NULL,
  `price` int(6) NOT NULL,
  `count` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sellinfo`
--

INSERT INTO `sellinfo` (`sellid`, `pdid`, `price`, `count`) VALUES
(55, 8, 850, 1),
(55, 6, 12900, 1),
(55, 4, 7690, 1),
(56, 6, 12900, 2),
(56, 2, 8700, 1),
(57, 5, 1490, 1),
(57, 4, 7690, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `userid` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(300) NOT NULL,
  `email` varchar(50) NOT NULL,
  `PhonNumber` int(10) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`userid`, `username`, `name`, `lastname`, `gender`, `address`, `email`, `PhonNumber`, `password`) VALUES
(29, 'yyyy', 'kanyanut', 'Phaungngern', 'หญิง', '376/8', 'kang.mayin2000@hotmail.com', 830143264, 'c2968b3c1c3500158385552dc9a1e836'),
(30, 'Thanakorn', 'ธนากรณ์', 'สุขสำราญ', 'ชาย', '91/27 จ.ฉะเชิงเทรา อ.เมือง ต.บางตีนเป็ด หมู่ 13', 'Thanakorn.sook12@gmail.com', 928415903, 'e10adc3949ba59abbe56e057f20f883e'),
(31, 'web1334', 'Web', 'greentea', 'ชาย', '9999999', 'sahawut1334@gmail.com', 999999999, '8edd72158ccd2a879f79cb2538568fdc'),
(33, 'Suppanut55', 'ศุภณัฎฐ์', ' จั่นวิลัย', 'ชาย', 'บ้านเลขที่9 ซอย4 ถนน.เทศา ต.พระปฐมเจดีย์\r\nอ.เมือง จ.นครปฐม', 'terkub8142@gmail.com', 610105454, '51351a9d782e7aade34e198cadc199a1'),
(34, 'Pacha', 'ปองพล', 'ดีดำ', 'ชาย', 'บ้านเลข6 ต.ดอนหวาย อ.เมือง จ.นครปฐม ', 'suppanut2543@gmail.com', 685432110, 'e10adc3949ba59abbe56e057f20f883e'),
(35, 'test2', 'สหวุฒิ', 'บุญยืน', 'ชาย', '376/8 ต.หน้าเมือง', 'wgtwgtwgt1@gmail.com', 892471815, '81dc9bdb52d04dc20036dbd8313ed055'),
(37, 'WebGreenTea', 'Sahawut ', 'Boonyurn', 'ชาย', '376/8\r\nหน้าเมือง', 'sahawut092013@gmail.com', 892471815, '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sellid`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10137;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `brandid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `typeid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sellid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
