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
            <form method="POST">
                <div class="flex cursor-pointer items-center gap-2 justify-center">
                    <p class="font-bold">Chọn ngày</p>
                    <input type="text" class="border-2 p-1" id="datepicker" name="datepicker" value=<?php echo date("d/m/Y"); ?>
                        placeholder="Select a date">
                    <svg id="datepicker-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-96-88v64a8,8,0,0,1-16,0V132.94l-4.42,2.22a8,8,0,0,1-7.16-14.32l16-8A8,8,0,0,1,112,120Zm59.16,30.45L152,176h16a8,8,0,0,1,0,16H136a8,8,0,0,1-6.4-12.8l28.78-38.37A8,8,0,1,0,145.07,132a8,8,0,1,1-13.85-8A24,24,0,0,1,176,136,23.76,23.76,0,0,1,171.16,150.45Z">
                        </path>
                    </svg>
                    <button type="submit" name="submit"
                        class="w-[100px] text-white bg-yellow-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Xem
                    </button>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <script>
                        $(function () {
                            $("#datepicker").datepicker();
                            $("#datepicker-icon").click(function () {
                                $("#datepicker").datepicker("show");
                            });
                        });
                    </script>
                </div>
            </form>


            <div class="grid grid-cols-3 gap-4">
                <?php
                include("dbConnection.php");
                $date = date("Y-m-d");

                if (isset($_POST['submit']) ) {
                    $date = DateTime::createFromFormat('d/m/Y', $_POST['datepicker']);
                    $date = $date->format('Y-m-d');
                    
                }
                //set giá trị của datepicker là = $date
                echo '<script>document.getElementById("datepicker").value = "' . date("d/m/Y", strtotime($date)) . '"</script>';

                $sql = "SELECT monan.* FROM monan JOIN menu ON monan.MaMon = menu.MaMon WHERE menu.ngayban = ? AND monan.trangthai = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $date);
                $stmt->execute();

                $result = $stmt->get_result();

                //loop and display each item
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="w-[250px]  bg-white border border-gray-200 rounded-lg shadow ">';
                        echo '<a href="order.php?id=' . $row['MaMon'] . '">';
                        echo '<img class="p-8 rounded-t-lg" src="' . $row['HinhMinhHoa'] . '" alt="product image" />';
                        echo '</a>';
                        echo '<div class="px-5 pb-5">';
                        echo '<a href="order.php?id=' . $row['MaMon'] . '">';
                        echo '<h5 class="text-sm font-semibold tracking-tight text-gray-900 ">' . $row['TenMon'] . '</h5>';
                        echo '</a>';
                        
                        echo '<div class="flex items-center justify-between">';
                        echo '<span class="text-sm font-bold text-gray-900 ">' . $row['DonGia'] . ' VNĐ</span>';
                        
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="w-full flex justify-center text-center text-gray-500 mt-8">';
                    echo 'Không có thực đơn cho ngày này.';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </div>
    <section class="footer "></section>

</body>

</html>

</body>

</html>