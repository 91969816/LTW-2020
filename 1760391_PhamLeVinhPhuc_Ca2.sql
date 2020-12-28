-- ================================================
-- TEMPLATE GENERATED FROM TEMPLATE EXPLORER USING:
-- CREATE PROCEDURE (NEW MENU).SQL
--
-- USE THE SPECIFY VALUES FOR TEMPLATE PARAMETERS 
-- COMMAND (CTRL-SHIFT-M) TO FILL IN THE PARAMETER 
-- VALUES BELOW.
--
-- THIS BLOCK OF COMMENTS WILL NOT BE INCLUDED IN
-- THE DEFINITION OF THE PROCEDURE.
-- ================================================
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- AUTHOR:		<1760391,,PHẠM LÊ VĨNH PHÚC>
-- CREATE DATE: <5/12/2020,,>
-- DESCRIPTION:	<BTTL_TUAN08>
-- =============================================


use QLHocVien
--1.Các môn GV được PC Giang Dạy phải nằm trong danh sách do trường quản lý
--				insert			delete			update
--PhanCong		+				-				+(MaGV,MaMH)
--MonHoc		-				-				+(MaMH)
if OBJECT_ID('TG_GVPCGD') IS NOT NULL
	DROP TRIGGER TG_GVPCGD
go
CREATE TRIGGER TG_GVPCGD ON PHANCONG for INSERT, UPDATE
AS 
BEGIN
	if not exists(select *from  inserted i join  PHANCONG pc on i.MaMH =pc.MaMH join GIAOVIEN gv on gv.MaGVQuanLi=pc.MaGV
							where pc.MaMH in (select MaMH from deleted))
	begin
		Raiserror('ERROR', 16, 1)
		Rollback transaction
	END
END
GO




--2.Lớp trưởng của một lớp phải là học viên thuộc về lớp đó 
--				insert			delete			update
--HocVien		-				+				+(MaHocVien)
--LopHoc		+				-				+(LopTruong)


--1.Các môn giáo viên được phân công giảng dạy  phải nằm trong danh sách môn do trưởng quản lý
--Bối cảnh:GiaoVien
--Bảng tầm ảnh hưởng:
--			Insert		Delete		Update
--	MONHOC	+			-			+(MaMH)

