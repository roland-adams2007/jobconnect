<?php
if (isset($_SESSION['user_details']['user_id'])) {
    header('location:'.url('home'));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select User Type</title>
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
    <style>
        /* Custom Styles */
        .button {
            transition: all 0.3s;
        }
        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100">

   <?php include_once('partials/header.php') ?>

    <div class="min-h-screen flex items-center justify-center bg-gray-100 relative">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full sm:w-full relative z-10">
            <h2 class="text-3xl font-bold text-center mb-6 text-indigo-600">Select User Type</h2>
            <div class="flex flex-col space-y-4">
                <!-- Job Seeker Card -->
                <div class="flex flex-col bg-indigo-50 border rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-graduate text-indigo-600 text-2xl"></i>
                        <h3 class="ml-4 text-lg font-semibold">Job Seeker</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Explore job opportunities, upload your resume, and apply for jobs that fit your skills.</p>
                    <a href="<?php print url('job-seeker-register') ?>" class="bg-indigo-600 text-white py-2 rounded-md text-center hover:bg-indigo-700 button">
                        <i class="fas fa-search mr-2"></i> Find Jobs
                    </a>
                </div>

                <!-- Employer Card -->
                <div class="flex flex-col bg-indigo-50 border rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-briefcase text-indigo-600 text-2xl"></i>
                        <h3 class="ml-4 text-lg font-semibold">Employer</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Post job openings, manage applications, and find the best talent for your company.</p>
                    <a href="<?php print url('employer-register') ?>" class="bg-indigo-600 text-white py-2 rounded-md text-center hover:bg-indigo-700 button">
                        <i class="fas fa-plus-circle mr-2"></i> Post a Job
                    </a>
                </div>
            </div>
            <p class="mt-6 text-center text-gray-600">
                <a href="<?php print url('login') ?>" class="text-indigo-600 hover:underline">Already have an account? Login</a>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once('partials/footer.php')?>

    <script src="<?php print asset('javascript/script.js') ?>"></script>

</body>
</html>
