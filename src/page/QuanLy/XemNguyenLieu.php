<?php
require_once __DIR__ . '../../header.php';
require_once __DIR__ . '/SidebarQuanLy.php';
require_once __DIR__ . '../../dbConnection.php';

// Check if the form is submitted
if (isset($_GET['MaMon'])) {
    $id = $_GET['MaMon'];
} else {
    $id = 1;
}

// Select record
$sql = "SELECT danhsachnl.*, nguyenlieu.TenNL FROM danhsachnl JOIN nguyenlieu ON danhsachnl.MaNL = nguyenlieu.MaNL WHERE danhsachnl.MaMon = '$id'";
$result = $conn->query($sql);

// Insert record
if (isset($_POST['MaMon']) && isset($_POST['MaNL']) && isset($_POST['SoLuong'])) {
    $maMon = $_POST['MaMon'];
    $maNL = $_POST['MaNL'];
    $soLuong = $_POST['SoLuong'];

    $insertSql = "INSERT INTO danhsachnl (MaMon, MaNL, SoLuong) VALUES ('$maMon', '$maNL', '$soLuong')";
    if ($conn->query($insertSql) === TRUE) {
        echo "New record added successfully";
        echo '<script> location.replace("XemNguyenLieu.php?MaMon=' . $maMon . '"); </script>';
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Delete record
if (isset($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];

    $deleteSql = "DELETE FROM danhsachnl WHERE id = '$deleteId'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Record deleted successfully";
        echo '<script> location.replace("XemNguyenLieu.php?MaMon=' . $id . '"); </script>';
    } else {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }
}

?>
<div class="px-4 py-5 text-lg flex justify-between">
    <h1 class="text-2xl font-bold text-black">Xem Nguyên Liệu</h1>
    <button class="px-4 py-2 bg-blue-500 text-white rounded" onclick="openModal()">Thêm</button>
</div>
<div class="mb-4 p-2">
    <!-- Button to open modal -->
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Mã Nguyên Liệu
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tên Nguyên Liệu
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Số Lượng
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($menuRow = mysqli_fetch_assoc($result)) {
                        $maNl = $menuRow['MaNL'];
                        $tenNL = $menuRow['TenNL'];
                        $soLuong = $menuRow['SoLuong'];
                        $recordId = $menuRow['id'];
                ?>
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <?php echo $maNl; ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $tenNL ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $soLuong ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="XemNguyenLieu.php?MaMon=<?php echo $id; ?>&deleteId=<?php echo $recordId; ?>" class="text-red-500 hover:text-red-700">Xóa</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr class='bg-white  w-full'>
                    <td></td>
                    <td colspan='4' class='px-6 py-4 '>không có nguyên liệu</td>
                    <td></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Thêm Nguyên Liệu</p>
                    <div class="modal-close cursor-pointer z-50" onclick="closeModal()">
                        <svg class="fill-current text-black " xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 18 18">
                            <path class="icon-close" d="M6.293 6.293a1 1 0 011.414 0L9 7.586l1.293-1.293a1 1 0 111.414 1.414L10.414 9l1.293 1.293a1 1 0 01-1.414 1.414L9 10.414l-1.293 1.293a1 1 0 01-1.414-1.414L7.586 9 6.293 7.707a1 1 0 010-1.414z"></path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <form method="POST" action="XemNguyenLieu.php">
                    <div class="mb-4">
                        <label for="MaMon" class="block text-sm font-medium text-gray-700">Mã Món</label>
                        <input type="text" name="MaMon" value="<?php echo $id; ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="MaNL" class="block text-sm font-medium text-gray-700">Mã Nguyên Liệu</label>
                        <select name="MaNL" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <?php
                            $sql = "SELECT * FROM nguyenlieu";
                            $result = $conn->query($sql);

                            while ($menuRow = mysqli_fetch_assoc($result)) {
                                $maNl = $menuRow['MaNL'];
                                $tenNL = $menuRow['TenNL'];
                                echo "<option value=\"$maNl\">$maNl - $tenNL</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="SoLuong" class="block text-sm font-medium text-gray-700">Số Lượng</label>
                        <input type="text" name="SoLuong" value="" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    </div>
                    <!-- Form fields -->
                    <button type="submit" name="addNguyenLieu" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Thêm Nguyên Liệu
                    </button>
                    <button type="button" onclick="closeModal()" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Hủy
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Open modal function
        function openModal() {
            document.querySelector(".modal").classList.remove("opacity-0");
            document.querySelector(".modal").classList.remove("pointer-events-none");
            document.querySelector(".modal").classList.add("opacity-100");
            document.querySelector(".modal").classList.add("pointer-events-auto");
        }

        // Close modal function
        function closeModal() {
            document.querySelector(".modal").classList.remove("opacity-100");
            document.querySelector(".modal").classList.remove("pointer-events-auto");
            document.querySelector(".modal").classList.add("opacity-0");
            document.querySelector(".modal").classList.add("pointer-events-none");
        }
    </script>
</div>
<?php
require_once __DIR__ . '../../footer.php';
?>