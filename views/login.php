<?php  
if(isset($_SESSION['user_details']['user_id'])){
    header('location:'.url('home'));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php print asset('css/loader.css') ?>">
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
</head>

<body class="bg-gray-100 h-screen overflow-y-auto">

    <!-- Loader -->
    <?php include "partials/loader.php" ?>

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <div class="flex items-center gap-x-2 mb-6 justify-center">
                <img src="assets/images/hand-shake.png" alt="Logo" class="w-10 h-10">
                <h1 class="text-2xl font-bold text-indigo-600">JobConnect</h1>
            </div>

            <?php
            if (isset($_SESSION['error'])) {
                print "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                        <strong class='font-bold'>Error: </strong>
                        <span class='block sm:inline'>" . $_SESSION['error'] . "</span>
                    </div>";
                unset($_SESSION['error']); // Unset after displaying
            }
            ?>

            <!-- Login Form -->
            <form id="form" action="<?php print url('login_action') ?>" method="post">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:text-indigo-600" placeholder="Enter your email" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:text-indigo-600" placeholder="Enter your password" required>
                </div>

                <button type="submit" name="login_btn" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Login</button>
            </form>

            <div class="my-6 flex items-center justify-center">
                <span class="text-gray-400">OR</span>
            </div>

            <!-- Google Sign-In Button -->
            <button class="w-full bg-white text-gray-700 border border-gray-300 py-2 rounded-md shadow-md flex items-center justify-center hover:bg-gray-100 transition">
                <img src="assets/images/g.png" alt="Google Logo" class="w-5 h-5 mr-3">
                Sign in with Google
            </button>

            <p class="mt-6 text-center text-gray-600">Don't have an account? 
                <a href="<?php print url("user_select"); ?>" class="text-indigo-600 hover:underline">Register here</a>
            </p>
        </div>
    </div>

    <script src="<?php print asset('javascript/loader.js') ?>"></script>

</body>

</html>
