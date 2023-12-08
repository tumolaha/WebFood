<?php
require_once __DIR__ . '../../header.php';
require_once __DIR__ . '/SidebarQuanLy.php';
require_once __DIR__ . '../../dbConnection.php';
// Check if the delete button is clicked
if (isset($_POST['delete'])) {
    $menuId = $_POST['delete'];

    // Check if the menu item exists in the menu
    $checkSql = "SELECT * FROM menu WHERE MaMon = $menuId";
    $checkResult = mysqli_query($conn, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "Không thể xóa mục menu. Nó vẫn được sử dụng trong menu.";
    } else {
        // Perform the delete operation
        $deleteSql = "DELETE FROM monan WHERE MaMon = $menuId";
        if (mysqli_query($conn, $deleteSql)) {
            echo "Menu item deleted successfully.";
        } else {
            echo "Error deleting menu item: " . mysqli_error($conn);
        }
    }
}
// get data from database
$results_per_page = 10;

// Find out the number of results stored in database
$sql = 'SELECT * FROM monan';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// Determine number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
?>
<div class=" w-full overflow-auto">
    <?php
    require_once __DIR__ . "../../breadcrumb.php";
    ?>
    <div class=" px-5 py-10">
        <h1 class="text-2xl font-bold text-black">Quản lý Món </h1>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 p-2">
        <div class="pb-4  flex justify-end">
            <a href="./ThemMonAn.php" class="text-white mt-1 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Thêm
                món ăn</a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase text-center bg-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Mã Món
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tên Món

                    <th scope="col" class="px-6 py-3">
                        Hình Minh Họa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Công Thức
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Trạng Thái
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ngày Tạo
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = $row['HinhMinhHoa'];

                        $srcPosition = strpos($imagePath, 'src');
                        if ($srcPosition !== false) {
                            $imagePath = substr($imagePath, $srcPosition);
                        }

                        $url = 'http://localhost/webfood/' . $imagePath;
                        $url = str_replace('\\', '/', $url);

                        echo '<tr class="bg-white border-b dark:bg-gray-200 dark:border-gray-200 hover:bg-gray-500 text-center dark:hover:bg-gray-300">';
                        echo '<td scope="row"  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">' . $row["MaMon"] . '</td>';
                        echo '<td class="px-6 py-4 text-gray-900">' . $row["TenMon"] . '</td>';
                        echo '<td class="px-6 py-4 text-gray-900"> <img class="p-8 rounded-t-lg" src="' . $url . '" alt="Image" width="200" height="200" />';
                        echo '<td class="px-6 py-4 text-gray-900">' . $row["CongThuc"] . '</td>';
                        echo '<td class="px-6 py-4 text-gray-900">' . $row["trangthai"] . '</td>';
                        echo '<td class="px-6 py-4 text-gray-900">' . $row["ngaytao"] . '</td>';
                        echo '<td class="px-6 py-4">';
                        echo '<a href="./SuaMonAn.php?id=' . $row["MaMon"] . '" class="font-medium text-blue-600 hover:underline">Sửa</a>';
                        echo '</td>';
                        echo '<td class="px-6 py-4">';
                        echo '<button type="button" class="font-medium text-red-600 hover:underline" onclick="openModal(' . $row['MaMon'] . ')">Xoá</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "0 results";
                }


                ?>
            </tbody>
        </table>
        <div class="flex flex-col items-end justify-center">
            <!-- Help text -->
            <span class="text-sm text-gray-700 space-y-2 ">
                Hiển thị từ <span class="font-semibold text-gray-900 ">1</span> tới <span class="font-semibold text-gray-900 ">10</span> của <span class="font-semibold text-gray-900 ">100</span>
                Nguyên vật liệu
            </span>
        </div>
        <div class="flex item-start gap-3 w-full">
            <?php
            for ($page = 1; $page <= $number_of_pages; $page++) {
                echo '<a href="../../page/QuanLy/QuanLyMon.php?page=' . $page . '" class="mx-1 px-3 py-2 bg-gray-300 text-gray-700 hover:bg-gray-700 hover:text-white rounded-md">' . $page . '</a>';
            }
            ?>
        </div>

    </div>

    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="delete-modal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938-6.5a9 9 0 1113.876 0A9 9 0 015.062 6.5z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                Xác nhận xoá
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Bạn có chắc chắn muốn xoá nguyên liệu này không?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form method="post" action="QuanLyMon.php" id="delete-form">
                        <input type="hidden" name="delete" id="delete-id">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Xoá
                        </button>
                    </form>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">
                        Hủy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content -->


<script>
    function openModal(id) {
        document.getElementById('delete-id').value = id;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }
</script>

<?php
$conn->close();
require_once __DIR__ . '../../footer.php';
?>