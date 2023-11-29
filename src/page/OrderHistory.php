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
                            echo '
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="w-32 p-4">
                                <img src="' . $row1['HinhMinhHoa'] . '" alt="Apple Watch">
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
                            <form method="post">
                                <input value=' . $row['MaDon'] . ' name="MaDon" class="hidden">
                                <input type="text" name="danhgia" placeholder="Đánh giá món ăn">
                                <button type="submit" name="saveReport">Lưu</button>
                            </form>
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
</body>

</html>