<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wed Food</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- header -->
  <?php include_once("header.php"); ?>
    <!-- sidebar -->
    <section class="sidebar h-[calc(100vh-64px)]">
      <div
        class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 h-full w-[300px] p-4 shadow-xl shadow-blue-gray-900/5">
        <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> person_apron </span>
            </div>
            quản lí nhân viên
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> fastfood </span>
            </div>
            Quản Lý Nguyên Vật Liệu
          </div>

          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> lunch_dining </span>
            </div>
            Quản Lý Món Ăn
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> description </span>
            </div>
            Duyệt Phiếu Đề Xuất
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> monitoring </span>
            </div>
            Thống Kê Danh Sách Đặt Món
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> receipt_long </span>
            </div>
            Lịch Sử Đánh Giá
          </div>
        </nav>
      </div>
    </section>
    <!-- content -->
    <section class="content w-full px-10 py-5">
      <div class="w-full flex item-center justify-between">
        <div>
          <h5 class="text-xl font-bold text-black">Thêm Nguyên Vật Liệu</h5>
        </div>
        <div>

        </div>
      </div>
      <div class="w-full py-6"></div>
      <?php   
      if (isset($_POST['submit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "food_store";
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
          $so_luong = $_POST['so_luong'];

          $sql = "INSERT INTO nguyenlieu (MaNL, TenNL, SoLuong, NgayNhap) VALUES ('$ma_nguyen_lieu', '$ten_nguyen_lieu', '$so_luong', CURDATE())";
          if ($conn->query($sql) === TRUE) {
            echo '<div class="p-2"> New record created successfully</div> ';
            echo '<script> location.replace("QuanLyNguyenLieu.php"); </script>';
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }

        $conn->close();
      } ?>

      <form method="post" action="ThemNguyenLieu.php">
        <div class="relative z-0 w-full mb-6 group">
          <input type="text" name="ma_nguyen_lieu"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required />
          <label for="floating_email"
            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mã
            Nguyên liệu</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <input type="text" name="ten_nguyen_lieu"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required />
          <label
            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tên
            Nguyên liệu
          </label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <input type="text" name="so_luong"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required />
          <label
            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Số
            Lượng</label>
        </div>



        <button type="submit" name="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Thêm Nguyên Liệu
        </button>
      </form>
    </section>
  </div>
  <section class="footer "></section>
</body>

</html>