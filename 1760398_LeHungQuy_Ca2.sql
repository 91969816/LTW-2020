-- ================================================
-- Template generated from Template Explorer using:
-- Create Procedure (New Menu).SQL
--
-- Use the Specify Values for Template Parameters 
-- command (Ctrl-Shift-M) to fill in the parameter 
-- values below.
--
-- This block of comments will not be included in
-- the definition of the procedure.
-- ================================================
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<1760398,Lê Hùng Quý>
-- Create date: <04/12/2020>
-- Description:	<1760398_LeHungQuy_BTVN08_Ca02>
-- =============================================
--1. Các môn giáo viên được phân giảng dạy phải nằm trong danh sách môn do trường quản
--lý.
--			I		D		U
--PhanCong: +		-		+(MaMH)
--MonHoc:	-		-		+(MAMH)

select* from phancong
IF OBJECT_ID('UTG_PhanCong_MH','p') is not null
	drop Trigger UTG_PhanCong_MH
GO
CREATE TRIGGER UTG_PhanCong_MH ON PhanCong FOR INSERT,UPDATE
AS
BEGIN
	if exists (SELECT inserted.MaMH From inserted where inserted.MaMH not IN(select MAMH from MONHOC))
		begin
			RAISERROR('kHONG HOP LE',16,1)
			ROLLBACK TRAN
		end
END
IF OBJECT_ID('UTG_MonHoc_PC','P') is not null
	drop TRIGGER UTG_MonHoc_PC
GO
CREATE TRIGGER UTG_MonHoc_PC ON MonHoc FOR UPDATE
AS
BEGIN
	IF EXISTS (SELECT inserted.MaMonHoc FROM INSERTED WHERE  inserted.MaMonHoc not IN (select MAMH from PHANCONG))
		Begin
			RAISERROR('kHONG HOP LE',16,1)
			ROLLBACK TRAN
		end
END
go
update PHANCONG set MaMH = 'fhdfhdfh' where MaGV = 'GV00001'
--2. Lớp trưởng của một lớp phải là học viên thuộc về lớp đó.
--			I	D	U
--LopHoc:	+	-	+(MaLop,LopTruong)
--HocVien:	-	-	+(MaLop)


--3. Mỗi môn học phải có ít nhất một giáo viên có khả năng giảng dạy.