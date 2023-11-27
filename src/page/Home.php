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

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body>

    <?php include_once("header.php"); ?>

    <div class="flex w-screen bg-blue-100/30">
        <!-- sidebar -->
        <?php include_once("EmployeeSidebar.php"); ?>
        <!-- content -->
        <section class="content w-full px-10 py-5">
            <div class="flex cursor-pointer items-center gap-2 justify-center">
                <p class="font-bold">Chọn ngày</p>

                <input type="text" class="border-2 p-1" id="datepicker" name="date" placeholder="Select a date">
                <svg id="datepicker-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-96-88v64a8,8,0,0,1-16,0V132.94l-4.42,2.22a8,8,0,0,1-7.16-14.32l16-8A8,8,0,0,1,112,120Zm59.16,30.45L152,176h16a8,8,0,0,1,0,16H136a8,8,0,0,1-6.4-12.8l28.78-38.37A8,8,0,1,0,145.07,132a8,8,0,1,1-13.85-8A24,24,0,0,1,176,136,23.76,23.76,0,0,1,171.16,150.45Z">
                    </path>
                </svg>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script>
                    $(function () {
                        $("#datepicker").datepicker({
                            onSelect: function (dateText, inst) {
                                $.ajax({
                                    action: "#",// URL của file PHP để xử lý yêu cầu
                                    type: 'POST',
                                    data: { date: dateText }, // Gửi ngày được chọn đến máy chủ
                                    success: function (data) {
                                        // Xử lý dữ liệu trả về từ máy chủ ở đây
                                        console.log(data);
                                        // Hiển thị dữ liệu lên trang web
                                        $("#menu-items").html(data);
                                    }
                                });
                            }
                        });

                        $("#datepicker-icon").click(function () {
                            $("#datepicker").datepicker("show");
                        });


                    });
                </script>
            </div>
            <?php
            include_once("dbConnection.php");
            if (isset($_POST['date'])) {
                $date = $_POST['date'];
                // Xác thực và làm sạch dữ liệu ở đây
                echo $date;
                $sql = "SELECT monan.* FROM monan JOIN menu ON monan.MaMon = menu.MaMon WHERE menu.ngayban = ? AND monan.trangthai = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $date);
                $stmt->execute();
                //in kết quả
                $result = $stmt->get_result();

                //in kết quả
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo $row["TenMon"] . "<br>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
            }


            ?>
            <h1 class="font-bold text-xl my-2">Món Mặn</h1>

            <div id="menu-items" class="grid grid-cols-3 gap-4">
                <!-- Menu items will be dynamically loaded here -->
              <section class="header w-screen ">
        <nav class="bg-gray-800 ">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 overflow-x-hidden">
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
    <div class="flex w-screen bg-blue-100/30">
        <!-- sidebar -->
        <section class="sidebar h-[calc(100vh-64px)]">
            <div
                class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 h-full w-[300px] p-4 shadow-xl shadow-blue-gray-900/5">
                <div class="flex flex-col h-screen justify-between">
                    <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> Home </span>
                            </div>
                            Trang chủ
                        </div>
                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> History </span>
                            </div>
                            Lịch sử đặt món
                        </div>

                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> Mail  </span>
                            </div>
                            Đánh giá món ăn
                        </div>
                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> description </span>
                            </div>
                            Đề xuất món ăn
                        </div>
                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> settings </span>
                            </div>
                            Cài đặt
                        </div>

                    </nav>
                    <div role="button" tabindex="0"
                        class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                        <div class="grid place-items-center mr-4">
                            <span class="material-symbols-outlined"> logout </span>
                        </div>
                        Đăng xuất
                    </div>
                </div>

            </div>
        </section>
        <!-- content -->
        <section class="content w-full px-10 py-5">
            <h1 class="font-bold text-xl my-2">Món Mặn</h1>
            <div class="grid grid-cols-3 gap-4">
                <div class="w-[250px]  bg-white border border-gray-200 rounded-lg shadow ">
                    <a href="#">
                        <img class="p-3 rounded-t-lg" src="https://mayviendong.vn/wp-content/uploads/2019/10/th%E1%BB%8Bt-kho-t%C3%A0u.jpg" alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            <h5 class="text-sm font-semibold tracking-tight text-gray-900 ">Thịt kho tàu</h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-900 ">$599</span>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
             <h1 class="font-bold text-xl my-5">Món Mặn</h1>
            <div class="grid grid-cols-3 gap-4">
                <div class="w-[250px]  bg-white border border-gray-200 rounded-lg shadow ">
                    <a href="#">
                        <img class="p-8 rounded-t-lg" src="https://mayviendong.vn/wp-content/uploads/2019/10/th%E1%BB%8Bt-kho-t%C3%A0u.jpg" alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            <h5 class="text-sm font-semibold tracking-tight text-gray-900 ">Thịt kho tàu</h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-900 ">$599</span>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center">Add to cart</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <section class="footer "></section>

</body>

</html>