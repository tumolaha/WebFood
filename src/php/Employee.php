<?php
require_once __DIR__ . '../../page/dbConnection.php';

$sqlSelectCat = "SELECT * FROM NhanVien";
$resultCat = mysqli_query($conn, $sqlSelectCat) or die("lỗi truy vấn danh mục" . "$sqlSelectCat");

if (isset($_POST["editEmployee"])) {
	$MaNV = $_POST["MaNV"];
	$MaTK = $_POST["MaTK"];
	$TenNv = $_POST["TenNV"];
	$GioiTinh = ($_POST["GioiTinh"]) ? $_POST["GioiTinh"] : 0;
	$SDT = $_POST["SDT"];
	$Email = $_POST["Email"];

	$sqlInsert = "update  NhanVien set MaTK='$MaTK', TenNV='$TenNv', GioiTinh='$GioiTinh', SDT='$SDT', Email='$Email' WHERE MaNV='$MaNV'";
	Mysqli_query($conn, $sqlInsert) or die("Lỗi thêm mới sản phẩm" . $sqlInsert);
	header("location:../page/QuanLy/QuanLyNhanVien.php");
	// echo $sqlInsert;

}
