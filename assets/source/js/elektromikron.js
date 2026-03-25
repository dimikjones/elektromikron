document.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('em-dsimisable-content-holder');
    const closeButton = document.querySelector('.em-dismiss-content-close');

    if (!banner) return;

    // 1. If the flag DOES NOT exist, show the banner
    if (sessionStorage.getItem('em_banner_dismissed') !== 'true') {
        banner.style.display = 'block'; // Or 'flex' depending on your layout
    }

    // 2. Handle the click to close
    if (closeButton) {
        closeButton.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Hide the banner
            banner.style.display = 'none';
            
            // Set the session flag
            sessionStorage.setItem('em_banner_dismissed', 'true');
        });
    }
});