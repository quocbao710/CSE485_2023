-- Yêu cầu 3.
CREATE DATABASE BTTH01_CSE485;

USE BTTH01_CSE485;

CREATE TABLE theloai (
    ma_tloai INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ten_tloai VARCHAR(50) NOT NULL
);

CREATE TABLE tacgia (
    ma_tgia INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ten_tgia VARCHAR(100) NOT NULL,
    hinh_tgia VARCHAR(100)
);

CREATE TABLE baiviet (
    ma_bviet INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tieude VARCHAR(200) NOT NULL,
    ten_bhat VARCHAR(100) NOT NULL,
    ma_tloai INT UNSIGNED NOT NULL,
    tomtat TEXT NOT NULL,
    noidung TEXT,
    ma_tgia INT UNSIGNED NOT NULL,
    ngayviet DATETIME DEFAULT CURRENT_TIMESTAMP,
    hinhanh VARCHAR(200),
    FOREIGN KEY (ma_tloai) REFERENCES theloai(ma_tloai),
    FOREIGN KEY (ma_tgia) REFERENCES tacgia(ma_tgia)
);

-- Yêu cầu 4.
-- a, Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình
SELECT * FROM baiviet WHERE ma_tloai = 2;
-- b, Liệt kê các bài viết của tác giả “Nhacvietplus”
SELECT * FROM baiviet WHERE ma_tgia = 1;
-- c, Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào
SELECT * FROM theloai WHERE ma_tloai NOT IN (SELECT ma_tloai FROM baiviet);
-- d, Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên
-- thể loại, ngày viết
SELECT ma_bviet, tieude, ten_bhat, ten_tgia, ten_tloai, ngayviet
FROM baiviet, tacgia, theloai
WHERE baiviet.ma_tgia = tacgia.ma_tgia AND baiviet.ma_tloai = theloai.ma_tloai;
-- e, Tìm thể loại có số bài viết nhiều nhất
SELECT theloai.ten_tloai, COUNT(baiviet.ma_tloai) AS so_bai_viet
FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
GROUP BY theloai.ma_tloai
ORDER BY so_bai_viet DESC
LIMIT 1;
-- f, Liệt kê 2 tác giả có số bài viết nhiều nhất
SELECT tacgia.ten_tgia, COUNT(baiviet.ma_tgia) AS so_bai_viet
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
GROUP BY tacgia.ma_tgia
ORDER BY so_bai_viet DESC
LIMIT 2;
-- g,Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”,
-- “em”
SELECT * FROM baiviet WHERE ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';
-- h, Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ
-- “yêu”, “thương”, “anh”, “em”
SELECT * FROM baiviet WHERE tieude LIKE '%yêu%' OR tieude LIKE '%thương%' OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';
-- i, Tạo 1 view có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên
-- thể loại và tên tác giả 
CREATE VIEW vw_Music AS
SELECT ma_bviet, tieude, ten_bhat, ten_tgia, ten_tloai, ngayviet
FROM baiviet, tacgia, theloai
WHERE baiviet.ma_tgia = tacgia.ma_tgia AND baiviet.ma_tloai = theloai.ma_tloai;
-- j, Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách
-- Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi
DELIMITER $$
CREATE PROCEDURE sp_DSBaiViet(IN ten_tloai VARCHAR(50))
BEGIN
    DECLARE ma_tloai INT;
    SELECT ma_tloai INTO ma_tloai FROM theloai WHERE ten_tloai = ten_tloai;
    IF ma_tloai IS NULL THEN
        SELECT "Thể loại không tồn tại!";
    ELSE
        SELECT * FROM baiviet WHERE ma_tloai = ma_tloai;
    END IF;
END $$
DELIMITER ;
-- k, Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để
-- khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo
ALTER TABLE theloai ADD COLUMN SLBaiViet INT;

