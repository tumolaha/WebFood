<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SidebarPhucVu.php";

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
    <h1 class="text-2xl font-bold text-black">Quản lý Phiếu đề xuất</h1>
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
                <th class="py-3 px-6 text-left whitespace-nowrap">Trạng Thái</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Đánh Giá</th>
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
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['TrangThai'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['DanhGia'] . "</td>";

                // Add the approve button
                echo "<td class='py-3 px-6 text-left'>";
                echo "<form method='POST'  action='../../Page/QuanLy/DuyetPhieuDeXuatMon.php' class='flex flex-nowrap'>";
                echo "<input type='hidden' name='maMon' value='" . $menuRow['MaMon'] . "'>";
                echo "<select name='trangThai'>";
                echo "<option value='0' " . ($menuRow['TrangThai'] == 0 ? "selected" : "") . ">Chưa giao</option>";
                echo "<option value='1' " . ($menuRow['TrangThai'] == 1 ? "selected" : "") . ">Đã giao</option>";
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
require_once __DIR__ . "../../Footer.php";
?>