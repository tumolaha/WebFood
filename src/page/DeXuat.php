<!DOCTYPE html>
<html lang="en">

<head></head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="./Sidebar/css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="flex w-screen bg-blue-100/30">

        <?php include_once("./Sidebar/html/index.php"); ?>
        <section class="content w-full ml-20 px-10 py-5">

            <?php
            include 'dbConnection.php';
            $sql = "SELECT MaNL, TenNL FROM nguyenlieu";
            $result = mysqli_query($conn, $sql);
            $maNguyenLieuList = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $maNguyenLieuList[$row['MaNL']] = $row['TenNL'];
            }

            $errors = [];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tenMon = $_POST['tenmon'];
                $maNV = $_POST['manv'];

                // Insert data into monan table
                $insertDexuatSql = "INSERT INTO dexuatmonan (TenMon, MaNV) VALUES ('$tenMon', '$maNV')";

                if (empty($errors) && mysqli_query($conn, $insertDexuatSql)) {
                    echo "<script>alert('Đề xuất món ăn thành công');</script>";
                } else {
                    foreach ($errors as $error) {
                        echo "<script>alert('$error');</script>";
                    }
                }
            }




            $getNhanVienSql = "SELECT MaNV, TenNV FROM nhanvien";
            $nhanVienResult = mysqli_query($conn, $getNhanVienSql);
            $nhanVienList = [];
            while ($row = mysqli_fetch_assoc($nhanVienResult)) {
                $nhanVienList[$row['MaNV']] = $row['TenNV'];
            }

            ?>


            <form class="max-w-sm mx-auto" method="POST" enctype="multipart/form-data">
                <div class="mb-5">
                    <label for="tenmon" class="block mb-2 text-sm font-medium text-gray-900 ">Tên món</label>
                    <input type="tenmon" id="tenmon" name="tenmon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nhập tên món muốn đề xuất" required>
                </div>
                <div class="mb-5">
                    <label for="manv" class="block text-sm font-medium text-gray-700"> Mã NV</label>
                    <select name="manv"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required>
                        <?php foreach ($nhanVienList as $maNV => $tenNV) { ?>
                            <option value="<?php echo $maNV; ?>">
                                <?php echo $tenNV; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>



                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>

        </section>
    </div>
    <script src="./Sidebar/js/script.js"></script>

</body>

</html>