DELIMITER $$
CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END $$
DELIMITER ;
-- l, Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng
-- Đăng nhập/Quản trị trang web.
CREATE TABLE Users (
    id INT UNSIGNED PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Yêu cầu 5.
-- Thêm/Sửa/Xóa Thể loại;
DELIMITER $$
CREATE PROCEDURE sp_TheLoai_insert(IN ten_tloai VARCHAR(50))
BEGIN
    INSERT INTO theloai (ten_tloai) VALUES (ten_tloai);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TheLoai_getAll()
BEGIN
    SELECT * FROM theloai;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TheLoai_getById(IN ma_tloai INT)
BEGIN
    SELECT * FROM theloai tl WHERE tl.ma_tloai = ma_tloai;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TheLoai_getByName(IN ten_tloai VARCHAR(50))
BEGIN
    SELECT * FROM theloai tl WHERE tl.ten_tloai = ten_tloai;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TheLoai_update(IN ma_tloai INT, IN ten_tloai VARCHAR(50))
BEGIN
    UPDATE theloai tl SET tl.ten_tloai = ten_tloai WHERE tl.ma_tloai = ma_tloai;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TheLoai_delete(IN ma_tloai INT)
BEGIN
    DELETE FROM theloai WHERE theloai.ma_tloai = ma_tloai;
END $$
DELIMITER ;

-- Thêm/Sửa/Xóa Tác giả; 
DELIMITER $$
CREATE PROCEDURE sp_TacGia_insert(IN ten_tgia VARCHAR(100), IN hinh_tgia VARCHAR(100))
BEGIN
    INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (ten_tgia, hinh_tgia);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TacGia_getAll()
BEGIN
    SELECT * FROM tacgia;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TacGia_getById(IN ma_tgia INT)
BEGIN
    SELECT * FROM tacgia tg WHERE tg.ma_tgia = ma_tgia;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TacGia_update(IN ma_tgia INT, IN ten_tgia VARCHAR(100), IN hinh_tgia VARCHAR(100))
BEGIN
    UPDATE tacgia tg SET tg.ten_tgia = ten_tgia, tg.hinh_tgia = hinh_tgia WHERE tg.ma_tgia = ma_tgia;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_TacGia_delete(IN ma_tgia INT)
BEGIN
    DELETE FROM tacgia WHERE tacgia.ma_tgia = ma_tgia;
END $$
DELIMITER ;

-- Thêm/Sửa/Xóa Bài viết
DELIMITER $$
CREATE PROCEDURE sp_BaiViet_insert(IN tieude VARCHAR(200), IN ten_bhat VARCHAR(100), IN ma_tloai INT, IN tomtat TEXT, IN noidung TEXT, IN ma_tgia INT, IN hinhanh VARCHAR(200))
BEGIN
    INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh) VALUES (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_BaiViet_getAll()
BEGIN
    SELECT
        bv.ma_bviet, bv.tieude, bv.ten_bhat, tl.ten_tloai, bv.tomtat, bv.noidung, tg.ten_tgia, bv.ngayviet
    FROM baiviet bv
    JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
    JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_BaiViet_getById(IN ma_bviet INT)
BEGIN
    SELECT * FROM baiviet WHERE baiviet.ma_bviet = ma_bviet;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_BaiViet_update(IN ma_bviet INT, IN tieude VARCHAR(200), IN ten_bhat VARCHAR(100), IN ma_tloai INT, IN tomtat TEXT, IN noidung TEXT, IN ma_tgia INT, IN hinhanh VARCHAR(200))
BEGIN
    UPDATE baiviet bv SET bv.tieude = tieude, bv.ten_bhat = ten_bhat, bv.ma_tloai = ma_tloai, bv.tomtat = tomtat, bv.noidung = noidung, bv.ma_tgia = ma_tgia, bv.hinhanh = hinhanh WHERE bv.ma_bviet = ma_bviet;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_BaiViet_delete(IN ma_bviet INT)
BEGIN
    DELETE FROM baiviet WHERE baiviet.ma_bviet = ma_bviet;
END $$
DELIMITER ;

-- Login
DELIMITER $$
CREATE PROCEDURE sp_User_login(IN username VARCHAR(50), IN password VARCHAR(100))
BEGIN
    SELECT * FROM Users WHERE Users.username = username AND Users.password = password;
END $$
DELIMITER ;