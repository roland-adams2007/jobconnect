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

// Fetching job postings and recent applications
$job_postings = $job->getJobPostingsByEmployer($id);
$applications = $job->getRecentApplicationsByEmployer($id);
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
        <?php require_once('partials/employer_sidebar.php') ?>
    
        <!-- Main Content -->
        <main class="flex-1 p-2 main-content w-full">
            <header class="flex justify-between items-center mb-8 bg-white p-4 shadow-md">
                <div class="md:hidden">
                    <button id="toggleSidebar" class="text-gray-700 focus:outline-none" aria-label="Open sidebar">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-user-circle text-2xl mr-2"></i> <!-- User Icon -->
                    <span>Welcome, <span class="font-semibold"><?php print $user_details['name'] ?></span></span>
                </div>
            </header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Job Postings Section -->
                <section class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-briefcase mr-2"></i> Your Job Postings
                    </h2>

                    <!-- Job Grid (multiple jobs) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php if (!empty($job_postings)): ?>
                            <?php foreach ($job_postings as $job_post): ?>
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-bold text-indigo-600"><?php print $job_post['title'] ?></h3>
                                        <p class="text-sm text-gray-600">Posted on: <?php print date('d M Y', strtotime($job_post['date_added'])) ?></p>
                                    </div>
                                </div>
                                <p class="text-gray-700">Location: <?php print $job_post['location'] ?></p>
                                <p class="text-gray-700">Category: <?php print $job_post['category'] ?></p>
                                <div class="mt-3 space-x-2">
                                    <span class="text-xs font-semibold text-white bg-indigo-500 px-2 py-1 rounded"><?php print ucwords($job_post['job_type']) ?></span>
                                    <span class="text-xs font-semibold text-white bg-green-500 px-2 py-1 rounded">Remote</span>
                                </div>
                                <div class="mt-4 space-x-2">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View</button>
                                    <button class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                                <p class="text-gray-600">You have not posted any jobs yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Applications Section -->
                <section class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-file-alt mr-2"></i> Recent Applications
                    </h2>
                    <ul class="space-y-4">
                        <?php if (count($applications) > 0): ?>
                            <?php foreach ($applications as $application): ?>
                            <li class="bg-gray-50 p-4 rounded-lg shadow-md flex flex-col sm:flex-row justify-between items-center">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800"><?php print $application['applicant_name'] ?></h3>
                                    <p class="text-sm text-gray-600">Applied for: <?php print $application['job_title'] ?></p>
                                </div>
                                <div class="space-x-2 mt-3 sm:mt-0">
                                    <a href="<?php print asset($application['resume']) ?>" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">View Resume</a>
                                    <button class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Message</button>
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
