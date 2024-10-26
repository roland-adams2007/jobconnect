<aside id="sidebar" class="sidebar-bg md:bg-white shadow-lg flex-col h-screen fixed hidden md:block w-full md:w-64 md:relative">
            <div class="h-full w-64 bg-white">
                <div class="p-6">
                    <div class="w-full flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-2 ">
                            <img src="assets/images/hand-shake.png" alt="Logo" class="w-10">
                            <h1 class="text-lg md:text-2xl font-bold text-indigo-600 nav-text">JobConnect</h1>
                        </div>
                        <button id="closeSidebar" class="text-gray-700 md:hidden" aria-label="Close sidebar">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>
                    <nav class="space-y-4">
                        <a href="<?php echo htmlspecialchars(url('jobseeker-dashboard')); ?>" class="flex items-center py-2 px-4 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 rounded-md">
                            <i class="fas fa-tachometer-alt text-xl"></i>
                            <span class="nav-text ml-3">Dashboard</span>
                        </a>
                        <a href="<?php echo htmlspecialchars(url('jobseeker-applications')); ?>" class="flex items-center py-2 px-4 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 rounded-md">
                            <i class="fas fa-file-alt text-xl"></i>
                            <span class="nav-text ml-3">My Applications</span>
                        </a>
                        <a href="<?php print url('jobseeker-profile') ?>" class="flex items-center py-2 px-4 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 rounded-md">
                            <i class="fas fa-user text-xl"></i>
                            <span class="nav-text ml-3">Profile</span>
                        </a>

                        <a href="<?php print url('home'); ?>" class="flex items-center py-2 px-4 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 rounded-md">
                            <i class="fas fa-home mr-2"></i> 
                            <span class="nav-text ml-3">Return to Home</span>
                        </a>

                        <a href="<?php print htmlspecialchars(url('logout_action')); ?>" class="flex items-center py-2 px-4 text-gray-600 hover:bg-red-100 hover:text-red-600 rounded-md">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                            <span class="nav-text ml-3">Logout</span>
                        </a>
                    </nav>
                </div>
            </div>
        </aside>