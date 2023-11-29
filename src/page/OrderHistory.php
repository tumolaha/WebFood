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
            <div class="flex justify-end px-5 py-5">

                <p class="text-xl">
                    Tổng tiền:
                    <?php echo $total ?>
                </p>
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
    </script>
</body>

</html>