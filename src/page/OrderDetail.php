<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="./Sidebar/css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="flex w-screen bg-blue-100/30">

        <?php include_once("./Sidebar/html/index.php"); ?>

        <section class="content w-full px-10  py-5  justify-center items-center">
            <?php include_once("breadcrumb.php"); ?>

            <?php
            include 'dbConnection.php';
            $id = $_GET['id'];
            $sql = "SELECT * FROM dondatmon join menu on menu.MaMenu = dondatmon.MaMenu join monan on monan.MaMon = menu.MaMon WHERE MaDon = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $imagePath = $row['HinhMinhHoa'];

            $srcPosition = strpos($imagePath, 'src');
            if ($srcPosition !== false) {
                $imagePath = substr($imagePath, $srcPosition);
            }

            $url = 'http://localhost/webfood/' . $imagePath;
            $url = str_replace('\\', '/', $url); // Replace backslashes with forward slashes
            ?>
            <div class="relative flex flex-col text-gray-700 w-[700px] mt-[70px] mx-auto items-center bg-white shadow-md w-96 rounded-xl bg-clip-border">

                <div class="relative h-80 mx-4 -mt-6 overflow-hidden text-white shadow-lg rounded-xl bg-blue-gray-500 bg-clip-border shadow-blue-gray-500/40">
                    <img src="<?php echo $url ?>" class="object-cover w-full h-full" alt="img-blur-shadow" layout="fill" />
                </div>
                <div class="p-6">
                    <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        <?php echo $row['TenMon'] ?>

                    </h5>
                    <p class="block font-sans text-base antialiased font-light leading-relaxed text-inherit">
                        <?php echo $row['CongThuc'] ?>
                    </p>
                </div>
                <div class="p-6 pt-0 flex  gap-20">
                    <p class="select-none rounded-lg bg-yellow-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/20 transition-all " type="p" data-ripple-light="true">
                        Đơn giá :
                        <?php echo $row['gia'] ?>
                    </p>
                    <p class="select-none rounded-lg bg-yellow-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/20 transition-all " type="p" data-ripple-light="true">
                        Số lượng:
                        <?php echo $row['soluong'] ?>
                    </p>
                    <p class="select-none rounded-lg bg-yellow-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/20 transition-all " type="p" data-ripple-light="true">
                        Ngày Đặt:
                        <?php echo $row['NgayDat'] ?>
                    </p>
                </div>
            </div>
        </section>
    </div>

</body>
<script src="./Sidebar/js/script.js"></script>

</html>