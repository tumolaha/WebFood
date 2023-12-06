<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wed Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./Sidebar/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <div class="flex w-screen bg-blue-100/30">
        <!-- sidebar -->
        <?php include_once("./Sidebar/html/index.php"); ?>

        <!-- <?php include_once("EmployeeSidebar.php"); ?> -->
        <!-- content -->
        <section class="content w-full px-10 ml-20 py-5">
            <form method="POST">
                <div class="flex cursor-pointer items-center gap-2 justify-center">
                    <p class="font-bold">Chọn ngày</p>
                    <input type="text" class="border-2 p-1" id="datepicker" name="datepicker" value="<?php echo date("d/m/Y"); ?>" placeholder="Select a date">
                    <svg id="datepicker-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                        <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-96-88v64a8,8,0,0,1-16,0V132.94l-4.42,2.22a8,8,0,0,1-7.16-14.32l16-8A8,8,0,0,1,112,120Zm59.16,30.45L152,176h16a8,8,0,0,1,0,16H136a8,8,0,0,1-6.4-12.8l28.78-38.37A8,8,0,1,0,145.07,132a8,8,0,1,1-13.85-8A24,24,0,0,1,176,136,23.76,23.76,0,0,1,171.16,150.45Z">
                        </path>
                    </svg>
                    <button type="submit" name="submit" class="w-[100px] text-white bg-yellow-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Xem
                    </button>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <script>
                        $(function() {
                            $("#datepicker").datepicker({
                                dateFormat: 'dd/mm/yy',
                                onSelect: function(dateText, inst) {
                                    $(this).val(dateText);
                                }
                            });
                            $("#datepicker-icon").click(function() {
                                $("#datepicker").datepicker("show");
                            });
                        });
                    </script>
                </div>
            </form>


            <div class="grid grid-cols-4 mt-10 gap-2">
                <?php
                include("dbConnection.php");
                $date = date("Y-m-d");
                if (isset($_POST['submit'])) {
                    $date = DateTime::createFromFormat('d/m/Y', $_POST['datepicker']);
                    $date = $date->format('Y-m-d');
                    //set lại giá trị cho datepicker
                    echo '<script>';
                    echo '$("#datepicker").val("' . $_POST['datepicker'] . '");';
                    echo '</script>';
                }
                $sql = "SELECT monan.* FROM monan JOIN menu ON monan.MaMon = menu.MaMon WHERE menu.ngayban = ? AND monan.trangthai = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $date);
                $stmt->execute();

                $result = $stmt->get_result();

                //loop and display each item
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {


                        $imagePath = $row['HinhMinhHoa'];

                        $srcPosition = strpos($imagePath, 'src');
                        if ($srcPosition !== false) {
                            $imagePath = substr($imagePath, $srcPosition);
                        }
                        $sqlGetRating = "SELECT AVG(DanhGia) as diem FROM dondatmon WHERE MaMon = ?";
                        $stmtGetRating = $conn->prepare($sqlGetRating);
                        $stmtGetRating->bind_param("i", $row['MaMon']);
                        $stmtGetRating->execute();
                        $resultGetRating = $stmtGetRating->get_result();
                        $rowGetRating = $resultGetRating->fetch_assoc();
                        $rating = $rowGetRating['diem'];
                        $url = 'http://localhost/webfood/' . $imagePath;
                        $url = str_replace('\\', '/', $url); // Replace backslashes with forward slashes
                        echo '<div class="w-[250px]  h-[300px] bg-white border border-gray-400 rounded-lg shadow ">';
                        echo '<a href="order.php?id=' . $row['MaMon'] . '">';
                        echo '<img class="p-8 rounded-t-lg h-[210px]" src="' . $url . '" alt="Image" />';
                        echo '</a>';
                        echo '<div class="flex justify-between">';
                        echo '<div class="px-5 flex flex-col items-center justify-center pb-5">';
                        echo '<a href="order.php?id=' . $row['MaMon'] . '">';
                        echo '<h5 class="text-sm font-semibold tracking-tight text-gray-900 ">' . $row['TenMon'] . '</h5>';
                        echo '</a>';

                        echo '<div class="flex items-center justify-between">';
                        echo '<span class="text-sm font-bold text-gray-900 ">' . $row['DonGia'] . ' VNĐ</span>';

                        echo '</div>';
                        echo '</div>';
                        echo '<a href="order.php?id=' . $row['MaMon'] . '" class="h-10 text-sm cursor-pointer w-20 rounded-lg text-center pt-2 bg-green-500 mr-2 text-white ">Mua Hàng</a>';
                        echo '</div>';
                        $ratingValue = round($rating);

                        // Display the rating icons
                        echo '<div class="flex justify-center items-center mb-10">';
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $ratingValue) {
                                echo '<svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">';
                                echo '<path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"></path>';
                                echo '</svg>';
                            } else {
                                echo '<svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">';
                                echo '<path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"></path>';
                                echo '</svg>';
                            }
                        }
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

    <script src="./Sidebar/js/script.js"></script>
</body>

</html>

</body>

</html>