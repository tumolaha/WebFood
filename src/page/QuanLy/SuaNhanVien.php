<?php
require_once __DIR__ . '../../Header.php';
require_once __DIR__ . '/SidebarQuanLy.php';
?>
<div class="w-full flex item-center justify-between">
  <div>
    <h5 class="text-xl font-bold text-black">Thêm Nhân Viên</h5>
  </div>
  <div>

  </div>
</div>
<div class="w-full py-6"></div>
<?php
require_once __DIR__ . '../../dbConnection.php';
if (isset($_POST['edit'])) {
  $MaNV = $_POST['edit_id'];
  $query = "SELECT * FROM NhanVien WHERE MaNV='$MaNV'";
  $query_run = mysqli_query($conn, $query);
}
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
?>
<form action="SuaNhanvVien.php" method="post" data-parsley-validate="" enctype="multipart/form-data">
  <?php
  if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
  ?>
      <div class="relative z-0 w-full mb-6 group">
        <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " name="MaNV" value="<?php echo $row['MaNV'] ?>" disable />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mã
          Mã Nhân Viên</label>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " name="MaTK" value="<?php echo $row['MaTK'] ?>" required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mã
          Tài Khoản</label>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " name="TenNV" value="<?php echo $row['TenNV'] ?>" required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Họ
          tên</label>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " name="SDT" required value="<?php echo $row['SDT'] ?>" />
        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SDT</label>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required name="Email" value="<?php echo $row['Email'] ?>" />
        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <div class="relative z-0 w-full mb-6 group flex item-center gap-4">
          <div class="flex items-center mb-4">
            <input id="country-option-1" type="radio" name="GioiTinh" value="1" class="w-4 h-4 border-gray-300 " checked>
            <label for="country-option-1" class="block ml-2 text-base font-medium text-gray-900">
              nam
            </label>
          </div>

          <div class="flex items-center mb-4">
            <input id="country-option-2" type="radio" name="GioiTinh" value="0" class="w-4 h-4 border-gray-300 ">
            <label for="country-option-2" class="block ml-2 text-base font-medium text-gray-900">
              nữ
            </label>
          </div>
        </div>
      </div>
  <?php }
  } ?>
  <button type=" submit" name="editEmployee" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Thêm Nhân Viên
  </button>
</form>
</section>
</div>
<?php
require_once __DIR__ . '../../Footer.php';
?>