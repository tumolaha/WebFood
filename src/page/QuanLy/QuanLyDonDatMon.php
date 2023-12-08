<?php
require_once __DIR__ . "../../Header.php";
require_once __DIR__ . "/SidebarQuanLy.php";

// Get the menu data

require_once __DIR__ . '../../dbConnection.php';
// Define how many results you want per page
$results_per_page = 10;

// Get the selected date and maNV
$selected_date = isset($_GET['date']) ? $_GET['date'] : '';
$selected_maNV = isset($_GET['maNV']) ? $_GET['maNV'] : '';

// Build the SQL query
$sql = 'SELECT *, count(menu.MaMon) as soluong FROM dondatmon  
    LEFT JOIN menu ON dondatmon.MaMenu = menu.MaMenu 
    LEFT JOIN monan ON menu.MaMon = monan.MaMon 
    ';

if (!empty($selected_date)) {
    $sql .= " where dondatmon.NgayDat = '$selected_date'";
}

// Add the sorting by day order
$sql .= " GROUP BY monan.MaMon";

// Find out the number of results stored in the database
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// Determine the number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

?>
<?php
require_once __DIR__ . "../../breadcrumb.php";
?>
<div class=" px-5 py-10">
    <h1 class="text-2xl font-bold text-black">Quản lý Đơn đặt món</h1>
</div>
<div class="content flex-1 px-4 W-full">
    <form action="" method="GET" class="my-4">
        <label for="date" class="mr-2">Chọn ngày:</label>
        <input type="date" id="date" name="date" value="<?php echo $selected_date; ?>" class="border border-gray-300 rounded px-2 py-1">

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tìm kiếm</button>
        <a href="QuanLyDonDatMon.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">xoá lọc</a>
    </form>

    <table class="table-auto w-full" style="max-height: 400px; overflow-y: auto;">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <th class="py-3 px-6 text-left whitespace-nowrap">Mã Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Tên Món</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Hình ảnh</th>
                <th class="py-3 px-6 text-left whitespace-nowrap">Số Lượng Đặt</th>
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
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['MaMon'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['TenMon'] . "</td>";
                echo '<td class="px-6 py-4 text-gray-900"> <img class="p-8 rounded-t-lg" src="' . $url . '" alt="Image" width="200" height="200" />';
                echo "<td class='py-3 px-6 text-left'>" . $menuRow['soluong'] . "</td>";
                // echo "<td class='py-3 px-6 text-left'>" . $menuRow['NgayDat'] . "</td>";
                echo "<td class='py-3 px-6 text-left'>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . "../../Footer.php";
?>