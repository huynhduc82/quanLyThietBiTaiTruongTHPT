let isWindows = navigator.platform.indexOf('Win') > -1;

if (isWindows) {
    // if we are on windows OS we activate the perfectScrollbar function
    if (document.getElementsByClassName('main-content')[0]) {
        let mainpanel = document.querySelector('.main-content');
        new PerfectScrollbar(mainpanel);
    }

    if (document.getElementsByClassName('sidenav')[0]) {
        let sidebar = document.querySelector('.sidenav');
        new PerfectScrollbar(sidebar);
    }

    if (document.getElementsByClassName('navbar-collapse')[0]) {
        let fixedplugin = document.querySelector('.navbar:not(.navbar-expand-lg) .navbar-collapse');
        new PerfectScrollbar(fixedplugin);
    }
}

navbarBlurOnScroll('navbarBlur');

function navbarBlurOnScroll(id) {
    const navbar = document.getElementById(id);
    let navbarScrollActive = navbar ? navbar.getAttribute("navbar-scroll") : false;
    let scrollDistance = 5;
    let classes = ['position-sticky', 'blur', 'shadow-blur', 'mt-4', 'left-auto', 'top-1', 'z-index-sticky'];
    let toggleClasses = ['shadow-none'];

    if (navbarScrollActive === 'true') {
        window.onscroll = debounce(function() {
            if (window.scrollY > scrollDistance) {
                blurNavbar();
            } else {
                transparentNavbar();
            }
        }, 10);
    } else {
        window.onscroll = debounce(function() {
            transparentNavbar();
        }, 10);
    }

    function blurNavbar() {
        navbar.classList.add(...classes)
        navbar.classList.remove(...toggleClasses)

        toggleNavLinksColor('blur');
    }

    function transparentNavbar() {
        if (navbar) {
            navbar.classList.remove(...classes)
            navbar.classList.add(...toggleClasses)

            toggleNavLinksColor('transparent');
        }
    }

    function toggleNavLinksColor(type) {
        let navLinks = document.querySelectorAll('.navbar-main .nav-link')
        let navLinksToggler = document.querySelectorAll('.navbar-main .sidenav-toggler-line')

        if (type === "blur") {
            navLinks.forEach(element => {
                element.classList.remove('text-body')
            });

            navLinksToggler.forEach(element => {
                element.classList.add('bg-dark')
            });
        } else if (type === "transparent") {
            navLinks.forEach(element => {
                element.classList.add('text-body')
            });

            navLinksToggler.forEach(element => {
                element.classList.remove('bg-dark')
            });
        }
    }
}

