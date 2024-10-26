const menuButton = document.getElementById('menu-button');
        const userMenu = document.getElementById('user-menu');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileNav = document.getElementById('mobile-nav');
    
        // Toggle User Menu
        menuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });
    
        // Toggle Mobile Navigation
        mobileMenuToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });

