<?php
require __DIR__ . '../../header.php';
require __DIR__ . '/SidebarQuanLy.php';
?>

<div class="mb-10">
  <h5 class="text-xl font-bold text-black">Quản Lý Nhân Viên</h5>
</div>
<div class="flex justify-between">
  <div class="flex">
  </div>
  <a href="./ThemNhanVien.php" class="inline-block px-12 py-3 text-sm font-medium text-white bg-violet-600 border border-violet-600 rounded active:text-violet-500 hover:bg-transparent hover:text-violet-600 focus:outline-none focus:ring">
    Thêm Nhân Viên
  </a>
</div>

<table class="w-full divide-y divide-gray-200 overflow-x-auto mt-5">
  <thead>
    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
      <th class="py-3 px-6 text-left whitespace-nowrap">Mã NV</th>
      <th class="py-3 px-6 text-left whitespace-nowrap">Tên NV</th>
      <th class="py-3 px-6 text-left whitespace-nowrap">Giới Tính</th>
      <th class="py-3 px-6 text-left whitespace-nowrap">Email</th>
      <th class="py-3 px-6 text-left whitespace-nowrap">Số Điện Thoại</th>
      <th class="py-3 px-6 text-left whitespace-nowrap">Edit/Delete</th>
    </tr>
  </thead>
  <thead class="bg-gray-50">
    <tr>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        <?php
        require_once __DIR__ . '../../dbConnection.php';
        // Define how many results you want per page
        $output = "";
        $limit = 5; // number of rows per page
        $paging = isset($_GET['paging']) ? $_GET['paging'] : 1; // current page number
        $offset = ($paging - 1) * $limit; // offset for SQL query
        // SQL query to get rows for current page
        $query = "SELECT * FROM NhanVien LIMIT $limit OFFSET $offset";

        // SQL query to get total number of rows
        $count_query = "SELECT COUNT(*) as count FROM NhanVien";
        if (isset($_GET['search'])) {
          $search = $_GET['search'];

          $count_query = "SELECT COUNT(*) as count FROM NhanVien WHERE TenNV LIKE '%$search%'";
          $query = "SELECT * FROM NhanVien WHERE TenNV LIKE '%$search%' LIMIT $limit OFFSET $offset";
        }

        // Get total number of rows
        $count_result = mysqli_query($conn, $count_query);
        $count_row = mysqli_fetch_assoc($count_result);
        $total_rows = $count_row['count'];

        // Calculate total number of pages
        $total_pages = ceil($total_rows / $limit);

        // Execute SQL query for current page
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
          while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= '
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-900">
                          ' . $row['MaNV'] . '
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            ' . $row['TenNV'] . '
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">';
            if ($row['GioiTinh'] == 1) {
              $output .= '<div class="text-sm text-gray-900">Nam</div>';
            } else {
              $output .= '<div class="text-sm text-gray-900">Nữ</div>';
            }
            $output .= '
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500">' . $row['Email'] . '</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      ' . $row['SDT'] . '
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <form action="EditEmployee.php?id=' . $row['MaNV'] . '" method="post" >
                        <input type="hidden" name="edit_id" value="' . $row['MaNV'] . '">
                        <button type="submit" name="edit" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                      </form>
                      <a href="#" class="ml-2 text-red-600 hover:text-red-900" onclick="deleteEmployee(' . $row['MaNV'] . ')">Delete</a>
                    </td>
                  </tr>
                  ';
          }
          echo $output;

          // Add pagination links
          echo '<nav class="mt-5 w-full flex items-center justify-end">';
          echo '<ul class="flex">';
          if ($paging > 1) {
            echo '<li>';
            echo '<a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300" href="?paging=' . ($paging - 1) . '" aria-label="Previous">';
            echo '<span class="material-symbols-outlined">arrow_back_ios</span>';
            echo '</a>';
            echo '</li>';
          }
          for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li>';
            echo '<a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-pink-600 to-pink-400 p-0 text-sm text-white shadow-md shadow-pink-500/20 transition duration-150 ease-in-out';
            if ($i == $paging) {
              echo ' font-bold';
            }
            echo '" href="?paging=' . $i . '">' . $i . '</a>';
            echo '</li>';
          }
          if ($paging < $total_pages) {
            echo '<li>';
            echo '<a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300" href="?paging=' . ($paging + 1) . '" aria-label="Next">';
            echo '<span class="material-symbols-outlined">arrow_forward_ios</span>';
            echo '</a>';
            echo '</li>';
          }
          echo '</ul>';
          echo '</nav>';
        }

        // Add delete modal
        echo '<div id="delete-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">';
        echo '<div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">';
        echo '<div class="fixed inset-0 transition-opacity" aria-hidden="true">';
        echo '<div class="absolute inset-0 bg-gray-500 opacity-75"></div>';
        echo '</div>';
        echo '<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>';
        echo '<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">';
        echo '<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">';
        echo '<div class="sm:flex sm:items-start">';
        echo '<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">';
        echo '<span class="material-symbols-outlined text-red-600 text-2xl">delete</span>';
        echo '</div>';
        echo '<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">';
        echo '<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">Delete Employee</h3>';
        echo '<div class="mt-2">';
        echo '<p class="text-sm text-gray-500">Are you sure you want to delete this employee?</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">';
        echo '<form id="delete-form" method="post">';
        echo '<input type="hidden" name="delete_id" id="delete-id">';
        echo '<button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>';
        echo '<button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">Cancel</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Add delete script
        echo '<script>';
        echo 'function deleteEmployee(id) {';
        echo 'document.getElementById("delete-id").value = id;';
        echo 'document.getElementById("delete-modal").classList.remove("hidden");';
        echo '}';
        echo 'function closeModal() {';
        echo 'document.getElementById("delete-modal").classList.add("hidden");';
        echo '}';
        echo '</script>';

        // Handle delete request
        if (isset($_POST['delete_id'])) {
          $delete_id = $_POST['delete_id'];
          $delete_query = "DELETE FROM NhanVien WHERE MaNV = $delete_id";
          if (mysqli_query($conn, $delete_query)) {
            echo '<script>alert("Employee deleted successfully.");</script>';
            echo '<script>window.location.href = "EmployeeManager.php";</script>';
          } else {
            echo '<script>alert("Error deleting employee: ' . mysqli_error($conn) . '");</script>';
          }
        }
        ?>
      </th>
    </tr>
  </thead>
</table>
<?php
require __DIR__ . '../../footer.php'; ?>