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
        <section class="content w-full px-10 ml-20 py-5">
            <h1 class="text-2xl font-bold">Xem thông tin đơn đặt món</h1>
            <?php include_once("breadcrumb.php"); ?>

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
                                Ngày đặt
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include("dbConnection.php");


                        if (isset($_POST['confirmApprove'])) {
                            $id = $_POST['approveId'];
                            $sql = "UPDATE dondatmon SET trangthai = 2 WHERE MaMon = $id";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                echo "<script>alert('Hủy hàng thành công')</script>";
                            } else {
                                echo "<script>alert('Hủy hàng thất bại')</script>";
                            }
                        }
                        $sql = "SELECT * FROM dondatmon join monan on dondatmon.MaMon = monan.MaMon WHERE dondatmon.trangthai = 0";
                        $result = mysqli_query($conn, $sql);
                        $total = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $imagePath = $row['HinhMinhHoa'];

                            $srcPosition = strpos($imagePath, 'src');
                            if ($srcPosition !== false) {
                                $imagePath = substr($imagePath, $srcPosition);
                            }

                            $url = 'http://localhost/webfood/' . $imagePath;
                            $url = str_replace('\\', '/', $url); // Replace backslashes with forward slashes
                            $id = $row['MaMon'];
                            $sql1 = "SELECT * FROM monan WHERE MaMon = $id";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $total += ($row['DonGia'] * $row['soluong']);

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
                            <td class="px-6 py-4">
                                ' . $row['NgayDat'] . '
                            </td>
                            <td onclick="openModal(\'confirmModal' . $row['MaMon'] . '\')" class="px-6 py-4 bg-red-500 w-[100px] text-center rounded-lg text-white cursor-pointer font-bold">
                                                <button >Hủy</button>
                                            </td>
                                            
                            
                                        </tr>
                                        <div id="confirmModal' . $row['MaMon'] . '" class="modal  hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-gray-700">
                                        <div class=" modal-content w-[300px] h-[100px] p-2 gap-2 text-center flex flex-col items-center">
                                        <div class="absolute right-0 top-0">
                                        <div class="close w-5 h-5 rounded-lg bg-red-500 text-white flex justify-center items-center cursor-pointer" onclick="closeModal(\'confirmModal' . $row['MaMon'] . '\')">&times;</div>
                                        </div>
                                        <div class="flex gap-10 text-base font-bold">
                                            <h3>Xác nhận hủy đơn hàng</h3>
                                        </div>    
                                            <form method="post">
                                            <div class="flex justify-start gap-4">
                                            <input type="hidden" name="approveId" value="' . $row['MaMon'] . '">
                                                <input type="submit" name="confirmApprove" class="w-20 h-9 bg-green-500 text-white rounded-lg text-bold cursor-pointer" value="Xác nhận" class="btn btn-primary">
                                                <input type="submit" name="" class="w-20 h-9 bg-red-500 text-white rounded-lg text-bold  cursor-pointer" value="Hủy" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                    
                                
                                        
                                        ';
                        }
                        ?>



                        </tr>

                    </tbody>
                </table>
                <!-- Confirmation Modal for Approval -->


            </div>
    </div>
    </section>
    </div>

    <!-- content -->

    <script>
        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
            }
        }

        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>
<script src="./Sidebar/js/script.js"></script>

</html>