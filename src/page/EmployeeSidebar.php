<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="sidebar h-[calc(100vh-64px)]">
        <div
            class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 h-full w-[300px] p-4 shadow-xl shadow-blue-gray-900/5">
            <div class="flex flex-col h-screen justify-between">
                <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
                    <a href="/webfood/src/page/home.php">

                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> Home </span>
                            </div>
                            Trang chủ
                        </div>
                    </a>
                    <a href="/webfood/src/page/OrderInformation.php">
                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> Fastfood </span>
                            </div>
                            Xem thông tin đơn đặt món
                        </div>
                    </a>
                    <a href="/webfood/src/page/OrderHistory.php">
                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> History </span>
                            </div>
                            Lịch sử đặt món
                        </div>
                    </a>

                    <a href="/webfood/src/page/DeXuat.php">

                        <div role="button" tabindex="0"
                            class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                            <div class="grid place-items-center mr-4">
                                <span class="material-symbols-outlined"> description </span>
                            </div>
                            Đề xuất món ăn
                        </div>
                    </a>
                    <div role="button" tabindex="0"
                        class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                        <div class="grid place-items-center mr-4">
                            <span class="material-symbols-outlined"> settings </span>
                        </div>
                        Cài đặt
                    </div>

                </nav>
                <div role="button" tabindex="0"
                    class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-yellow-500 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <span class="material-symbols-outlined"> logout </span>
                    </div>
                    Đăng xuất
                </div>
            </div>

        </div>
    </section>
</body>

</html>