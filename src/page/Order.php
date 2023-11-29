<?php
include "dbConnection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM monan WHERE MaMon = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['HinhMinhHoa'];
                            $url = str_replace('C:\\xampp\\htdocs\\WebFood', 'http://localhost/webfood', $imagePath);
                            $url = str_replace('\\', '/', $url); // Replace backslashes with forward slashes
}

if (isset($_POST['submit'])) {
    $date = date('Y-m-d');
    $amount = $_POST['input'];
    $query = "INSERT INTO `dondatmon`( `MaMon`, `SoLuong`, `TongTien`,`NgayDat`,`TrangThai`,`MaNV`) VALUES ( $id, $amount, $amount * $row[DonGia],'$date',0,1)";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo "<script>alert('Đặt món thành công')</script>";
    } else {
        echo "<script>alert('Đặt món thất bại')</script>";
    }
}
?>

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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <?php include_once("header.php"); ?>
    <div class="flex w-screen bg-blue-100/30">
        <?php include_once("EmployeeSidebar.php"); ?>
        <section class="content w-full px-10 py-5">
            <form method="post">
            <div class="my-10 flex">
                    <img class="w-[350px] h-[300px] rounded-lg" src="<?php echo $url; ?>" alt="">
                    <div class="m-auto ">
                        <p class="text-3xl font-bold">
                            <?php echo $row['TenMon']; ?>
                        </p>
                        <div class="flex items-center gap-10 justify-center text-xl">
                            <p>Số lượng</p>
                            <input type="text" value="1" name="input" class="input border-[1px] w-5 h-5 text-center"
                                id="input">
                            <div class="flex flex-col">
                                <button class="btn" onclick="increase(event)">^</button>
                                <button class="btn" onclick="decrease(event)">v</button>
                            </div>
                            <p name="total" id="total">
                                <?php echo $row['DonGia'] ?> $
                            </p>
                        </div>
                    </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" name="submit" class="w-[100px] rounded-2xl h-[40px] mr-32  bg-yellow-500">Đặt
                    món</button>
            </div>
            </form>
        </section>
    </div>
</body>
<script>
    var price = <?php echo $row['DonGia']; ?>;

    function increase(event) {
        event.preventDefault();
        var input = document.getElementById('input');
        input.value = parseInt(input.value) + 1;
        calculateTotal();
    }

    function decrease(event) {
        event.preventDefault();
        var input = document.getElementById('input');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
        calculateTotal();
    }

    function calculateTotal() {
        var quantity = document.getElementById('input').value;
        var total = quantity * price;
        document.getElementById('total').innerText = total + '$';
    }
</script>

</html>