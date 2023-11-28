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

// $ingredientQuery = "SELECT * FROM ingredients";
// $ingredientResult = mysqli_query($connection, $ingredientQuery);

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

?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Phiếu đề xuất</h1>
</div>
<div class="content flex-1 mt-2 ml-8">

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Tên Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Giá</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Hình ảnh</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Công thức</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Trạng thái</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Ngày tạo</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Duyệt</th>
                <th class="py-3 px-6 text-left"></th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php
            // Loop through menu data
            while ($menuRow = mysqli_fetch_assoc($menuResult)) {
                echo "<tr>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['TenMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['DonGia'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['HinhMinhHoa'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['CongThuc'] . "</td>";
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
                echo "<button class='ml-4' type='submit' style='background-color: #4CAF50; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;'>Duyệt</button>";
                echo "</form>";
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