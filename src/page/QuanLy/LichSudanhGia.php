<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SidebarQuanLy.php";
require_once __DIR__ . "../../dbConnection.php";

// Get the selected date
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];
} else {
    $selectedDate = date("Y-m-d");
}

// Get the datmon data for the selected date
$query = "SELECT *, dondatmon.MaNV FROM `dondatmon` LEFT JOIN menu ON dondatmon.MaMenu = menu.MaMenu LEFT JOIN monan ON menu.MaMon = monan.MaMon  WHERE DATE(ngaydat) = '$selectedDate' ORDER BY ngaydat ASC ";
$result = mysqli_query($conn, $query);


// Render the data table
?>
<?php
require_once __DIR__ . "../../breadcrumb.php";
?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Lịch sử đánh giá</h1>
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
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã đơn</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Ma NV</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">mã món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Tên món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Hình ảnh</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">ngày đặt</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">trạng thái</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">đánh giá</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php
            // Loop through order data
            while ($orderRow = mysqli_fetch_assoc($result)) {
                $imagePath = $orderRow['HinhMinhHoa'];

                $srcPosition = strpos($imagePath, 'src');
                if ($srcPosition !== false) {
                    $imagePath = substr($imagePath, $srcPosition);
                }

                $url = 'http://localhost/webfood/' . $imagePath;
                $url = str_replace('\\', '/', $url);
                echo "<tr>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['MaDon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['MaNV'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['MaMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['TenMon'] . "</td>";
                echo '<td class="px-6 py-4 text-gray-900"> <img class="p-8 rounded-t-lg" src="' . $url . '" alt="Image" width="200" height="200" />';
                echo "<td class='py-3 px-6 text-left'>" . $orderRow['NgayDat'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>";
                if ($orderRow['TrangThai'] == 0) {
                    echo "<span class='bg-yellow-500 text-white py-1 px-2 rounded'>Đã đặt</span>";
                } elseif ($orderRow['TrangThai'] == 2) {
                    echo "<span class='bg-green-500 text-white py-1 px-2 rounded'>Đã giao</span>";
                } elseif ($orderRow['TrangThai'] == 1) {
                    echo "<span class='bg-red-500 text-white py-1 px-2 rounded'>Đã hủy</span>";
                } elseif ($orderRow['TrangThai'] == 3) {
                    echo "<span class='bg-blue-500 text-white py-1 px-2 rounded'>Đã thanh toán</span>";
                }
                echo "</td>";
                if ($orderRow['DanhGia'] == null) {
                    $orderRow['DanhGia'] = "Chưa đánh giá";
                    echo "<td class='py-3 px-6 text-left'>" . $orderRow['DanhGia'] . " </td>";
                } else {
                    echo "<td class='py-3 px-6 text-left'>" . $orderRow['DanhGia'] . " sao </td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . "../../Footer.php";
?>