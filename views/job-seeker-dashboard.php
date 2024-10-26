<?php  
  require_once('user_guard.php');
  require_once('classes/User.php');
  $user= new User;
  $id = $_SESSION['user_details']['user_id'];
  $user_details=$user->getUserDetails($id);
  if($_SESSION['user_details']['user_type'] !=='job seeker'){
    header("location:".url('home'));
    exit;
  }
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Dashboard</title>
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

    <!-- Dashboard Layout with Responsive Navbar -->
    <div class="flex w-full h-full">

        <!-- Vertical Sidebar -->
        <?php require_once "partials/jobseeker_sidebar.php"; ?>

        <!-- Main Content Area -->
        <main class="flex-1 p-2 main-content w-full">
            <header class="flex justify-between items-center mb-8 bg-white p-4 shadow-md">
                    <div class="md:hidden">
                        <button id="toggleSidebar" class="text-gray-700 focus:outline-none" aria-label="Open sidebar">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-user-circle text-2xl mr-2"></i> <!-- User Icon -->
                        <span>Welcome, <span class="font-semibold"><?php print $user_details['name'] ?></span></span>
                    </div>
            </header>



            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Saved Jobs Section -->
                <section class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-briefcase mr-2"></i> Saved Jobs
                    </h2>
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-teal-600">UX Designer</h3>
                                    <p class="text-sm text-gray-600">Posted on: 10 Oct 2024</p>
                                </div>
                                <img src="https://via.placeholder.com/50" alt="Company Logo" class="w-12 h-12 rounded-full">
                            </div>
                            <p class="text-gray-700">Location: New York, NY</p>
                            <p class="text-gray-700">Category: Design</p>
                            <div class="mt-3 space-x-2">
                                <span class="text-xs font-semibold text-white bg-indigo-500 px-2 py-1 rounded">Full-time</span>
                                <span class="text-xs font-semibold text-white bg-green-500 px-2 py-1 rounded">On-site</span>
                            </div>
                            <div class="mt-4 space-x-2">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Apply Now</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Remove</button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Applications Section -->
                <section class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-file-alt mr-2"></i> Job Applications
                    </h2>
                    <ul class="space-y-4">
                        <li class="bg-gray-50 p-4 rounded-lg shadow-md flex justify-between items-center md:flex-row flex-col">
                            <div class="flex-1 mb-2 md:mb-0">
                                <h3 class="text-lg font-semibold text-gray-800 truncate">Frontend Developer</h3>
                                <p class="text-sm text-gray-600">Applied on: 12 Oct 2024</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Status</button>
                                <button class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Withdraw</button>
                            </div>
                        </li>
                    </ul>
                </section>

            </div>
        </main>
    </div>
    <script src="<?php print asset('javascript/hamburger.js') ?>"></script>

</body>
</html>
