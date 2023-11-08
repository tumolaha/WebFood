<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wed Food</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- header -->
  <section class="header">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <h5 class="text-sm text-white font-medium">Dao Meo</h5>
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <!-- <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Team</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Projects</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Calendar</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reports</a> -->
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <button
                class="cursor-pointer group relative flex gap-1.5 px-8 py-2 bg-blue-300 bg-opacity-50 text-[#f1f1f1] rounded-3xl hover:bg-opacity-70 transition font-semibold shadow-md">
                login
              </button>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </section>
  <div class="flex w-screen">
    <!-- sidebar -->
    <section class="sidebar h-[calc(100vh-64px)]">
      <div
        class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 h-full w-[300px] p-4 shadow-xl shadow-blue-gray-900/5">
        <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> person_apron </span>
            </div>
            quản lí nhân viên
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> fastfood </span>
            </div>
            Quản Lý Nguyên Vật Liệu
          </div>

          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> lunch_dining </span>
            </div>
            Quản Lý Món Ăn
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> description </span>
            </div>
            Duyệt Phiếu Đề Xuất
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> monitoring </span>
            </div>
            Thống Kê Danh Sách Đặt Món
          </div>
          <div role="button" tabindex="0"
            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> receipt_long </span>
            </div>
            Lịch Sử Đánh Giá
          </div>
        </nav>
      </div>
    </section>
    <!-- content -->
    <section class="content w-full px-10 py-5">
      <div class="mb-10">
        <h5 class="text-xl font-bold text-black">Quản Lý Nhân Viên</h5>

      </div>
      <div class="flex justify-between">
        <div class="flex">
          <form action="EmployeeManager.php" class="flex" method="get">
            <input type="text" id="search" name="search"
              class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-[300px] text-sm border-gray-300 p-2.5"
              placeholder="TenNV" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit"
              class="inline-block px-3 py-3 text-sm font-medium text-white bg-violet-600 border border-violet-600 rounded active:text-violet-500 hover:bg-transparent hover:text-violet-600 focus:outline-none focus:ring">
              Tìm Kiếm
            </button>
          </form>

        </div>
        <a class="inline-block px-12 py-3 text-sm font-medium text-white bg-violet-600 border border-violet-600 rounded active:text-violet-500 hover:bg-transparent hover:text-violet-600 focus:outline-none focus:ring"
          href="AddEmployee.php">
          Thêm Nhân Viên
        </a>
      </div>

      <table class="w-full divide-y divide-gray-200 overflow-x-auto">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "food_store";
              $output = "";
              $limit = 5; // number of rows per page
              $paging = isset($_GET['paging']) ? $_GET['paging'] : 1; // current page number
              $offset = ($paging - 1) * $limit; // offset for SQL query
              
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);

              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

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