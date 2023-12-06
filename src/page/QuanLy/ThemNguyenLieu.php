<?php
require __DIR__ . '../../header.php';
require __DIR__ . '/SidebarQuanLy.php';
?>
<div class="w-full flex item-center justify-between py-5">
  <div>
    <h5 class="text-xl font-bold text-black">Thêm Nguyên Vật Liệu</h5>
  </div>
  <div>

  </div>
</div>
<div class="w-full py-6 px-4"></div>
<?php
if (isset($_POST['submit'])) {
  require_once __DIR__ . '../../dbConnection.php';
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $ma_nguyen_lieu = $_POST['ma_nguyen_lieu'];

  // Check if MaNL already exists
  $sql = "SELECT * FROM nguyenlieu WHERE MaNL = '$ma_nguyen_lieu'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // MaNL already exists
    echo '<div class="p-2">  MaNL already exists </div>';
  } else {
    // MaNL does not exist, insert new record
    $ten_nguyen_lieu = $_POST['ten_nguyen_lieu'];
    // $so_luong = $_POST['so_luong'];
    // $gia = $_POST['gia'];
    // $don_vi_tinh = $_POST['don_vi_tinh'];

    $sql = "INSERT INTO nguyenlieu (MaNL, TenNL, SoLuong, NgayNhap, Gia, DonViTinh) VALUES ('$ma_nguyen_lieu', '$ten_nguyen_lieu', '$so_luong', CURDATE(),  '$gia', '$don_vi_tinh')";
    if ($conn->query($sql) === TRUE) {
      echo '<div class="p-2"> New record created successfully</div> ';
      echo '<script> location.replace("QuanLyNguyenLieu.php"); </script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  $conn->close();
}  ?>


<form method="post" action="ThemNguyenLieu.php" class="py-5">
  <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="ma_nguyen_lieu" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mã Nguyên liệu</label>
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="ten_nguyen_lieu" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tên Nguyên liệu
    </label>
  </div>
  <!-- <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="so_luong" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Số Lượng</label>
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="gia" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Giá</label>
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="don_vi_tinh" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Đơn vị tính</label>
  </div> -->



  <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Thêm Nguyên Liệu
  </button>
</form>


<?php require __DIR__ . '../../footer.php'; ?>