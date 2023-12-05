<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SiderbarQuanLyBep.php";

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

?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Đơn Đặt Món</h1>
</div>
<div class="content flex-1 mt-2 ml-8">

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Đơn</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã NV</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Ngày Đặt</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Tổng Tiền</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Đánh Giá</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Trạng Thái</th>
                <th class="py-3 px-6 text-left"></th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php
            // Loop through menu data
            while ($menuRow = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaDon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaNV'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['NgayDat'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['TongTien'] . "</td>";
                // echo "<td class='py-3 px-6 text-left'>" . $menuRow['TrangThai'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['DanhGia'] . "</td>";

                // Add the approve button
                echo "<td class='py-3 px-6 text-left'>";

                if ($menuRow['TrangThai'] == 0) {
                    echo "<span class='bg-yellow-500 text-white py-1 px-2 rounded'>Đã đặt</span>";
                } elseif ($menuRow['TrangThai'] == 2) {
                    echo "<span class='bg-green-500 text-white py-1 px-2 rounded'>Đã giao</span>";
                } elseif ($menuRow['TrangThai'] == 1) {
                    echo "<span class='bg-red-500 text-white py-1 px-2 rounded'>Đã hủy</span>";
                }

                echo "</td>";

                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . "../../Footer.php";
?>