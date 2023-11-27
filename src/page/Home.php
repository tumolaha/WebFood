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
    <!-- header -->
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
            </div>
        </section>
    </div>
    <section class="footer "></section>

</body>

</html>