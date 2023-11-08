<?php
		$conn = mysqli_connect("localhost","root","","food_store") or die("lỗi kết nối"); 

		$sqlSelectCat = "SELECT * FROM NhanVien";
		$resultCat = mysqli_query($conn ,$sqlSelectCat) or die("lỗi truy vấn danh mục"."$sqlSelectCat");

		if (isset($_POST["addNew"])) {
            $MaTK = $_POST["MaTK"];
			$TenNv = $_POST["TenNV"];
		  	$GioiTinh = ($_POST["GioiTinh"])?$_POST["GioiTinh"]:0;
		  	$SDT=$_POST["SDT"];
		  	$Email = $_POST["Email"];

			$sqlInsert ="INSERT INTO NhanVien(MaTK,TenNV,SDT,Email,GioiTinh) VALUES($MaTK,'".$TenNv."','".$SDT."','".$Email."','".$GioiTinh."')";
			Mysqli_query($conn,$sqlInsert) or die("Lỗi thêm mới sản phẩm".$sqlInsert);
            header("location:../page/EmployeeManager.php");
			// echo $sqlInsert;

		}
		if (isset($_POST["editEmployee"])) {
			$MaNV = $_POST["MaNV"];
            $MaTK = $_POST["MaTK"];
			$TenNv = $_POST["TenNV"];
		  	$GioiTinh = ($_POST["GioiTinh"])?$_POST["GioiTinh"]:0;
		  	$SDT=$_POST["SDT"];
		  	$Email = $_POST["Email"];

			$sqlInsert ="update  NhanVien set MaTK='$MaTK', TenNV='$TenNv', GioiTinh='$GioiTinh', SDT='$SDT', Email='$Email' WHERE MaNV='$MaNV'";
			Mysqli_query($conn,$sqlInsert) or die("Lỗi thêm mới sản phẩm".$sqlInsert);
            header("location:../page/EmployeeManager.php");
			// echo $sqlInsert;

		}
	?>