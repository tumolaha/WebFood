<?php
require_once __DIR__ . '../../header.php';
require_once __DIR__ . '/SiderbarQuanLyBep.php';
require_once __DIR__ . '../../dbConnection.php';

// Check if the form is submitted
if (isset($_POST['addNewThucDon'])) {
    // Get the form data
    $maMenu = $_POST['MaMenu'];
    $maMon = $_POST['MaMon'];
    $maNguyenLieu = $_POST['MaNL'];
    $ngayBan = $_POST['ngayban'];

    // Check if the MaMenu already exists in the database
    $sql = "SELECT COUNT(*) as count FROM menu WHERE MaMenu = '$maMenu'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count > 0) {
        // MaMenu already exists, display an error message or redirect to an error page
        echo "ma thực đơn tồn tại!";
    } else {
        $sql = "INSERT INTO menu (MaMenu, MaMon, MaNL, ngayban) VALUES ('$maMenu', '$maMon', '$maNguyenLieu', '$ngayBan')";
        // Execute the SQL query
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Redirect to a success page or display a success message
        header("Location: ../../page/QuanLy/QuanLyThucDon.php");
        exit;
    }


    // TODO: Insert the menu into the database
    // Replace the following code with your database insertion logic

}

// Get the list of "ma_mon" values from the table
$sql = "SELECT MaMon, TenMon FROM monan";
$result = mysqli_query($conn, $sql);
$maMonList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $maMonList[$row['MaMon']] = $row['TenMon'];
}

// Get the list of "ma_nguyen_lieu" values from the table
$sql = "SELECT MaNL, TenNL FROM nguyenlieu";
$result = mysqli_query($conn, $sql);
$maNguyenLieuList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $maNguyenLieuList[$row['MaNL']] = $row['TenNL'];
}

?>

<div class="px-5 py-10">
    <div class="py-10">
        <h1 class="text-2xl font-bold text-black">Thêm Thực Đơn</h1>
    </div>

    <form action="ThemThucDon.php" method="POST">
        <div class="mb-4">
            <label for="TenNV" class="block text-sm font-medium text-gray-700">Mã Thực Đơn</label>
            <input type="text" name="MaMenu" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>
        <div class="mb-4">
            <label for="MaTK" class="block text-sm font-medium text-gray-700">Mã Món</label>
            <select name="MaMon" class="mt-1 py-2.5 px-2 border border-blue-500 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <?php foreach ($maMonList as $maMonKey => $maMonValue) { ?>
                    <option value="<?php echo $maMonKey; ?>"><?php echo $maMonValue; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="TenNV" class="block text-sm font-medium text-gray-700">Mã Nguyên Liệu</label>
            <select name="MaNL" class="mt-1 py-2.5 px-2 border border-blue-500 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <?php foreach ($maNguyenLieuList as $maNguyenLieuKey => $maNguyenLieuValue) { ?>
                    <option value="<?php echo $maNguyenLieuKey; ?>"><?php echo $maNguyenLieuValue; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="SDT" class="block text-sm font-medium text-gray-700">Ngày bán</label>
            <input type="date" name="ngayban" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>

        <form action="ThemThucDon.php" method="POST">
            <!-- Form fields -->
            <button type="submit" name="addNewThucDon" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Thêm Thực Đơn
            </button>
        </form>
    </form>
</div>

<?php
require_once __DIR__ . '../../Footer.php';
