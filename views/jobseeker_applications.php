<?php
  require_once('user_guard.php');
 require_once "classes/Job.php";
 $job = new Job;

 $applicant_id = $_SESSION['user_details']['user_type'] === 'job seeker' ? $_SESSION['user_details']['user_id'] : NULL;

 $applications = $job->fetch_jobseeker_applications($applicant_id);

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
    <title>My Applications</title>
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
    <div class="flex">
        <!-- Sidebar -->
        <?php require_once('partials/jobseeker_sidebar.php')?>

        <!-- Main Content -->
        <main class="flex-1 p-4">
            <header class="flex justify-between items-center mb-8 bg-white p-4 shadow-md">
                <div class="md:hidden">
                    <button id="toggleSidebar" class="text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">My Applications</h1>
            </header>

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

            <div class="max-w-7xl mx-auto">
                <section class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <ul class="space-y-4">
                        <?php 
                         if(count($applications)>0){
                             foreach($applications as $application){
                                ?>
                                <li class="bg-gray-50 p-4 rounded-lg shadow-md flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-800"><?php print $application['title'] ?></h3>
                                        <p class="text-sm text-gray-600">Company: Company Name</p>
                                        <p class="text-sm text-gray-500">Applied on: <?php print date('d-m-Y',strtotime($application['date_applied'])) ?></p>
                                        <p class="text-sm text-gray-600">Status: <?php print $application['application_status'] ?></p>
                                    </div>
                                    <div class="flex space-x-2 mt-2 sm:mt-0 sm:ml-4">
                                        <button class="bg-indigo-500 text-white px-3 py-1 rounded-md hover:bg-indigo-600">View Details</button>
                                        <form action="<?php print url('withdraw_action') ?>" method="post">
                                            <input type="hidden" name="application_id" value="<?php print $application['application_id'] ?>">
                                          <button name="withdraw_btn" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">Withdraw</button>
                                        </form>
                                    </div>
                                </li>
                                <?php
                             }
                         }else{
                            ?>
                            <li class="bg-gray-50 p-4 rounded-lg shadow-md text-center">
                            <p class="text-gray-600">You haven't applied to any jobs yet.</p>
                            </li>
                            <?php
                         }
                        ?>
                    </ul>
                </section>
            </div>
        </main>
    </div>
    
    <script src="<?php print asset('javascript/hamburger.js') ?>"></script>
</body>
</html>
