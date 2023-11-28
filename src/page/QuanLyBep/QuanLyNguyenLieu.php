<?php
require __DIR__ . '../../header.php';
require __DIR__ . '../../QuanLyBep/SiderbarQuanLyBep.php';
?>
<div class="w-full">
  <!-- content -->
  <div class="">
    <h1 class="text-2xl font-bold text-black">Quản lý nguyên vật liệu</h1>
  </div>



  <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 p-2">
    <div class="pb-4  flex justify-end">
      <a href="./ThemNguyenLieu.php" class="text-white mt-1 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Thêm
        sản phẩm</a>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase text-center bg-gray-300">
        <th scope="col" class="px-6 py-3">
          Mã Nguyên Liệu
        </th>
        <th scope="col" class="px-6 py-3">
          Tên Nguyên Liệu
        </th>
        <th scope="col" class="px-6 py-3">
          Số lượng tồn trong kho
        </th>
        <th scope="col" class="px-6 py-3">
          Ngày cập nhật
        </th>
        <th scope="col" class="px-6 py-3">
          Giá
        </th>
        <th scope="col" class="px-6 py-3">
          Đơn vị tính
        </th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
          </tr>
      </thead>
      <tbody>
        <!-- delete -->

        <!-- render table -->
        <?php
        require_once __DIR__ . '../../dbConnection.php';
        // Define how many results you want per page
        $results_per_page = 10;

        // Find out the number of results stored in database
        $sql = 'SELECT * FROM nguyenlieu';
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

        // Determine the sql LIMIT starting number for the results on the displaying page
        $this_page_first_result = ($page - 1) * $results_per_page;

        // Retrieve selected results from database and display them on page
        $sql = 'SELECT * FROM nguyenlieu LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
        $result = mysqli_query($conn, $sql);



        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            echo '<tr class="bg-white border-b dark:bg-gray-200 dark:border-gray-200 hover:bg-gray-500 text-center dark:hover:bg-gray-300">';
            echo '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">' . $row["MaNL"] . '</th>';
            echo '<td class="px-6 py-4 text-gray-900">' . $row["TenNL"] . '</td>';
            echo '<td class="px-6 py-4 text-gray-900">' . $row["SoLuong"] . '</td>';
            echo '<td class="px-6 py-4 text-gray-900">' . $row["NgayNhap"] . '</td>';
            echo '<td class="px-6 py-4 text-gray-900">' . $row["Gia"] . '</td>';
            echo '<td class="px-6 py-4 text-gray-900">' . $row["DonViTinh"] . '</td>';
            echo '<td class="px-6 flex gap-2 py-4 text-gray-900 font-bold">';
            echo '<a href="./SuaNguyenLieu.php?id=' . $row["MaNL"] . '" class="font-medium text-blue-600 hover:underline">Sửa</a>';
            echo '<button type="button" class="font-medium text-red-600 hover:underline" onclick="openModal(' . $row['MaNL'] . ')">Xoá</button>';
            echo '</td>';
            echo '</tr>';
          }
        } else {
          echo "0 results";
        }

        // Handle delete request
        if (isset($_POST['delete_id'])) {
          $id = $_POST['delete_id'];
          $sql = "DELETE FROM nguyenlieu WHERE MaNL='$id'";
          if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
            echo '<script> location.replace("QuanLyNguyenLieu.php"); </script>';
          } else {
            echo "Error deleting record: " . $conn->error;
          }
        }

        $conn->close();
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
        echo '<a href="QuanLyNguyenLieu.php?page=' . $page . '" class="mx-1 px-3 py-2 bg-gray-300 text-gray-700 hover:bg-gray-700 hover:text-white rounded-md">' . $page . '</a>';
      }
      ?>
    </div>

  </div>

  <!-- Modal -->
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
          <form method="post" action="QuanLyNguyenLieu.php" id="delete-form">
            <input type="hidden" name="delete_id" id="delete-id">
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

  <script>
    function openModal(id) {
      document.getElementById('delete-id').value = id;
      document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('delete-modal').classList.add('hidden');
    }
  </script>
</div>
<!-- end content -->
<?php require __DIR__ . '../../footer.php'; ?>