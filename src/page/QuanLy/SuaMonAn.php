<?php
require_once __DIR__ . '../../header.php';
require_once __DIR__ . '/SidebarQuanLy.php';
require_once __DIR__ . '../../dbConnection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editThucDon'])) {
    $ma_mon = $_POST['MaMon'];
    $ten_mon = $_POST['TenMon'];
    $hinh_minh_hoa = $_POST['HinhMinhHoa'];
    $cong_thuc = $_POST['CongThuc'];
    $trang_thai = $_POST['trangthai'];
    $ngay_tao = $_POST['ngaytao'];
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
    if ($uploadPath === '') {
        $uploadPath = $hinh_minh_hoa;
    }

    $sql = "UPDATE monan SET TenMon = '$ten_mon', HinhMinhHoa = '$uploadPath', CongThuc = '$cong_thuc', trangthai = '$trang_thai', ngaytao = '$ngay_tao' WHERE MaMon = '$ma_mon'";

    if ($conn->query($sql) === TRUE) {
        echo 'Record updated successfully';
        echo '<script> location.replace("QuanLyMon.php"); </script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = $ma_mon;
}

// Select record
$sql = "SELECT * FROM monan WHERE MaMon = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the row
    $row = $result->fetch_assoc();
    $ma_mon = $row['MaMon'];
    $ten_mon = $row['TenMon'];
    $hinh_minh_hoa = $row['HinhMinhHoa'];
    $cong_thuc = $row['CongThuc'];
    $trang_thai = $row['trangthai'];
    $ngay_tao = $row['ngaytao'];
} else {
    echo "No results";
}

$conn->close();
?>
<div class="px-5 py-10">
    <?php
    require_once __DIR__ . "../../breadcrumb.php";
    ?>
    <div class="py-10">
        <h1 class="text-2xl font-bold text-black">Sửa Món Ăn</h1>
    </div>

    <form action="SuaMonAn.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="MaMon" class="block text-sm font-medium text-gray-700">Mã Món</label>
            <input type="text" name="MaMon" value="<?php echo $ma_mon; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>
        <div class="mb-4">
            <label for="TenMon" class="block text-sm font-medium text-gray-700">Tên Món</label>
            <input type="text" name="TenMon" value="<?php echo $ten_mon; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>
        <div class="mb-4">
            <label for="HinhMinhHoa" class="block text-sm font-medium text-gray-700">Hình Minh Họa</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file" name="file_input">
            <input type="hidden" name="HinhMinhHoa" value="<?php echo $hinh_minh_hoa; ?>">
        </div>
        <div class="mb-4">
            <label for="CongThuc" class="block text-sm font-medium text-gray-700">Công Thức</label>
            <input type="text" name="CongThuc" value="<?php echo $cong_thuc; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>
        <div class="mb-4">
            <label for="trangthai" class="block text-sm font-medium text-gray-700">Trạng Thái</label>
            <select name="trangthai" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                <option value="0" <?php if ($trang_thai == '0') echo 'selected'; ?>>ngừng hoạt động</option>
                <option value="1" <?php if ($trang_thai == '1') echo 'selected'; ?>>hoạt động</option>

            </select>
        </div>
        <div class="mb-4">
            <label for="ngaytao" class="block text-sm font-medium text-gray-700">Ngày Tạo</label>
            <input type="date" name="ngaytao" value="<?php echo $ngay_tao; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>
        <!-- Form fields -->
        <button type="post" name="editThucDon" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Sửa Món Ăn
        </button>
    </form>
</div>

<?php
require_once __DIR__ . '../../Footer.php';
