<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SidebarQuanLy.php";

// Get the menu data

require_once __DIR__ . '../../dbConnection.php';
// Define how many results you want per page
$results_per_page = 10;

// Find out the number of results stored in database
$sql = 'SELECT * FROM dondatmon';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// Determine number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Get the selected date
$selected_date = isset($_GET['date']) ? $_GET['date'] : '';

?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Đơn đặt món</h1>
</div>
<div class="content flex-1 mt-2 ml-8">
    <form action="" method="GET" class="my-4">
        <label for="date" class="mr-2">Chọn ngày:</label>
        <input type="date" id="date" name="date" value="<?php echo $selected_date; ?>" class="border border-gray-300 rounded px-2 py-1">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tìm kiếm</button>
    </form>

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Đơn</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã NV</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Ngày Đặt</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Tổng Tiền</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Trạng Thái</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Đánh Giá</th>
                <th class="py-3 px-6 text-left"></th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php
            // Loop through menu data
            while ($menuRow = mysqli_fetch_assoc($result)) {
                // Check if the selected date matches the menu date
                if ($selected_date == '' || $selected_date == $menuRow['NgayDat']) {
                    echo "<tr>";
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaDon'] . "</td>";
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaNV'] . "</td>";
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaMon'] . "</td>";
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['NgayDat'] . "</td>";
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['TongTien'] . "</td>";
                    echo "<td class='py-3 px-6 text-left'>";

                    // Render order status
                    if ($menuRow['TrangThai'] == 0) {
                        echo "<span class='bg-yellow-500 text-white py-1 px-2 rounded'>Đã đặt</span>";
                    } elseif ($menuRow['TrangThai'] == 2) {
                        echo "<span class='bg-green-500 text-white py-1 px-2 rounded'>Đã giao</span>";
                    } elseif ($menuRow['TrangThai'] == 1) {
                        echo "<span class='bg-red-500 text-white py-1 px-2 rounded'>Đã hủy</span>";
                    }

                    echo "</td>";
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['DanhGia'] . "</td>";

                    // Add the approve button
                    echo "<td class='py-3 px-6 text-left'>";




                    echo "</td>";

                    echo "</tr>";
                }
            }

            ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . "../../Footer.php";
?>