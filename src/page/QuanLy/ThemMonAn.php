<?php
require_once __DIR__ . '../../header.php';
require_once __DIR__ . '/SidebarQuanLy.php';
require_once __DIR__ . '../../dbConnection.php';

// Check if the form is submitted
if (isset($_POST['addNewMonAn'])) {
    // Get the form data
    $tenMon = $_POST['TenMon'];
    $donGia = $_POST['DonGia'];
    $congThuc = $_POST['CongThuc'];
    $trangThai = $_POST['TrangThai'];
    $ngayTao = $_POST['NgayTao'];

    // Check if the MaMon already exists in the database
    $sql = "SELECT COUNT(*) as count FROM monan WHERE MaMon = '$maMon'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count > 0) {
        // MaMon already exists, display an error message or redirect to an error page
        echo "Mã món ăn đã tồn tại!";
    } else {
        $uploadPath = '';
        if (isset($_FILES['file_input'])) {
            $file = $_FILES['file_input'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            if ($fileError === 0) {
                $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/webfood/src/uploads/' . $fileName;
                move_uploaded_file($fileTmpName, $uploadPath);
                $uploadPath = addslashes($uploadPath);
            }
        }
        $sql = "INSERT INTO monan (TenMon, DonGia, HinhMinhHoa, CongThuc, TrangThai, NgayTao) VALUES ( '$tenMon', '$donGia', '$uploadPath', '$congThuc', '$trangThai', '$ngayTao')";
        // Execute the SQL query
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Redirect to a success page or display a success message
        header("Location: ../../page/QuanLy/QuanLyMon.php");
        exit;
    }
}

?>

<div class="px-5 py-10">
    <?php
    require_once __DIR__ . "../../breadcrumb.php";
    ?>
    <div class="py-10">
        <h1 class="text-2xl font-bold text-black">Thêm Món Ăn</h1>
    </div>

    <form action="ThemMonAn.php" method="POST" enctype="multipart/form-data">

        <div class="mb-4">
            <label for="TenMon" class="block text-sm font-medium text-gray-700">Tên Món</label>
            <input type="text" name="TenMon" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>

        <div class="mb-4">
            <label for="DonGia" class="block text-sm font-medium text-gray-700">Đơn Giá</label>
            <input type="number" name="DonGia" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>

        <div class="mb-4">
            <label for="HinhMinhHoa" class="block text-sm font-medium text-gray-700">Hình Minh Họa</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file" name="file_input">
        </div>

        <div class="mb-4">
            <label for="CongThuc" class="block text-sm font-medium text-gray-700">Công Thức</label>
            <textarea name="CongThuc" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required></textarea>
        </div>

        <div class="mb-4">
            <label for="TrangThai" class="block text-sm font-medium text-gray-700">Trạng Thái</label>
            <select name="TrangThai" class="mt-1 py-2.5 px-2 border border-blue-500 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <option value="1">Hoạt Động</option>
                <option value="0">Ngừng Hoạt Động</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="NgayTao" class="block text-sm font-medium text-gray-700">Ngày Tạo</label>
            <input type="date" name="NgayTao" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>

        <form action="ThemMonAn.php" method="POST">
            <!-- Form fields -->
            <button type="submit" name="addNewMonAn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Thêm Món Ăn
            </button>
        </form>
    </form>
</div>

<?php
require_once __DIR__ . '../../Footer.php';
