<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SiderbarQuanLyBep.php";

// Get the menu data
require_once __DIR__ . '../../dbConnection.php';
// Define how many results you want per page
$results_per_page = 10;

// Check if a specific date is selected for filtering
$filter_date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");

// Prepare the SQL query based on the filter date
$sql = 'SELECT *, dondatmon.MaNV FROM dondatmon LEFT JOIN menu ON dondatmon.MaMenu = menu.MaMenu LEFT JOIN monan ON menu.MaMon = monan.MaMon ';
if (!empty($filter_date)) {
    $sql .= " WHERE NgayDat = '$filter_date'";
}

$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// Determine number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

?>
<?php
require_once __DIR__ . "../../breadcrumb.php";
?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Đơn Đặt Món</h1>
</div>

<div class="content flex-1 mt-2 ml-8">
    <form action="" method="GET" class="filter-form">
        <label for="date" class="filter-label">Lọc Theo Ngày:</label>
        <input type="date" id="date" name="date" value="<?php echo $filter_date; ?>" class="filter-input">
        <button type="submit" class="filter-button">Lọc</button>
    </form>
    <style>
        .filter-form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-label {
            margin-right: 10px;
            font-weight: bold;
        }

        .filter-input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filter-button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filter-button:hover {
            background-color: #45a049;
        }
    </style>

    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Đơn</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã NV</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Tên Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Hình ảnh</th>
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
                $imagePath = $menuRow['HinhMinhHoa'];

                $srcPosition = strpos($imagePath, 'src');
                if ($srcPosition !== false) {
                    $imagePath = substr($imagePath, $srcPosition);
                }

                $url = 'http://localhost/webfood/' . $imagePath;
                $url = str_replace('\\', '/', $url);
                echo "<tr>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaDon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaNV'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['TenMon'] . "</td>";
                echo '<td class="px-6 py-4 text-gray-900"> <img class="p-8 rounded-t-lg" src="' . $url . '" alt="Image" width="200" height="200" />';
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['NgayDat'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['TongTien'] . "</td>";
                // echo "<td class='py-3 px-6 text-left'>" . $menuRow['TrangThai'] . "</td>";
                if ($menuRow['DanhGia'] == null) {
                    $menuRow['DanhGia'] = "Chưa đánh giá";
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['DanhGia'] . " </td>";
                } else {
                    echo "<td class='py-3 px-6 text-left'>" . $menuRow['DanhGia'] . " sao </td>";
                }

                // Add the approve button
                echo "<td class='py-3 px-6 text-left'>";

                if ($menuRow['TrangThai'] == 0) {
                    echo "<span class='bg-yellow-500 text-white py-1 px-2 rounded'>Đã đặt</span>";
                } elseif ($menuRow['TrangThai'] == 1) {
                    echo "<span class='bg-green-500 text-white py-1 px-2 rounded'>Đã giao</span>";
                } elseif ($menuRow['TrangThai'] == 2) {
                    echo "<span class='bg-red-500 text-white py-1 px-2 rounded'>Đã hủy</span>";
                } elseif ($menuRow['TrangThai'] == 3) {
                    echo "<span class='bg-blue-500 text-white py-1 px-2 rounded'>Đã Thanh Toán</span>";
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