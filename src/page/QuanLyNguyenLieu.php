<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wed Food</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .animated {
      -webkit-animation-duration: 1s;
      animation-duration: 1s;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
    }

    .animated.faster {
      -webkit-animation-duration: 500ms;
      animation-duration: 500ms;
    }

    .fadeIn {
      -webkit-animation-name: fadeIn;
      animation-name: fadeIn;
    }

    .fadeOut {
      -webkit-animation-name: fadeOut;
      animation-name: fadeOut;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
      }
    }
  </style>

</head>

<body>

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
              <button class="cursor-pointer group relative flex gap-1.5 px-8 py-2 bg-blue-300 bg-opacity-50 text-[#f1f1f1] rounded-3xl hover:bg-opacity-70 transition font-semibold shadow-md">
                login
              </button>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </section>
  <div class="container flex">
    <section class="sidebar h-[calc(100vh-64px)]">
      <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 h-full w-[300px] p-4 shadow-xl shadow-blue-gray-900/5">
        <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
          <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> person_apron </span>
            </div>
            quản lí nhân viên
          </div>
          <a href="QuanLyNguyenLieu.php" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> fastfood </span>
            </div>
            Quản Lý Nguyên Vật Liệu
          </a>
          <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> lunch_dining </span>
            </div>
            Quản Lý Món Ăn
          </div>
          <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> description </span>
            </div>
            Duyệt Phiếu Đề Xuất
          </div>
          <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> monitoring </span>
            </div>
            Thống Kê Danh Sách Đặt Món
          </div>
          <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
            <div class="grid place-items-center mr-4">
              <span class="material-symbols-outlined"> receipt_long </span>
            </div>
            Lịch Sử Đánh Giá
          </div>
        </nav>
      </div>
    </section>
    <section class="content flex-1 mt-2 ml-8 ">
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
            <tr>

              <th scope="col" class="px-6 py-3">
                STT
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

              </th>
            </tr>
          </thead>
          <tbody>
            <!-- delete -->

            <!-- render table -->
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "food_store";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
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
        <!-- button -->
        <!-- <div class="inline-flex mt-2 xs:mt-0 mr-12s">

                            <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-500 rounded-l hover:bg-gray-900 ">
                              <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                              </svg>
                              Prev
                            </button>
                            <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-500 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 ">
                              Next
                              <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                              </svg>
                            </button>
                          </div> -->
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
  </section>
  <section class="footer"></section>
</body>

</html>