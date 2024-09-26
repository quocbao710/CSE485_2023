-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 02:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btth01_cse485`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_BaiViet_delete` (IN `ma_bviet` INT)   BEGIN
    DELETE FROM baiviet WHERE baiviet.ma_bviet = ma_bviet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_BaiViet_getAll` ()   BEGIN
    SELECT
        bv.ma_bviet, bv.tieude, bv.ten_bhat, tl.ten_tloai, bv.tomtat, bv.noidung, tg.ten_tgia, bv.ngayviet, bv.hinhanh
    FROM baiviet bv
    JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
    JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_BaiViet_getById` (IN `ma_bviet` INT)   BEGIN
    SELECT * FROM baiviet WHERE baiviet.ma_bviet = ma_bviet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_BaiViet_insert` (IN `tieude` VARCHAR(200), IN `ten_bhat` VARCHAR(100), IN `ma_tloai` INT, IN `tomtat` TEXT, IN `noidung` TEXT, IN `ma_tgia` INT, IN `hinhanh` VARCHAR(200))   BEGIN
    INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh) VALUES (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_BaiViet_update` (IN `ma_bviet` INT, IN `tieude` VARCHAR(200), IN `ten_bhat` VARCHAR(100), IN `ma_tloai` INT, IN `tomtat` TEXT, IN `noidung` TEXT, IN `ma_tgia` INT, IN `hinhanh` VARCHAR(200))   BEGIN
    UPDATE baiviet bv SET bv.tieude = tieude, bv.ten_bhat = ten_bhat, bv.ma_tloai = ma_tloai, bv.tomtat = tomtat, bv.noidung = noidung, bv.ma_tgia = ma_tgia, bv.hinhanh = hinhanh WHERE bv.ma_bviet = ma_bviet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DSBaiViet` (IN `ten_tloai` VARCHAR(50))   BEGIN
    DECLARE ma_tloai INT;
    SELECT ma_tloai INTO ma_tloai FROM theloai WHERE ten_tloai = ten_tloai;
    IF ma_tloai IS NULL THEN
        SELECT "Thể loại không tồn tại!";
    ELSE
        SELECT * FROM baiviet WHERE ma_tloai = ma_tloai;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Login` (IN `username` VARCHAR(50), IN `password` VARCHAR(100))   BEGIN
    SELECT * FROM Users WHERE Users.username = username AND Users.password = password;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TacGia_delete` (IN `ma_tgia` INT)   BEGIN
    DELETE FROM tacgia WHERE tacgia.ma_tgia = ma_tgia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TacGia_getAll` ()   BEGIN
    SELECT * FROM tacgia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TacGia_getById` (IN `ma_tgia` INT)   BEGIN
    SELECT * FROM tacgia tg WHERE tg.ma_tgia = ma_tgia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TacGia_insert` (IN `ten_tgia` VARCHAR(100), IN `hinh_tgia` VARCHAR(100))   BEGIN
    INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (ten_tgia, hinh_tgia);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TacGia_update` (IN `ma_tgia` INT, IN `ten_tgia` VARCHAR(100), IN `hinh_tgia` VARCHAR(100))   BEGIN
    UPDATE tacgia tg SET tg.ten_tgia = ten_tgia, tg.hinh_tgia = hinh_tgia WHERE tg.ma_tgia = ma_tgia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TheLoai_delete` (IN `ma_tloai` INT)   BEGIN
    DELETE FROM theloai WHERE theloai.ma_tloai = ma_tloai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TheLoai_getAll` ()   BEGIN
    SELECT * FROM theloai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TheLoai_getById` (IN `ma_tloai` INT)   BEGIN
    SELECT * FROM theloai tl WHERE tl.ma_tloai = ma_tloai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TheLoai_getByName` (IN `ten_tloai` VARCHAR(50))   BEGIN
    SELECT * FROM theloai tl WHERE tl.ten_tloai = ten_tloai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TheLoai_insert` (IN `ten_tloai` VARCHAR(50))   BEGIN
    INSERT INTO theloai (ten_tloai) VALUES (ten_tloai);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TheLoai_update` (IN `ma_tloai` INT, IN `ten_tloai` VARCHAR(50))   BEGIN
    UPDATE theloai tl SET tl.ten_tloai = ten_tloai WHERE tl.ma_tloai = ma_tloai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_User_login` (IN `username` VARCHAR(50), IN `password` VARCHAR(100))   BEGIN
    SELECT * FROM Users WHERE Users.username = username AND Users.password = password;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `baiviet`
--

