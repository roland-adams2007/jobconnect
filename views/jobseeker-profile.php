<?php  
  require_once('user_guard.php');
  require_once('classes/User.php');
  $user= new User;
  $id = $_SESSION['user_details']['user_id'];
  if($_SESSION['user_details']['user_type'] !=='job seeker'){
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
    <?php include "partials/loader.php" ?>

    <div class="flex w-full h-full">

        <!-- Vertical Sidebar -->
        <?php require_once "partials/jobseeker_sidebar.php"; ?>

        <!-- Main Content -->
        <div class="flex flex-col p-6 main-content w-full">
            <header class="bg-white shadow-md mb-8 p-4 gap-x-2 flex justify-between items-center">
            <div class="md:hidden">
                    <button id="toggleSidebar" class="text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Profile</h1>
                <button id="editProfileBtn" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
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

                <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                <div class="space-y-2">
                    <p><strong>Name:</strong> <?php print $user_details['name'] ?></p>
                    <p><strong>Email:</strong> <?php print $user_details['email'] ?></p>
                    <p><strong>Phone:</strong> <?php print $user_details['phone'] ?></p>
                    <p><strong>Address:</strong> <?php print $user_details['address'] ?></p>
                    <p><strong>Country:</strong> <?php print $user_details['country'] ?></p>
                </div>

                <h2 class="text-xl font-semibold mt-8 mb-4">Skills</h2>
                <div class="flex flex-wrap">
                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full mr-2 mb-2">HTML</span>
                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full mr-2 mb-2">CSS</span>
                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full mr-2 mb-2">JavaScript</span>
                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full mr-2 mb-2">React</span>
                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full mr-2 mb-2">Laravel</span>
                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full mr-2 mb-2">PHP</span>
                </div>

                <h2 class="text-xl font-semibold mt-8 mb-4">Experience</h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h3 class="font-semibold">Frontend Developer</h3>
                        <p class="text-gray-600">Company Name - Lagos, Nigeria</p>
                        <p><strong>Duration:</strong> Jan 2023 - Present</p>
                        <p>Worked on developing user-friendly interfaces and improving site performance.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h3 class="font-semibold">Web Developer Intern</h3>
                        <p class="text-gray-600">Another Company - Lagos, Nigeria</p>
                        <p><strong>Duration:</strong> Jun 2022 - Dec 2022</p>
                        <p>Assisted in building and maintaining websites for clients.</p>
                    </div>
                </div>

                <h2 class="text-xl font-semibold mt-8 mb-4">Education</h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h3 class="font-semibold">Bachelor of Science in Computer Science</h3>
                        <p class="text-gray-600">University of Lagos - Lagos, Nigeria</p>
                        <p><strong>Year:</strong> 2022</p>
                    </div>
                </div>

                <h2 class="text-xl font-semibold mt-8 mb-4">Resume</h2>
                <div class="space-y-2">
                    <p><strong>Uploaded Resume:</strong> <a href="<?php print  $user_details['resume'] ?>" target="_blank" class="text-indigo-600 underline">view_resume.pdf</a></p>
                    <button id="openUploadModal" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                        <i class="fas fa-upload mr-2"></i> Upload New Resume
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="modal h-screen fixed z-40 overflow-auto w-full inset-0">
        <div class="modal-content">
            <span id="closeModal" class="text-gray-500 float-right cursor-pointer text-2xl">&times;</span>
            <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
            <form action="<?php print url('profile_action') ?>" method="post" class="space-y-2" id="profileForm">
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

    <!-- Upload Resume Modal -->
    <div id="uploadModal" class="modal h-screen fixed z-40 overflow-auto w-full inset-0">
        <div class="modal-content">
            <span id="closeUploadModal" class="text-gray-500 float-right cursor-pointer text-2xl">&times;</span>
            <h2 class="text-xl font-semibold mb-4">Upload Resume</h2>
            <form id="resumeForm" action="<?php print url('resume_action') ?>" method="post" enctype="multipart/form-data">
                <label class="block mb-2">
                    <strong>Select Resume (PDF):</strong>
                    <input type="file" name="resume" accept=".pdf" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </label>
                <div class="mt-4">
                    <button type="submit" name="job_seeker_resume_btn" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Upload</button>
                    <button id="cancelUploadBtn" type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    
    <script src="<?php print asset('javascript/hamburger.js') ?>"></script>

    <script>
        // Get the modal
        var editModal = document.getElementById("editProfileModal");
        var uploadModal = document.getElementById("uploadModal");

        // Get the button that opens the modals
        var editBtn = document.getElementById("editProfileBtn");
        var uploadBtn = document.getElementById("openUploadModal");

        // Get the <span> elements that close the modals
        var closeEditModal = document.getElementById("closeModal");
        var closeUploadModal = document.getElementById("closeUploadModal");

        // Get the cancel buttons
        var cancelEditBtn = document.getElementById("cancelBtn");
        var cancelUploadBtn = document.getElementById("cancelUploadBtn");

        // When the user clicks the Edit Profile button, open the edit modal
        editBtn.onclick = function () {
            editModal.style.display = "block";
        }

        // When the user clicks the Upload Resume button, open the upload modal
        uploadBtn.onclick = function () {
            uploadModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modals
        closeEditModal.onclick = function () {
            editModal.style.display = "none";
        }

        closeUploadModal.onclick = function () {
            uploadModal.style.display = "none";
        }

        // When the user clicks the cancel button, close the modals
        cancelEditBtn.onclick = function () {
            editModal.style.display = "none";
        }

        cancelUploadBtn.onclick = function (e) {
            e.preventDefault();
            uploadModal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modals, close them
        window.onclick = function (event) {
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
            if (event.target == uploadModal) {
                uploadModal.style.display = "none";
            }
        }
    </script>

<script>
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            // Show loader on form submission
            document.querySelector('.loader').style.display = 'flex';
        
            // Disable submit button to prevent multiple submissions
            event.target.querySelector('button[type="submit"]').disabled = true;
        });

        // Hide loader after page reload or when the page fully loads
        window.onload = function() {
            document.querySelector('.loader').style.display = 'none';            
        };
    </script>

<script>
        document.getElementById('resumeForm').addEventListener('submit', function(event) {
            // Show loader on form submission
            document.querySelector('.loader').style.display = 'flex';
        
            // Disable submit button to prevent multiple submissions
            event.target.querySelector('button[type="submit"]').disabled = true;
        });

        // Hide loader after page reload or when the page fully loads
        window.onload = function() {
            document.querySelector('.loader').style.display = 'none';            
        };
    </script>

</body>

</html>
