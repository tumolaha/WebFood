<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SidebarPhucVu.php";
require_once __DIR__ . '../../dbConnection.php';

// Define how many results you want per page
$results_per_page = 10;

// Get the filter values
$filterDate = $_GET['date'] ?? '';
$filterMaNV = $_GET['maNV'] ?? '';

// Build the SQL query with filters
$sql = "SELECT * FROM dondatmon WHERE 1=1";
if (!empty($filterDate)) {
    $sql .= " AND NgayDat = '$filterDate'";
}
if (!empty($filterMaNV)) {
    $sql .= " AND MaNV = '$filterMaNV'";
}

// Find out the number of results stored in the database
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// Determine the number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Function to update the status of an order

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['maDon'];
    $status = $_POST['trangThai'];
    echo $orderId;
    echo $status;
    // Call the updateOrderStatus function
    $sql = "UPDATE dondatmon SET TrangThai = '$status' WHERE MaDon = '$orderId'";
    mysqli_query($conn, $sql);
    header("Location: ./CapNhatTrangThaiDatMon.php");
}

?>
<div class="px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Phiếu đề xuất</h1>
</div>
<div class="content flex-1 p-4">
    <form method="GET" action="CapNhatTrangThaiDatMon.php" class="mb-4 flex gap-5 items-center mb-10">
        <div class="flex items-center">
            <label for="date" class="mr-2">Ngày:</label>
            <input type="date" name="date" id="date" value="<?php echo $filterDate; ?>" class="border border-gray-300 rounded px-2 py-1">
        </div>
        <div class="flex items-center ">
            <label for="maNV" class="mr-2">Mã NV:</label>
            <input type="text" name="maNV" id="maNV" value="<?php echo $filterMaNV; ?>" class="border border-gray-300 rounded px-2 py-1">
        </div>
        <button type="submit" class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Lọc</button>
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
                <th class="py-3 px-6 text-left">Thao tác</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php

            while ($menuRow = mysqli_fetch_assoc($result)) {
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

                // Add check to update order only if it is not canceled
                if ($menuRow['TrangThai'] != 1) {
                    echo "<td class='py-3 px-6 text-left'>";
                    echo "<form method='POST'  action='CapNhatTrangThaiDatMon.php' class='flex flex-nowrap'>";
                    echo "<input type='hidden' name='maDon' value='" . $menuRow['MaDon'] . "'>";
                    echo "<select name='trangThai'>";
                    echo "<option value='0' " . ($menuRow['TrangThai'] == 0 ? "selected" : "") . ">Chưa giao</option>";
                    echo "<option value='2' " . ($menuRow['TrangThai'] == 2 ? "selected" : "") . ">Đã giao</option>";
                    echo "</select>";
                    echo "<button class='ml-4' type='submit' style='background-color: #4CAF50; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;'>Duyệt</button>";
                    echo "</form>";
                    echo "</td>";
                } else {
                    echo "<td class='py-3 px-6 text-left'>Đơn hàng đã bị huỷ</td>";
                }

                echo "</tr>";
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