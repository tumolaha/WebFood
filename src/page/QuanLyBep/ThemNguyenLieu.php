<?php
require __DIR__ . '../../header.php';
require __DIR__ . '/SiderbarQuanLyBep.php';
require_once __DIR__ . '../../dbConnection.php';

//
if (isset($_POST['submit'])) {
  $ma_nguyen_lieu = $_POST['ma_nguyen_lieu'];
  $don_vi_tinh = $_POST['donvitinh'];
  // Check if MaNL already exists
  $sql = "SELECT * FROM nguyenlieu WHERE MaNL = '$ma_nguyen_lieu'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // MaNL already exists
    echo '<div class="p-2">  MaNL already exists </div>';
  } else {
    // MaNL does not exist, insert new record
    $ten_nguyen_lieu = $_POST['ten_nguyen_lieu'];


    $sql = "INSERT INTO nguyenlieu (MaNL, TenNL, DonViTinh, NgayNhap) VALUES ('$ma_nguyen_lieu', '$ten_nguyen_lieu', '$don_vi_tinh',  CURDATE())";
    if ($conn->query($sql) === TRUE) {
      echo '<div class="p-2"> New record created successfully</div> ';
      echo '<script> location.replace("QuanLyNguyenLieu.php"); </script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
?>
<?php
require_once __DIR__ . "../../breadcrumb.php";
?>
<div class="w-full flex item-center justify-between">
  <div>
    <h5 class="text-xl font-bold text-black">Thêm Nguyên Vật Liệu</h5>
  </div>
  <div>

  </div>
</div>
<div class="w-full py-6"></div>
<?php
?>


<form method="post" action="ThemNguyenLieu.php">
  <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="ma_nguyen_lieu" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mã Nguyên liệu</label>
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="ten_nguyen_lieu" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tên Nguyên liệu
    </label>
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="donvitinh" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Đơn vị tính
    </label>
  </div>
  <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Thêm Nguyên Liệu
  </button>
</form>


<?php
require __DIR__ . '../../footer.php';
$conn->close();
?>