CREATE TABLE `baiviet` (
  `ma_bviet` int(10) UNSIGNED NOT NULL,
  `tieude` varchar(200) NOT NULL,
  `ten_bhat` varchar(100) NOT NULL,
  `ma_tloai` int(10) UNSIGNED NOT NULL,
  `tomtat` text NOT NULL,
  `noidung` text DEFAULT NULL,
  `ma_tgia` int(10) UNSIGNED NOT NULL,
  `ngayviet` datetime DEFAULT current_timestamp(),
  `hinhanh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baiviet`
--

INSERT INTO `baiviet` (`ma_bviet`, `tieude`, `ten_bhat`, `ma_tloai`, `tomtat`, `noidung`, `ma_tgia`, `ngayviet`, `hinhanh`) VALUES
(1, 'Lòng mẹ', 'Lòng mẹ', 2, 'Và mẹ ơi đừng khóc nhé! Cả đời này mẹ đã khóc nhiều lắm rồi, hãy cười lên vì con đã trưởng thành! Con sẽ lại về dậy sớm nấu cơm cho mẹ, nấu nước cho mẹ tắm như ngày xưa. “Dù cho vai nắng nhưng lòng thương chẳng nhạt màu, vẫn mơ quay về vui vầy dưới bóng mẹ yêu”', NULL, 1, '2012-07-23 00:00:00', NULL),
(2, 'Cảm ơn em đã rời xa anh', 'Vết mưa', 2, 'Cảm ơn em đã cho anh những tháng ngày hạnh phúc, cho anh biết yêu và được yêu. Em cho anh được nếm trải hương vị ngọt ngào của tình yêu nhưng cũng đầy đau khổ và nước mắt. Những tháng ngày đó có lẽ suốt cuộc đời anh không bao giờ quên', NULL, 3, '2012-02-12 00:00:00', NULL),
(3, 'Cuộc đời có mấy ngày mai?', 'Phôi pha', 2, 'Đêm nay, trời quang mây tạnh, trong người nghe hoang vắng và tôi ngồi đây “Ôm lòng đêm, Nhìn vầng trăng mới về” mà ngậm ngùi “Nhớ chân giang hồ. Ôi phù du, từng tuổi xuân đã già”', NULL, 4, '2014-03-13 00:00:00', NULL),
(4, 'Quê tôi!', 'Quê hương', 5, 'Quê hương là gì mà chở đầy kí ức nhỏ xinh. Có đám trẻ nô đùa bên nhau dưới gốc ổi nhà bà Năm giữa trưa nắng gắt chỉ để chờ bà đi vắng là hái trộm. Có hai anh em tôi bì bõm lội sình bắt cua đem về nhà cho mẹ nấu canh, nấu cháo… Có ba chị em tôi lục đục tự nấu ăn khi mẹ vắng nhà. Có anh tôi luôn dắt tôi đi cùng đường ngõ xóm chỉ để em được vui. Có cả những trận cãi nhau nảy lửa của ba anh em nữa…', NULL, 5, '2014-02-20 00:00:00', NULL),
(5, 'Đất nước', 'Đất nước', 5, 'Đã bao nhiêu lần tôi tự hỏi: liệu trên Thế giới này có nơi nào chiến tranh tang thương mà lại rất đổi anh hùng như nước mình không? Liệu có mảnh đất nào mà mỗi tấc đất hôm nay đã thấm máu xương của những thế hệ đi trước nhiều như nước mình không? Và, liệu có một đất nước nào lại có nhiều bà mẹ đau khổ nhưng cũng hết sức gan góc như đất nước mình không?', NULL, 1, '2010-05-25 00:00:00', NULL),
(6, 'Hard Rock Hallelujah', 'Hard Rock Hallelujah', 7, 'Những linh hồn đang lạc lối, mù quáng mất phương hướng trong cõi trần gian đầy nghiệt ngã hãy nên lắng nghe \"Hard Rock Hallelujah\" để có thể quên tất cả mọi thứ để tìm về đúng bản chất sâu thẳm nhất trong tâm hồn chính mình!', NULL, 6, '2013-09-12 00:00:00', NULL),
(7, 'The Unforgiven', 'The Unforgiven', 7, 'Lâu lắm rồi mới nghe lại The Unforgiven II, vì bài này không phải là bài mà tôi thích. Anh bạn tôi lúc trước, đi đâu cũng nghêu ngao bài này ấy, chỉ tại vì hắn đang... thất tình mà lị. Mà sao Metallica có The Unforgiven rồi lại có thêm bài này chi nữa vậy không biết nữa, làm cho tôi cảm thấy hình như hơi bị đúng so với tâm trạng của tôi lúc này.', NULL, 1, '2010-05-25 00:00:00', NULL),
(8, 'Nơi tình yêu bắt đầu', 'Nơi tình yêu bắt đầu', 1, 'Nhiều người sẽ nghĩ làm gì có yêu nhất và làm gì có yêu mãi. Ừ! Chẳng có gì là mãi mãi cả, vì chúng ta không trường tồn vĩnh cửu', NULL, 1, '2014-02-03 00:00:00', NULL),
(9, 'Love Me Like There’s No Tomorrow', 'Love Me Like There’s No Tomorrow', 8, 'Nếu ai đã từng yêu Queen, yêu cái chất giọng cao, sắc sảo như một vết cắt thật ngọt ẩn giấu bao cảm xúc mãnh liệt của Freddie chắc không thể không \"điêu đứng\" mỗi khi nghe Love Me Like There’s No Tomorrow.', NULL, 1, '2013-02-26 00:00:00', NULL),
(10, 'I\'m stronger', 'I\'m stronger', 7, 'Em không phải là người giỏi giấu cảm xúc, nhưng em lại là người giỏi đoán biết cảm xúc của người khác vậy nên đừng cố nói nhớ em, rằng mọi thứ chỉ là do hoàn cảnh. Và cũng đừng dối em rằng anh đã từng yêu em. Em nhắm mắt cũng cảm nhận được mà, thật đấy', NULL, 2, '2013-08-21 00:00:00', NULL),
(11, 'Ôi Cuộc Sống Mến Thương', 'Ôi Cuộc Sống Mến Thương', 5, 'Có một câu nói như thế này \"Âm nhạc là một cái gì khác lạ mà hầu như tôi muốn nói nó là một phép thần diệu.Vì nó đứng giữa tư tưởng và hiện tượng, tinh thần và vật chất, mọi thứ trung gian mơ hồ thế đó mà không là thế đó giữa các sự vật mà âm nhạc hòa giải\"', NULL, 2, '2011-10-09 00:00:00', NULL),
(12, 'Cây và gió', 'Cây và gió', 7, 'Em và anh, hai đứa quen nhau thật tình cờ. Lời hát của anh từ bài hát “Cây và gió” đã làm tâm hồn em xao động. Nhưng sự thật phũ phàng rằng em chưa bao giờ nói cho anh biết những suy nghĩ tận sâu trong tim mình. Bởi vì em nhút nhát, em không dám đối mặt với thực tế khắc nghiệt, hay thực ra em không dám đối diện với chính mình.', NULL, 7, '2013-12-05 00:00:00', NULL),
(13, 'Như một cách tạ ơn đời', 'Người thầy', 2, 'Ánh nắng cuối ngày rồi cũng sẽ tắt, dòng sông con đò rồi cũng sẽ rẽ sang một hướng khác. Nhưng việc trồng người luôn cảm thụ với chuyến đò ngang, cứ tần tảo đưa rồi lặng lẽ quay về đưa sang. Con đò năm xưa của Thầy nặng trĩu yêu thương, hy sinh thầm lặng.', NULL, 8, '2014-01-02 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `ma_tgia` int(10) UNSIGNED NOT NULL,
  `ten_tgia` varchar(100) NOT NULL,
  `hinh_tgia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`ma_tgia`, `ten_tgia`, `hinh_tgia`) VALUES
(1, 'Nhacvietplus', NULL),
(2, 'Sưu tầm', NULL),
(3, 'Sandy', NULL),
(4, 'Lê Trung Ngân', NULL),
(5, 'Khánh Ngọc', NULL),
(6, 'Night Stalker', NULL),
(7, 'Phạm Phương Anh', NULL),
(8, 'Tâm tình', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `ma_tloai` int(10) UNSIGNED NOT NULL,
  `ten_tloai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`ma_tloai`, `ten_tloai`) VALUES
(1, 'Nhạc trẻ'),
(2, 'Nhạc trữ tình'),
(3, 'Nhạc cách mạng'),
(4, 'Nhạc thiếu nhi'),
(5, 'Nhạc quê hương'),
(6, 'POP'),
(7, 'Rock'),
(8, 'R&B');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_music`
-- (See below for the actual view)
--
CREATE TABLE `vw_music` (
`ma_bviet` int(10) unsigned
,`tieude` varchar(200)
,`ten_bhat` varchar(100)
,`ten_tgia` varchar(100)
,`ten_tloai` varchar(50)
,`ngayviet` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `vw_music`
--
DROP TABLE IF EXISTS `vw_music`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_music`  AS SELECT `baiviet`.`ma_bviet` AS `ma_bviet`, `baiviet`.`tieude` AS `tieude`, `baiviet`.`ten_bhat` AS `ten_bhat`, `tacgia`.`ten_tgia` AS `ten_tgia`, `theloai`.`ten_tloai` AS `ten_tloai`, `baiviet`.`ngayviet` AS `ngayviet` FROM ((`baiviet` join `tacgia`) join `theloai`) WHERE `baiviet`.`ma_tgia` = `tacgia`.`ma_tgia` AND `baiviet`.`ma_tloai` = `theloai`.`ma_tloai` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`ma_bviet`),
  ADD KEY `ma_tloai` (`ma_tloai`),
  ADD KEY `ma_tgia` (`ma_tgia`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`ma_tgia`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`ma_tloai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `ma_bviet` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `ma_tgia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `theloai`
--
ALTER TABLE `theloai`
  MODIFY `ma_tloai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD CONSTRAINT `baiviet_ibfk_1` FOREIGN KEY (`ma_tloai`) REFERENCES `theloai` (`ma_tloai`),
  ADD CONSTRAINT `baiviet_ibfk_2` FOREIGN KEY (`ma_tgia`) REFERENCES `tacgia` (`ma_tgia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
