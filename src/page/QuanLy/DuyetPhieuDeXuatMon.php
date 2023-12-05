<?php
require_once __DIR__ . '../../header.php';
require_once __DIR__ . '/SidebarQuanLy.php';
require_once __DIR__ . '../../dbConnection.php';

// Fetch menu and ingredients data from the database
$menuQuery = "SELECT * FROM monan ORDER BY ngaytao DESC";
$menuResult = mysqli_query($conn, $menuQuery);
$number_of_results = mysqli_num_rows($menuResult);
$results_per_page = 10;
$page = 1;
$number_of_pages = ceil($number_of_results / $results_per_page);
$this_page_first_result = ($page - 1) * $results_per_page;


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $maMon = $_POST['maMon'];
    $trangThai = $_POST['trangThai'];

    // Update the proposal status in the database
    $updateQuery = "UPDATE monan SET trangthai = '$trangThai' WHERE MaMon = '$maMon'";
    mysqli_query($conn, $updateQuery);
    header('Location: ../../page/QuanLy/DuyetPhieuDeXuatMon.php');
}

// Check if the filter form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['filter'])) {
    // Get the submitted form data
    $filterDate = $_GET['filterDate'];

    // Fetch menu data based on the filter
    $menuQuery = "SELECT * FROM monan WHERE DATE(ngaytao) = '$filterDate' ORDER BY ngaytao DESC";
    $menuResult = mysqli_query($conn, $menuQuery);
    $number_of_results = mysqli_num_rows($menuResult);
    $number_of_pages = ceil($number_of_results / $results_per_page);
    $this_page_first_result = ($page - 1) * $results_per_page;
}

?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Phiếu đề xuất</h1>
</div>
<div class="content flex-1 px-4  w-full overflow-scroll">
    <form method="GET">
        <div class="flex items-center mb-4">
            <label class="mr-2">Ngày tạo:</label>
            <input type="date" name="filterDate" class="border border-gray-300 rounded px-2 py-1">
            <button type="submit" name="filter" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Lọc</button>
        </div>
    </form>

    <table class="table-auto w-full ">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Tên Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Giá</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Hình ảnh</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Công thức</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Nguyên Liệu</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Trạng thái</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Ngày tạo</th>
                <th class="py-3 px-6 text-left">Duyệt</th>
                <th class="py-3 px-6 text-left"></th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php
            // Loop through menu data
            while ($menuRow = mysqli_fetch_assoc($menuResult)) {

                $imagePath = $menuRow['HinhMinhHoa'];
                if ($imagePath === null) {
                    $imagePath = 'src\uploads\default-food-image.jpg';
                }
                $srcPosition = strpos($imagePath, 'src');
                if ($srcPosition !== false) {
                    $imagePath = substr($imagePath, $srcPosition);
                }

                $url = 'http://localhost/webfood/' . $imagePath;
                $url = str_replace('\\', '/', $url);


                echo "<tr>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['TenMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>";
                if ($menuRow['DonGia'] === null) {
                    echo "Chưa cập nhật";
                } else {
                    echo $menuRow['DonGia'];
                }
                echo "</td>";
                echo "<td class='py-3 px-6 text-left'>";
                if ($url === null) {
                    echo "Chưa cập nhật";
                } else {
                    echo '<img class="p-8 rounded-t-lg" src="' . $url . '" alt="Image" width="200" height="200" />';
                }
                echo "</td>";
                echo "<td class='py-3 px-6 text-left'>";
                if ($menuRow['CongThuc'] === null) {
                    echo "Chưa cập nhật";
                } else {
                    echo $menuRow['CongThuc'];
                }
                echo "</td>";
                echo "<td class='py-3 px-6 text-left'>";
                echo "<a href='../../Page/QuanLy/XemNguyenLieu.php?MaMon=" . $menuRow['MaMon'] . "' class='text-blue-500 hover:text-blue-600 white whitespace-nowrap' style='background-color: #4CAF50; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;'>Xem</a>";
                echo "</td>";
                echo "<td class='py-3 px-6 text-left'>";
                echo "<span class='status flex items-center justify-center flex-nowrap ";
                if ($menuRow['trangthai'] == 0) {
                    echo "pending text-red-500";
                } else {
                    echo "approved text-green-500";
                }
                echo " whitespace-nowrap' style='background-color: #f5f5f5; border: 1px solid #ccc; padding: 4px 8px;'>";
                if ($menuRow['trangthai'] == 0) {
                    echo "Chưa duyệt";
                } else {
                    echo "Đã duyệt";
                }
                echo "</span>";
                echo "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['ngaytao'] . "</td>";

                // Add the approve button
                echo "<td class='py-3 px-6 text-left'>";
                echo "<form method='POST'  action='../../Page/QuanLy/DuyetPhieuDeXuatMon.php' class='flex flex-nowrap'>";
                echo "<input type='hidden' name='maMon' value='" . $menuRow['MaMon'] . "'>";
                echo "<select name='trangThai'>";
                echo "<option value='0' " . ($menuRow['trangthai'] == 0 ? "selected" : "") . ">Chưa duyệt</option>";
                echo "<option value='1' " . ($menuRow['trangthai'] == 1 ? "selected" : "") . ">Đã duyệt</option>";
                echo "</select>";
                echo "<button class='ml-4' type='submit' style='background-color: blue; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;'>Duyệt</button>";

                echo "</form>";

                echo "</td>";
                //    cập nhật thông in món ăn
                echo "<td class='py-3 px-6 text-left'>";
                echo "<a href='../../Page/QuanLy/CapNhatThongTinMonAn.php?MaMon=" . $menuRow['MaMon'] . "' class='text-blue-500 hover:text-blue-600 white whitespace-nowrap' style='background-color: #4CAF50; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;'>Cập nhật</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
require_once __DIR__ . '../../Footer.php';
?>