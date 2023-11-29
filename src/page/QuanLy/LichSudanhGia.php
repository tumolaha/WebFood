<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SidebarQuanLy.php";
require_once __DIR__ . "../../dbConnection.php";

// Get the selected date
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];
} else {
    $selectedDate = date('Y-m-d');
}

// Get the datmon data for the selected date
$query = "SELECT * FROM `dondatmon` WHERE DATE(ngaydat) = '$selectedDate' ORDER BY ngaydat ASC";
$result = mysqli_query($conn, $query);


// Render the data table
?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Phiếu đề xuất</h1>
</div>
<div class="content flex-1 mt-2 ml-8">
    <form action="" method="GET" class="m-4">
        <label for="date" class="mr-2">Chọn ngày:</label>
        <input type="date" id="date" name="date" value="<?php echo $selectedDate; ?>" class="px-2 py-1 border border-gray-300 rounded-md">
        <button type="submit" class="px-4 py-2 ml-2 bg-blue-500 text-white rounded-md">Xem</button>
    </form>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <th class="py-3 px-6 text-left whitespace-nowrap">MaDon</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">MaNV</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">MaMon</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">NgayDat</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">TongTien</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">TrangThai</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">DanhGia</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php
            // Loop through order data
            while ($orderRow = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['MaDon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['MaNV'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['MaMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['NgayDat'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['TongTien'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['TrangThai'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['DanhGia'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . "../../Footer.php";
?>