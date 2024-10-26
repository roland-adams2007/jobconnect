

<?php  
  require_once('user_guard.php');
  require_once('classes/Job.php');
  $job= new Job;
  $id = $_SESSION['user_details']['user_id'];
  if($_SESSION['user_details']['user_type'] !=='employer'){
    header("location:".url('home'));
    exit;
  }
  $locations = $job->fetch_locations($id);
  $job_functions =$job->fetch_job_functions(); 
  $jobs = $job->fetch_jobs();


?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Job Page</title>
    <link rel="stylesheet" href="<?php print asset('css/hamburger.css') ?>">
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    
    <style>
        /* Tab navigation styling */
        .tab {
            cursor: pointer;
            padding: 12px 24px;
            border: none;
            outline: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .tab-active {
            border-bottom: 2px solid #4f46e5;
            color: #4f46e5;
        }

        .tab-inactive {
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .tab:hover {
            border-bottom: 1px solid  #c3c4f2;
        }

        .tab-content {
            display: none;
        }

        .tab-content-active {
            display: block;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden; /* Ensures corners are rounded */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
        }

        tr:hover {
            background-color: #f3f4f6;
        }

        /* Form styling */
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            margin-top: 8px;
            margin-bottom: 16px;
            transition: border-color 0.3s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #4f46e5;
            outline: none;
        }

        button[type="submit"] {
            background-color: #4f46e5;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #4338ca;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }

            header h1 {
                font-size: 1.5rem;
            }

            .hamburger {
                display: block;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap; /* Prevents table from breaking on smaller screens */
            }
        }
    </style>

</head>

<body class="bg-gray-100 h-screen">

    <div class="flex w-full h-full">
        <!-- Sidebar -->
        <?php require_once "partials/employer_sidebar.php"; ?>

        <!-- Main Content -->
        <div class="flex flex-col p-6 main-content w-full">

            <header class="flex justify-between items-center mb-8 bg-white p-4 shadow-md">
                <div class="md:hidden">
                    <button id="toggleSidebar" class="text-gray-700 focus:outline-none" aria-label="Open sidebar">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
                <div class="flex items-center text-gray-700">
                <h1 class="text-2xl font-bold">Manage Jobs</h1>
                </div>
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

            <!-- Tab Navigation -->
            <div class="my-6">
                <button id="manageJobsTab" class="tab tab-active">Manage Jobs</button>
                <button id="addJobTab" class="tab tab-inactive">Add Job</button>
            </div>

            

            <!-- Manage Jobs Content -->
            <div id="manageJobsContent" class="tab-content tab-content-active">
                <h2 class="text-xl font-semibold mb-4">Your Job Listings</h2>

                <table class="table-auto bg-white rounded-lg shadow-lg">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Posted On</th>
                            <th>Expires On</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                       if(count($jobs)>0){
                        foreach($jobs as $job){
                       ?>
                        <tr>
                            <td><?php print $job['title'] ?></td>
                            <td><?php print $job['location'] ?>, <?php print $job['country'] ?></td>
                            <td><?php print date('d-m-Y',strtotime($job['date_added'])) ?></td>
                            <td><?php print date('d-m-Y',strtotime($job['expiration_date'])) ?></td>
                            <td><?php print $job['status'] ? 'Active' : 'Inactive' ?></td>
                            <td>
                                <a href="#" class="text-blue-500 hover:underline">Edit</a> | 
                                <a href="#" class="text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                       <?php
                        }
                       }else{
                        ?>
                               <tr>
                                    <td colspan="5" class="border px-4 py-8 text-center text-gray-500">
                                        No job listings available. Please add a job to get started.
                                    </td>
                                </tr>

                        <?php
                       }   
                       ?>
                        <!-- Add more job listings as needed -->
                    </tbody>
                </table>
            </div>



            <!-- Add Job Content -->
            <div id="addJobContent" class="tab-content p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6">Post a New Job</h2>
                <form action="<?php print url('employer-job-action')?>" method="post" class="space-y-6">
                    <div class="form-group">
                        <label class="block text-sm font-semibold" for="title">Job Title:</label>
                        <input type="text" id="title" name="title" required class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-indigo-500">
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-semibold" for="location">Location:</label>
                        <select id="location" name="location" required class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-indigo-500">
                            <option value="" selected disabled>Select location</option>
                            <?php
                              foreach($locations as $location){
                                ?>
                                <option value="<?php print $location['state'] ?>"><?php print $location['state']?></option>
                                <?php
                              }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-semibold" for="salary">Salary Range:</label>
                        <input type="text" id="salary" name="salary" placeholder="e.g., $40,000 - $60,000" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-indigo-500">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-semibold" for="category">Category:</label>
                        <select id="category" name="category" required class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-indigo-500">
                            <option value="" disabled selected>Select a category</option>
                            <?php 
                             foreach ($job_functions as $function){
                                ?>
                                <option value="<?php print $function['function_name'] ?>"><?php print $function['function_name']?></option>
                                <?php
                             }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-semibold" for="job_type">Job Type:</label>
                        <select id="job_type" name="job_type" required class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-indigo-500">
                            <option value="full time">Full-time</option>
                            <option value="part time">Part-time</option>
                            <option value="contract">Contract</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-semibold" for="description">Job Description:</label>
                        <textarea id="summernote" name="description" rows="5" required class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-indigo-500"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-semibold" for="status">Status:</label>
                        <select id="status" name="status" required class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-indigo-500">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mt-6">
                        <button type="submit" name="employer_job_btn" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-md transition-colors hover:bg-indigo-700">Post Job</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
    <script src="<?php print asset('javascript/hamburger.js') ?>"></script>

    <script>
        // Tab functionality
        const manageJobsTab = document.getElementById('manageJobsTab');
        const addJobTab = document.getElementById('addJobTab');
        const manageJobsContent = document.getElementById('manageJobsContent');
        const addJobContent = document.getElementById('addJobContent');

        manageJobsTab.addEventListener('click', () => {
            manageJobsTab.classList.add('tab-active');
            manageJobsTab.classList.remove('tab-inactive');
            addJobTab.classList.add('tab-inactive');
            addJobTab.classList.remove('tab-active');

            manageJobsContent.classList.add('tab-content-active');
            addJobContent.classList.remove('tab-content-active');
        });

        addJobTab.addEventListener('click', () => {
            addJobTab.classList.add('tab-active');
            addJobTab.classList.remove('tab-inactive');
            manageJobsTab.classList.add('tab-inactive');
            manageJobsTab.classList.remove('tab-active');

            addJobContent.classList.add('tab-content-active');
            manageJobsContent.classList.remove('tab-content-active');
        });
    </script>
    <script>
      $('#summernote').summernote({
        placeholder: 'Enter description',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
        ]
      });
    </script>
</body>

</html>
