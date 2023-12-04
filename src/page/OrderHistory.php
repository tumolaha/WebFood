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
    <?php include 'header.php'; ?>
    <div class="flex w-screen bg-blue-100/30">
        <!-- sidebar -->
        <?php include 'EmployeeSidebar.php'; ?>
        <?php
        include("dbConnection.php");
        $sql = "select * from dondatmon where trangthai = 1 ";
        if (isset($_POST['saveReport'])) {
            $danhgia = $_POST['danhgia'];
            $id = $_POST['MaDon'];
            $sql = "UPDATE dondatmon SET DanhGia = '$danhgia' WHERE MaDon = $id";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Đánh giá thành công')</script>";
            } else {
                echo "<script>alert('Đánh giá thất bại')</script>";
            }
        }
        $sql = "SELECT * FROM dondatmon join monan on dondatmon.MaMon = monan.MaMon WHERE dondatmon.trangthai = 1";
                        $result = mysqli_query($conn, $sql);
                        $total = 0;
                        $list = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['MaMon'];
                            $sql1 = "SELECT * FROM monan WHERE MaMon = $id";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $total += ($row['DonGia'] * $row['soluong']);
                            array_push($list, array($row1['TenMon'], $row['soluong'], $row['DonGia']));
                        }

        ?>
        <!-- content -->
        <section class="content w-full px-10 py-5">
            <h1 class="text-2xl font-bold">Lịch sử đặt món</h1>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("dbConnection.php");
                        $sql = "SELECT * FROM dondatmon WHERE trangthai = 1";
                        $result = mysqli_query($conn, $sql);
                        $total = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            $id = $row['MaMon'];
                            $sql1 = "SELECT * FROM monan WHERE MaMon = $id";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $total += $row1['DonGia'] * $row['soluong'];
                            $imagePath = $row1['HinhMinhHoa'];
                            $url = str_replace('C:\\xampp\\htdocs\\WebFood', 'http://localhost/webfood', $imagePath);
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
                                ' . $row1['DonGia'] . '
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
                        </tr>
                    ';
                        }
                        ?>


                    </tbody>
                </table>
            </div>
            <div class="flex flex-col items-end py-5 px-2 justify-end">
                <p class="mr-5">Tổng số tiền :
                    <?php echo $total ?>
                </p>

                <div class="px-6 py-4">
                    <button type="button" onclick="openModalThanhToan('cancelModal')"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hủy</button>
                    <button type="button" onclick="openModalThanhToan('approveModal')"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Thanh
                        Toán</button>
                </div>
            </div>

            <div id="cancelModal"
                class="modal hidden fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="modal-content bg-white p-4 rounded-lg">
                    <h2>Xác nhận hủy đơn hàng</h2>
                    <p>Bạn có chắc chắn muốn hủy đơn hàng này?</p>

                    <form method="post">
                        <input type="hidden" name="cancelId" value="<?php echo $id ?>">
                        <div class="flex items-center justify-center gap-5">
                            <button type="submit" name="confirmCancel"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hủy</button>
                            <button type="button" onclick="closeModal('cancelModal')"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="approveModal"
                class="modal hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-gray-700 ">
                <div class="modal-content bg-white p-4 flex flex-col  rounded-lg px-10">
                    <h2 class="text-2xl border-b-2 border-yellow-500">Thông tin thanh toán</h2>
                    <p class="mt-10">Thông tin các món ăn</p>
                    <div class="flex justify-between px-3 text-base font-semibold mb-10 w-[500px] mt-5">

                        <?php
                        foreach ($list as $item) {
                            echo '<p>Tên món ăn: ' . $item[0] . ' : </p>';
                            echo ' <p>Số lượng: ' . $item[1] . '</p>';
                            echo ' <p>Đơn giá: ' . $item[2] . '</p>';
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
                            <button type="submit" name="confirmApprove"
                                class="text-black w-full border-[1px] border-gray-800  font-bold py-2 px-4 rounded">Trả
                                khi
                                nhận hàng</button>
                        </div>
                    </form>
                    <form method="post" action="vnpay.php?MaDon=<?php echo $id ?>">
                        <div class="flex items-center justify-center my-3 mx-auto gap-5 w-[90%]">
                            <input type="hidden" name="approveId" value="<?php echo $id ?>">
                            <button type="submit" name="redirect"
                                class="text-black w-full border-[1px] border-gray-800  font-bold py-2 px-4 rounded">Thanh
                                Toán
                                qua VNPAY</button>
                        </div>
                    </form>
                    <form method="post">
                        <div class="flex items-center justify-center my-3 mx-auto gap-5 w-[90%]">
                            <button type="submit" name="cancelApprove" onclick="closeModal('approveModal')"
                                class="bg-gray-500 w-full hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <section class="footer "></section>

    <!-- Modal -->
    <div id="myModal" class="modal   hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-gray-700 ">
        <!-- Modal content -->
       
        <div class="modal-content w-[550px] h-[200px] p-2">
            <div class="flex justify-end items-center">

                <span class="w-[20px] h-[20px] cursor-pointer text-white bg-red-500" class="close" onclick="closeModal()">&times;</span>
            </div>
                    <p>Nhập đánh giá của bạn </p>
            <form method="post">
                <input id="modalMaDon" name="MaDon" class="hidden">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input name="danhgia" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Nhập đánh giá của bạn" required>
                <div class="flex justify-center my-5">

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

        window.onclick = function (event) {
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
    </script>
</body>

</html>