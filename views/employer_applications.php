<?php  
require_once('user_guard.php');
require_once('classes/User.php');
require_once('classes/Job.php');
$user = new User;
$job = new Job;
$id = $_SESSION['user_details']['user_id'];
$user_details = $user->getUserDetails($id);

if ($_SESSION['user_details']['user_type'] !== 'employer') {
    header("location:" . url('home'));
    exit;
}

$applications = $job->fetch_all_application($id);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard</title>
    <link rel="stylesheet" href="<?php print asset('css/hamburger.css') ?>">
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">


</head>
<body class="bg-gray-100 h-screen">
    <div class="flex w-full h-full">
        <!-- Dashboard Header -->
        <?php require_once('partials/employer_sidebar.php')?>
    
        <!-- Main Content -->
        <main class="flex-1 p-2 main-content w-full">
        <header class="flex justify-between items-center mb-8 bg-white p-4 shadow-md">
                <div class="md:hidden">
                    <button id="toggleSidebar"  class="text-gray-700 focus:outline-none" aria-label="Open sidebar">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
                <div class="flex items-center text-gray-700">
                <h1 class="text-2xl font-bold text-gray-800">Applications</h1>
                </div>
            </header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Applications Section -->
                <section class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow">
                    
                    <ul class="space-y-4">
                        <?php if (count($applications) > 0): ?>
                            <?php foreach ($applications as $application): ?>
                            <li class="bg-gray-50 p-4 rounded-lg shadow-md flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                <div class="flex-1 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <h3 class="text-lg font-semibold text-gray-800"><?php print $application['applicant_name'] ?></h3>
                                    <p class="text-sm text-gray-600">Applied for: <?php print $application['job_title'] ?></p>
                                    <p class="text-sm text-gray-500">Applied on: <?php print date('d M Y', strtotime($application['date_applied'])) ?></p>
                                    <p class="text-sm text-gray-600">Email: <?php print $application['applicant_email'] ?></p>
                                </div>
                                <div class="space-x-2 mt-2 sm:mt-0 sm:ml-4 flex flex-wrap">
                                    <a href="<?php print $application['resume'] ?>" target="_blank" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">View Resume</a>
                                    <button class="bg-indigo-500 text-white px-3 py-1 rounded-md hover:bg-indigo-600">Message</button>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="bg-gray-50 p-4 rounded-lg shadow-md flex justify-between items-center">
                                <div>
                                    <p class="text-gray-600">No recent applications.</p>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>


                </section>
            </div>
        </main>
    </div>
    
    <script src="<?php print asset('javascript/hamburger.js') ?>"></script>
</body>
</html>
