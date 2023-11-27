
<?php
require __DIR__ . '/header.php';
require __DIR__ . '/Sidebar.php';
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editNguyenLieu'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web-food";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $ma_nguyen_lieu = $_POST['ma_nguyen_lieu'];


    // MaNL does not exist, insert new record
    $ten_nguyen_lieu = $_POST['ten_nguyen_lieu'];
    $so_luong = $_POST['so_luong'];

    $sql = "UPDATE nguyenlieu SET TenNL='$ten_nguyen_lieu', SoLuong='$so_luong' WHERE MaNL='$ma_nguyen_lieu'";

    if ($conn->query($sql) === TRUE) {
        echo 'Record updated successfully';
        echo '<script> location.replace("QuanLyNguyenLieu.php"); </script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }


    $conn->close();
}  ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web-food";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = $ma_nguyen_lieu;
}

// Select record
$sql = "SELECT * FROM nguyenlieu WHERE MaNL = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the row
    $row = $result->fetch_assoc();
    $ma_nguyen_lieu = $row['MaNL'];
    $ten_nguyen_lieu = $row['TenNL'];
    $so_luong = $row['SoLuong'];
} else {
    echo "No results";
}

$conn->close();
?>
<div class="p-2"></div>
<form method="post" action="SuaNguyenLieu.php">
    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="ma_nguyen_lieu" readonly value="<?php echo $ma_nguyen_lieu; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mã Nguyên liệu</label>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="ten_nguyen_lieu" value="<?php echo $ten_nguyen_lieu; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tên Nguyên liệu
        </label>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="so_luong" value="<?php echo $so_luong; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Số Lượng</label>
    </div>



    <button type="post" name="editNguyenLieu" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Sửa Nguyên Liệu
    </button>
</form>
<?php require __DIR__ . '/footer.php'; ?>