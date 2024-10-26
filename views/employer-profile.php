<?php  
  require_once('user_guard.php');
  require_once('classes/User.php');
  $user= new User;
  $id = $_SESSION['user_details']['user_id'];
  if($_SESSION['user_details']['user_type'] !=='employer'){
    header("location:".url('home'));
    exit;
  }
  $user_details=$user->getUserDetails($id);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Profile</title>
    <link rel="stylesheet" href="<?php print asset('css/loader.css') ?>">
    <link rel="stylesheet" href="<?php print asset('css/hamburger.css') ?>">
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }
    </style>

</head>

<body class="bg-gray-100 h-screen overflow-y-auto">

 <!-- Loader -->
 <?php include_once "partials/loader.php" ?>

    <div class="flex w-full h-full">

        <!-- Vertical Sidebar -->
        <?php require_once "partials/employer_sidebar.php"; ?>

        <!-- Main Content -->
        <div class="flex flex-col p-6 main-content w-full"> 
        <header class="flex justify-between items-center mb-8 bg-white p-4 shadow-md">
            <div class="flex items-center text-gray-700 gap-x-3">
            <button id="toggleSidebar" class="text-gray-700 focus:outline-none" aria-label="Open sidebar">
                                <i class="fas fa-bars text-2xl"></i>
                            </button>
                <h1 class="text-xl font-bold text-gray-800">Profile</h1>
            </div>
            <button id="editProfileBtn" class="bg-indigo-500 text-white p-2 rounded-md hover:bg-indigo-600">
                <i class="fas fa-edit mr-2"></i> Edit Profile
            </button>
        </header>


            <div class="bg-white p-6 rounded-lg shadow-lg">
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

                <h2 class="text-xl font-semibold mb-4">Employer Information</h2>
                <div class="space-y-2">
                    <p><strong>Name:</strong> <?php print $user_details['name'] ?></p>
                    <p><strong>Email:</strong> <?php print $user_details['email'] ?></p>
                    <p><strong>Phone:</strong> <?php print $user_details['phone'] ?></p>
                    <p><strong>Address:</strong> <?php print $user_details['address'] ?></p>
                    <p><strong>Country:</strong> <?php print $user_details['country'] ?></p>
                    <p><strong>Company Name:</strong> <?php print $user_details['company_name'] ?></p>
                    <p><strong>Industry:</strong> <?php print $user_details['industry'] ?></p>
                    <p><strong>Company Size:</strong> <?php print $user_details['employees'] ?> Employees</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="modal h-screen fixed z-40 overflow-auto w-full inset-0">
        <div class="modal-content">
            <span id="closeModal" class="text-gray-500 float-right cursor-pointer text-2xl">&times;</span>
            <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
            <form action="<?php print url('profile_action') ?>" method="post" class="space-y-2" id="form">
                <label class="block">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="<?php print $user_details['name'] ?>" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </label>
                <label class="block">
                    <strong>Phone:</strong>
                    <input type="tel" name="phone" value="<?php print $user_details['phone'] ?>" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </label>
                <label class="block">
                    <strong>Address:</strong>
                    <input type="text" name="address" value="<?php print $user_details['address'] ?>" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </label>
            <div class="mt-4">
                <button  name="job_seeker_profile_btn" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Save Changes</button>
                <button id="cancelBtn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
            </div>
            </form>
        </div>
    </div>

    
    <script src="<?php print asset('javascript/hamburger.js') ?>"></script>
    <script src="<?php print asset('javascript/loader.js') ?>"></script>

    <script>
        // Get the modal
        var editModal = document.getElementById("editProfileModal");

        // Get the button that opens the modals
        var editBtn = document.getElementById("editProfileBtn");

        // Get the <span> elements that close the modals
        var closeEditModal = document.getElementById("closeModal");

        // Get the cancel buttons
        var cancelEditBtn = document.getElementById("cancelBtn");

        // When the user clicks the Edit Profile button, open the edit modal
        editBtn.onclick = function () {
            editModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modals
        closeEditModal.onclick = function () {
            editModal.style.display = "none";
        }

        // When the user clicks the cancel button, close the modals
        cancelEditBtn.onclick = function (e) {
            e.preventDefault();
            editModal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modals, close them
        window.onclick = function (event) {
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
        }
    </script>


</body>

</html>
