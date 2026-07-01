// Activating Lateral Menu
const showMenu = (toggleId, navId) => {
  const toggle = document.getElementById(toggleId);
  const nav = document.getElementById(navId);
  const backdrop = document.getElementById('menu-backdrop');

  if (toggle && nav && backdrop) {
    toggle.addEventListener('click', () => {
      const isOpen = nav.classList.toggle('show');

      // Update toggle icon
      toggle.src = isOpen
        ? ''
        : 'assets/images/menu-open.png';

      // Show/hide backdrop
      backdrop.style.display = isOpen ? 'block' : 'none';
    });

    // Close menu when clicking backdrop
    backdrop.addEventListener('click', () => {
      nav.classList.remove('show');
      backdrop.style.display = 'none';
      toggle.src = 'assets/images/menu-open.png';
    });
  }
};

showMenu('header-toggle', 'nav-menu');

document.getElementById('header-toggle-nav').addEventListener('click', function () {
  const nav = document.getElementById('nav-menu');
  const toggleBtn = document.getElementById('header-toggle');
  const backdrop = document.getElementById('menu-backdrop');

  nav.classList.remove('show');
  backdrop.style.display =  'none';
  

  // Optional: if you also toggle image src on another button
  if (toggleBtn) {
    toggleBtn.src = 'assets/images/menu-open.png';
  }
}); 

// Changing Active Link

const navLink = document.querySelectorAll('.nav-link');
const navMenu = document.getElementById('nav-menu');
const headerToggle = document.getElementById('header-toggle'); // or 'header-toggle-nav'
const menuBackdrop = document.getElementById('menu-backdrop');

function linkAction() {
    // Update active class
    navLink.forEach(n => n.classList.remove('active'));
    this.classList.add('active');

    // Close the menu
    navMenu.classList.remove('show');

    // Update toggle icon
    if (headerToggle) {
        headerToggle.src = 'assets/images/menu-open.png';
    }

    // Hide backdrop
    if (menuBackdrop) {
        menuBackdrop.style.display = 'none';
    }
}

navLink.forEach(n => n.addEventListener('click', linkAction));

document.querySelectorAll('.tab-trigger').forEach(trigger => {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      const tabTarget = document.querySelector(this.dataset.bsTarget);
      const tabButton = document.querySelector(`button[data-bs-target='${this.dataset.bsTarget}']`);
      
      if (tabTarget && tabButton) {
        const tab = new bootstrap.Tab(tabButton);
        tab.show();
        tabTarget.scrollIntoView({ behavior: 'smooth' }); // Optional scroll to content
      }
    });
  });