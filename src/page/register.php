<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // Validate form data
    $errors = array();
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($phone)) {
        $errors[] = "Phone is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // Check if username or email already exists
    $sql = "SELECT * FROM TaiKhoan WHERE User='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $errors[] = "Username or email already exists";
    }

    // Hash password

    // Insert user data into database
    if (empty($errors)) {
        $sql = "INSERT INTO TaiKhoan (User, Password,PhanQuyen) VALUES ('$username','$password',1)";
        if ($conn->query($sql) === TRUE) {
            echo "User registered successfully";
            header("location:../page/login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="bg-blue-400/20 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-6/12 shadow-xl bg-white rounded-lg  md:mt-0  xl:p-0 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        Register
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Username" required="">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Email" required="">
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Phone</label>
                            <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Phone" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required="">
                        </div>
                        <button type="submit" class="w-full text-white bg-yellow-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Register</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="login.php" class="font-medium text-primary-600 hover:underline ">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>