<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Support</title>
    <link rel="stylesheet" href="<?php print asset('css/loader.css')  ?>">
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png')?>">
</head>
<body class="bg-gray-100">

<!-- Loader -->
<?php include('partials/loader.php') ?>

    <?php include_once('partials/header.php') ?>
    <div class="container mx-auto py-12">
        <div class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Contact Support</h2>

            <?php
                if (isset($_SESSION['error'])) {
                    print "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                            <strong class='font-bold'>Error: </strong>
                            <span class='block sm:inline'>" . $_SESSION['error'] . "</span>
                        </div>";
                    unset($_SESSION['error']); // Unset after displaying
                }

                if (isset($_SESSION['feedback'])) {
                    print "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>
                            <strong class='font-bold'>Success: </strong>
                            <span class='block sm:inline'>" . $_SESSION['feedback'] . "</span>
                        </div>";
                    unset($_SESSION['feedback']); // Unset after displaying
                }
                ?>

            <form action="<?php print  url('contact_action') ?>" method="post" id="form">
                <div class="mb-4">
                    <label class="block text-gray-600">Firstame</label>
                    <input type="text" name="fname" placeholder="Enter your name" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600">Lastname</label>
                    <input type="text" name="lname" placeholder="Enter your name" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600">Message</label>
                    <textarea rows="5" name="message"  placeholder="Enter your message" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500" required></textarea>
                </div>
                <button type="submit" name="contact_btn" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once('partials/footer.php')?>

    <script src="<?php print asset('javascript/loader.js') ?>"></script>

    <script src="<?php print asset('javascript/script.js') ?>"></script>


</body>
</html>
