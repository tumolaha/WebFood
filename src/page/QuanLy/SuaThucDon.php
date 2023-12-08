<?php
require_once __DIR__ . '../../header.php';
require_once __DIR__ . '/SidebarQuanLy.php';
require_once __DIR__ . '../../dbConnection.php';

// Check if the form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editThucDon'])) {
    $ma_menu = $_POST['MaMenu'];
    $ma_mon = $_POST['MaMon'];
    $ma_nguyen_lieu = $_POST['MaNL'];
    $gia = $_POST['gia'];
    $ngay_ban = $_POST['ngayban'];

    $sql = "UPDATE menu SET MaMon = '$ma_mon', MaNL = '$ma_nguyen_lieu',gia= '$gia', NgayBan = '$ngay_ban' WHERE MaMenu = '$ma_menu'";

    if ($conn->query($sql) === TRUE) {
        echo 'Record updated successfully';
        echo '<script> location.replace("QuanLyThucDon.php"); </script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
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



if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = $ma_menu;
}

// Select record
$sql = "SELECT * FROM menu WHERE MaMenu = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the row
    $row = $result->fetch_assoc();
    $ma_menu = $row['MaMenu'];
    $ma_mon = $row['MaMon'];
    $ma_nguyen_lieu = $row['MaNL'];
    $don_gia = $row['gia'];
    $ngay_ban = $row['ngayban'];
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
        <h1 class="text-2xl font-bold text-black">Sửa Thực Đơn</h1>
    </div>

    <form action="SuaThucDon.php" method="POST">
        <div class="mb-4">
            <label for="MaMenu" class="block text-sm font-medium text-gray-700">Mã Thực Đơn</label>
            <input type="text" name="MaMenu" value="<?php echo $ma_menu; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>
        <div class="mb-4">
            <label for="MaDon" class="block text-sm font-medium text-gray-700">Mã Món</label>
            <select name="MaMon" class="mt-1 py-2.5 px-2 border border-blue-500 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <?php foreach ($maMonList as $maMonKey => $maMonValue) { ?>
                    <option value="<?php echo $maMonKey; ?>" <?php if ($maMonKey == $ma_mon) echo 'selected'; ?>><?php echo $maMonValue; ?></option>
                <?php } ?>
                <option value="" <?php if ($ma_mon == '') echo 'selected'; ?>>Select a value</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="MaMenu" class="block text-sm font-medium text-gray-700">Đơn giá</label>
            <input type="text" name="gia" value="<?php echo $don_gia; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        </div>
        <div class="mb-4">
            <label for="MaNL" class="block text-sm font-medium text-gray-700">Mã Nguyên Liệu</label>
            <select name="MaNL" class="mt-1 py-2.5 px-2 border border-blue-500 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <?php foreach ($maNguyenLieuList as $maNguyenLieuKey => $maNguyenLieuValue) { ?>
                    <option value="<?php echo $maNguyenLieuKey; ?>" <?php if ($maNguyenLieuKey == $ma_nguyen_lieu) echo 'selected'; ?>><?php echo $maNguyenLieuValue; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="ngayban" class="block text-sm font-medium text-gray-700">Ngày bán</label>
            <input type="date" name="ngayban" value="<?php echo $ngay_ban; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?php echo $ngay_ban; ?>" required>
        </div>
        <!-- Form fields -->
        <button type="post" name="editThucDon" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Sửa Thực Đơn
        </button>
    </form>
    </form>
</div>

<?php
require_once __DIR__ . '../../Footer.php';
