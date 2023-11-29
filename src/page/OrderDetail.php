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
    <?php include 'header.php'; ?>
    <div class="flex w-screen bg-blue-100/30">

        <?php include 'EmployeeSidebar.php'; ?>
        <section class="content w-full px-10 py-5 flex justify-center items-center">
            <?php
            include 'dbConnection.php';
            $id = $_GET['id'];
            $sql = "SELECT * FROM dondatmon join monan on monan.MaMon = dondatmon.MaMon WHERE MaDon = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div
                class="relative flex flex-col text-gray-700 w-[700px]  items-center bg-white shadow-md w-96 rounded-xl bg-clip-border">
                <div
                    class="relative h-80 mx-4 -mt-6 overflow-hidden text-white shadow-lg rounded-xl bg-blue-gray-500 bg-clip-border shadow-blue-gray-500/40">
                    <img src="<?php echo $row['HinhMinhHoa'] ?>" class="object-cover w-full h-full"
                        alt="img-blur-shadow" layout="fill" />
                </div>
                <div class="p-6">
                    <h5
                        class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        <?php echo $row['TenMon'] ?>

                    </h5>
                    <p class="block font-sans text-base antialiased font-light leading-relaxed text-inherit">
                        <?php echo $row['CongThuc'] ?>
                    </p>
                </div>
                <div class="p-6 pt-0 flex  gap-20">
                    <p class="select-none rounded-lg bg-yellow-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/20 transition-all "
                        type="p" data-ripple-light="true">
                        Đơn giá :
                        <?php echo $row['DonGia'] ?>
                    </p>
                    <p class="select-none rounded-lg bg-yellow-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/20 transition-all "
                        type="p" data-ripple-light="true">
                        Số lượng:
                        <?php echo $row['soluong'] ?>
                    </p>
                    <p class="select-none rounded-lg bg-yellow-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/20 transition-all "
                        type="p" data-ripple-light="true">
                        Ngày Đặt:
                        <?php echo $row['NgayDat'] ?>
                    </p>
                </div>
            </div>
        </section>
    </div>

</body>

</html>