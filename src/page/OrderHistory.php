<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wed Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="./Sidebar/css/style.css">
</head>

<body>
    <!-- header -->
    <div class="flex w-screen bg-blue-100/30">
        <!-- sidebar -->
        <?php include_once("./Sidebar/html/index.php"); ?>

        <!-- content -->
        <section class="content w-full px-10  py-5">
            <h1 class="text-2xl font-bold">Lịch sử đặt món
            </h1>
            <?php include_once("breadcrumb.php"); ?>
            <form method="POST">
                <div class="flex items-center mt-4 mb-4">
                    <label for="datepicker" class="mr-2">Chọn tháng và năm:</label>
                    <input type="month" id="datepicker" name="monthPicker" class="border border-gray-300 px-2 py-1 rounded" />
                    <button type="submit" name="month" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Xem</button>
                </div>
            </form>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Image</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tên món
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Đơn giá
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Số lượng
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Chi tiết món ăn
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ngày đặt
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Đánh giá
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Trạng thái
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("dbConnection.php");
                        $month = date('m');
                        $year = date('Y');
                        if (isset($_POST['month'])) {
                            $monthYear = $_POST['monthPicker'];
                            $date = explode('-', $monthYear);
                            $year = $date[0];
                            $month = $date[1];
                            echo '<script>'
                                . 'document.getElementById("datepicker").value = "' . $monthYear . '";'
                                . '</script>';
                        }

                        $sql = "SELECT * FROM dondatmon join menu on dondatmon.MaMenu = menu.MaMenu WHERE trangthai IN (1, 3) AND MONTH(NgayDat) = $month and YEAR(NgayDat) = $year";
                        $result = mysqli_query($conn, $sql);
                        $total = 0;
                        while ($row = mysqli_fetch_assoc($result)) {

                            $id = $row['MaMon'];
                            $sql1 = "SELECT * FROM monan WHERE MaMon = $id";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            if ($row['TrangThai'] == 1)
                                $total += $row['gia'] * $row['soluong'];
                            $imagePath = $row1['HinhMinhHoa'];

                            $srcPosition = strpos($imagePath, 'src');
                            if ($srcPosition !== false) {
                                $imagePath = substr($imagePath, $srcPosition);
                            }

                            $url = 'http://localhost/webfood/' . $imagePath;
                            $url = str_replace('\\', '/', $url); // Replace backslashes with forward slashes
                            echo '
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="w-32 p-4">
                                <img src="' . $url . '" alt="Apple Watch">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 ">
                                ' . $row1['TenMon'] . '
                            </td>
                            <td class="px-6 py-4">
                                ' . $row['gia'] . '
                            </td>
                            <td class="px-6 py-4">
                                ' . $row['soluong'] . '
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 ">
                                <a href="OrderDetail.php?id=' . $row['MaDon'] . '" class="text-sm text-blue-500 cursor-pointer">Chi tiết món
                                    ăn</a>
                            </td>
                            <td class="px-6 py-4">
                                ' . $row['NgayDat'] . '
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="openModal(' . $row['MaDon'] . ')" class="text-sm text-blue-500 cursor-pointer">Đánh giá</button>
                            </td>
                            <td class="px-6 py-4 ">
                                ' . ($row['TrangThai'] == 3 ? 'Đã thanh toán' : 'Chưa thanh toán') . '
                        </tr>
                    ';
                        }
                        ?>


                    </tbody>
                </table>
                <?php
                include("dbConnection.php");
                $sql = "select * from dondatmon where trangthai = 1 ";
                if (isset($_POST['saveReport'])) {
                    $danhgia = $_POST['ratingValue'];
                    $id = $_POST['MaDon'];
                    $sql = "UPDATE dondatmon SET DanhGia = $danhgia WHERE MaDon = $id";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "<script>alert('Đánh giá thành công')</script>";
                    } else {
                        echo "<script>alert('Đánh giá thất bại')</script>";
                    }
                }
                $sql = "SELECT * FROM dondatmon join menu on menu.MaMenu = dondatmon.MaMenu join monan on menu.MaMon = monan.MaMon WHERE dondatmon.trangthai = 1 and MONTH(NgayDat) = $month and YEAR(NgayDat) = $year";
                $result = mysqli_query($conn, $sql);
                $total = 0;
                $list = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['MaMon'];
                    $sql1 = "SELECT * FROM monan WHERE MaMon = $id";
                    $result1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $total += ($row['gia'] * $row['soluong']);
                    array_push($list, array($row1['TenMon'], $row['soluong'], $row['gia']));
                }

                ?>
            </div>
            <div class="flex flex-col items-end py-5 px-2 justify-end">
                <?php if ($total > 0) { ?>
                    <p class="mr-5">Tổng số tiền :
                        <?php echo $total ?>
                    </p>
                <?php } else { ?>
                    <p class="mr-5"> Đã thanh toán tiền trong tháng này
                    </p>
                <?php } ?>
                <div class="px-6 py-4">
                    <button type="button" onclick="openModalThanhToan('cancelModal')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hủy</button>
                    <?php if ($total > 0) { ?>
                        <button type="button" onclick="openModalThanhToan('approveModal')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Thanh
                            Toán</button>
                    <?php } else { ?>
                        <button type="button" disabled class="bg-gray-500  text-white font-bold py-2 px-4 rounded">Thanh
                            Toán</button>
                    <?php } ?>
                </div>
            </div>

            <div id="cancelModal" class="modal hidden fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="modal-content bg-white p-4 rounded-lg">
                    <h2>Xác nhận hủy đơn hàng</h2>
                    <p>Bạn có chắc chắn muốn hủy đơn hàng này?</p>

                    <form method="post">
                        <input type="hidden" name="cancelId" value="<?php echo $id ?>">
                        <div class="flex items-center justify-center gap-5">
                            <button type="submit" name="confirmCancel" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hủy</button>
                            <button type="button" onclick="closeModal('cancelModal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="approveModal" class="modal hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-gray-700 ">
                <div class="modal-content bg-white p-4 flex flex-col  rounded-lg px-10">
                    <h2 class="text-2xl border-b-2 border-yellow-500">Thông tin thanh toán</h2>
                    <p class="mt-10">Thông tin các món ăn</p>
                    <div class="flex flex-col  text-base font-semibold mb-10 w-[500px] mt-5">

                        <?php
                        foreach ($list as $item) {
                            echo '<div class="flex gap-4">';
                            echo '<p>Tên: ' . $item[0] . '  </p>';
                            echo ' <p>Số lượng: ' . $item[1] . '</p>';
                            echo ' <p>Đơn giá:  ' . $item[2] . '</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="flex justify-end">

                        <p class="">Tổng số tiền:
                            <?php echo $total ?> VNĐ
                        </p>
                    </div>
                    <form method="post">
                        <input type="hidden" name="approveId" value="<?php echo $id ?>">
                        <div class="flex items-center justify-center my-3 mx-auto gap-5 w-[90%]">
                            <button type="submit" name="confirmApprove" class="text-black w-full border-[1px] border-gray-800  font-bold py-2 px-4 rounded">Trả
                                khi
                                nhận hàng</button>
                        </div>
                    </form>
                    <form method="post" action="vnpay.php?MaDon=<?php echo $id ?>&Thang=<?php echo $month ?>&Nam=<?php echo $year ?>">
                        <div class="flex items-center justify-center my-3 mx-auto gap-5 w-[90%]">
                            <input type="hidden" name="approveId" value="<?php echo $id ?>">
                            <button type="submit" name="redirect" class="text-black w-full border-[1px] border-gray-800  font-bold py-2 px-4 rounded">Thanh
                                Toán
                                qua VNPAY</button>
                        </div>
                    </form>
                    <form method="post">
                        <div class="flex items-center justify-center my-3 mx-auto gap-5 w-[90%]">
                            <button type="submit" name="cancelApprove" onclick="closeModal('approveModal')" class="bg-gray-500 w-full hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <section class="footer "></section>

    <!-- Modal -->
    <div id="myModal" class="modal  text-center hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-gray-700 ">
        <!-- Modal content -->

        <div class="modal-content w-[550px] h-[200px] p-2 flex flex-col gap-4 ">
            <div class="flex justify-end items-center">

                <span class="w-[20px] h-[20px] cursor-pointer text-white bg-red-500" class="close" onclick="closeModal()">&times;</span>
            </div>
            <p class="font-bold text-xl">Nhập đánh giá của bạn </p>
            <form method="post">
                <input id="modalMaDon" name="MaDon" class="hidden">
                <div class="flex justify-center items-center mb-10">
                    <svg class="w-8 h-8 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <svg class="w-8 h-8 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <svg class="w-8 h-8 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <svg class="w-8 h-8 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <svg class="w-8 h-8 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                </div>
                <input id="ratingValue" name="ratingValue" class="hidden">

                <button class="w-[160px] p-1 rounded-md border-2 border-black bg-green-500 text-white " type="submit" name="saveReport">Lưu</button>
        </div>
        </form>
    </div>
    </div>

    <script>
        function openModal(maDon) {
            document.getElementById("modalMaDon").value = maDon;
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                closeModal();
            }
        }

        function openModalThanhToan(modalId) {
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
            } else {
                console.error('No modal found with ID:', modalId);
            }
        }
        // Select all the stars
        const stars = document.querySelectorAll('.modal-content svg');

        // Variable to store the rating
        let rating = 0;

        // Add click event listener to each star
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                // Update the rating
                rating = index + 1;

                // Update the star colors based on the rating
                stars.forEach((star, index) => {
                    star.style.color = index < rating ? 'yellow' : 'gray';
                });
                document.getElementById("ratingValue").value = rating;

            });
        });

        // Select the form
        const form = document.querySelector('.modal-content form');

        // Add submit event listener to the form
        form.addEventListener('submit', (event) => {
            // Prevent the default form submission
            event.preventDefault();

            // Save the rating
        });
    </script>
</body>
<script src="./Sidebar/js/script.js"></script>

</html>