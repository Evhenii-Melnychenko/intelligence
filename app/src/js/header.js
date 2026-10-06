export function initHeaderMenu() {
    const siteHeader = document.querySelector('.site-header');
    const nav = document.querySelector('.primary-navigation');
    const menuToggle = document.querySelector('.mobile-menu-toggle');

    if (siteHeader === null || nav === null || menuToggle === null) {
        return;
    }

    const closeMenu = () => {
        nav.classList.remove('is-open');
        menuToggle.classList.remove('is-active');
        siteHeader.classList.remove('is-menu-open');
        document.body.classList.remove('menu-open');
        menuToggle.setAttribute('aria-expanded', 'false');
    };

    const openMenu = () => {
        nav.classList.add('is-open');
        menuToggle.classList.add('is-active');
        siteHeader.classList.add('is-menu-open');
        document.body.classList.add('menu-open');
        menuToggle.setAttribute('aria-expanded', 'true');
    };

    menuToggle.addEventListener('click', () => {
        if (nav.classList.contains('is-open')) {
            closeMenu();
            return;
        }

        openMenu();
    });

    nav.addEventListener('click', (event) => {
        const target = event.target;

        if (!(target instanceof Element)) {
            return;
        }

        if (target.closest('a') !== null) {
            closeMenu();
        }
    });

    document.addEventListener('click', (event) => {
        if (!nav.classList.contains('is-open')) {
            return;
        }

        const target = event.target;

        if (!(target instanceof Element)) {
            return;
        }

        const clickedToggle = target.closest('.mobile-menu-toggle') !== null;
        const clickedNav = target.closest('.primary-navigation') !== null;

        if (!clickedToggle && !clickedNav) {
            closeMenu();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && nav.classList.contains('is-open')) {
            closeMenu();
        }
    });
}