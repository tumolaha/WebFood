<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wed food</title>
</head>
<body>
    <section class="header w-screen ">
        <nav class="bg-gray-800 ">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 overflow-x-hidden">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h5 class="text-sm text-white font-medium">Dao Meo</h5>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <!-- <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Team</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Projects</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Calendar</a>
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reports</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <?php
                            session_start();
                            $user = $_SESSION['user'];
                            if($user){
                                echo "<h5 class='text-sm text-white font-medium'>$user</h5>";
                            }
                            else{
                                echo  '<button class="cursor-pointer group relative flex gap-1.5 px-8 py-2 bg-blue-300 bg-opacity-50 text-[#f1f1f1] rounded-3xl hover:bg-opacity-70 transition font-semibold shadow-md"> login </button>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>
</body>
</html>