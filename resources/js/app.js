import './bootstrap';

// Sticky header: when scrolled, switch to full-width bar
(function () {
    const header = document.getElementById('main-header');
    if (!header) return;
    const threshold = 24;

    function updateStuck() {
        if (window.scrollY > threshold) {
            header.classList.add('is-stuck');
        } else {
            header.classList.remove('is-stuck');
        }
    }

    window.addEventListener('scroll', updateStuck, { passive: true });
    updateStuck(); // run once in case page is loaded scrolled
})();
