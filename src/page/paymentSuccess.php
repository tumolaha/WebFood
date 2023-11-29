<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vnpay Payment</title>
    </head>

    <body>
        <?php include_once("header.php"); ?>

        <div class="flex w-screen bg-blue-100/30">
            <?php include_once("EmployeeSidebar.php"); ?>
            <?php
            // lấy vnp_OrderInfo từ url
            include 'dbConnection.php';
            $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
            $idList = explode("|", $vnp_OrderInfo)[0];
            $query = "UPDATE dondatmon SET trangthai = 1 WHERE MaDon IN ($idList)";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Đặt món thành công')</script>";
            } else {
                echo "<script>alert('Đặt món thất bại')</script>";
            }

            ?>
            <section class="content w-full px-10 py-5">

                <div class="bg-gray-100 h-screen">
                    <div class="bg-white p-6  md:mx-auto">
                        <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
                            <path fill="currentColor"
                                d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                            </path>
                        </svg>
                        <div class="text-center">
                            <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Đã thanh toán xong
                                đơn hàng

                            </h3>
                            <p class="text-gray-600 my-2">Thank you for completing your secure online payment.</p>
                            <p> Have a great day! </p>
                            <div class="py-10 text-center">
                                <a href="#"
                                    class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                                    GO BACK
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </body>

    </html>
</body>

</html>