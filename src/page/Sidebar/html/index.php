<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <nav class="sidebar close border-r-2 border-gray-400">
        <header>
            <div class="image-text">

                <div class=" header-text text">
                    <span class="name">webfood</span>
                    <span class="profession">Web</span>
                </div>
            </div>

            <i class="bx bx-chevron-right toggle"></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">

                    <li class="nav-link">
                        <a href="/webfood/src/page/Home.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Trang chủ </span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/webfood/src/page/OrderInformation.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text"> Xem thông tin đơn đặt món </span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/webfood/src/page/OrderHistory.php">
                            <i class='bx bx-history icon'></i>
                            <span class="text nav-text">Lịch sử đặt món</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/webfood/src/page/DeXuat.php">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Đề xuất món ăn</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Log out</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="moon-sun">
                        <i class="bx bx-moon icon moon"></i>
                        <i class="bx bx-sun icon sun"></i>
                    </div>
                    <span class="mode-text text">Light Mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>


    <script src="/js/script.js"></script>

    <script src="../js/script.js"></script>
</body>

</html>