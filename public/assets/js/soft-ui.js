





const iconNavbarSidenav = document.getElementById("iconNavbarSidenav"),
    iconSidenav = document.getElementById("iconSidenav"),
    sidenav = document.getElementById("sidenav-main");
let body = document.getElementsByTagName("body")[0],
    className = "g-sidenav-pinned";

function toggleSidenav() {
    body.classList.contains(className) ? (body.classList.remove(className), setTimeout(function() {
        sidenav.classList.remove("bg-white")
    }, 100), sidenav.classList.remove("bg-transparent")) : (body.classList.add(className), sidenav.classList.add("bg-white"), sidenav.classList.remove("bg-transparent"), iconSidenav.classList.remove("d-none"))
}
iconNavbarSidenav && iconNavbarSidenav.addEventListener("click", toggleSidenav), iconSidenav && iconSidenav.addEventListener("click", toggleSidenav);


window.addEventListener('resize', function() {
    total.forEach(function(item) {
        item.querySelector('.moving-tab').remove();
        let moving_div = document.createElement('div');
        let tab = item.querySelector(".nav-link.active").cloneNode();
        tab.innerHTML = "-";

        moving_div.classList.add('moving-tab', 'position-absolute', 'nav-link');
        moving_div.appendChild(tab);

        item.appendChild(moving_div);

        moving_div.style.padding = '0px';
        moving_div.style.transition = '.5s ease';

        let li = item.querySelector(".nav-link.active").parentElement;

        if (li) {
            let nodes = Array.from(li.closest('ul').children); // get array
            let index = nodes.indexOf(li) + 1;

            let sum = 0;
            if (item.classList.contains('flex-column')) {
                for (let j = 1; j <= nodes.indexOf(li); j++) {
                    sum += item.querySelector('li:nth-child(' + j + ')').offsetHeight;
                }
                moving_div.style.transform = 'translate3d(0px,' + sum + 'px, 0px)';
                moving_div.style.width = item.querySelector('li:nth-child(' + index + ')').offsetWidth + 'px';
                moving_div.style.height = item.querySelector('li:nth-child(' + j + ')').offsetHeight;
            } else {
                for (let j = 1; j <= nodes.indexOf(li); j++) {
                    sum += item.querySelector('li:nth-child(' + j + ')').offsetWidth;
                }
                moving_div.style.transform = 'translate3d(' + sum + 'px, 0px, 0px)';
                moving_div.style.width = item.querySelector('li:nth-child(' + index + ')').offsetWidth + 'px';

            }
        }
    });

    if (window.innerWidth < 991) {
        total.forEach(function(item) {
            if (!item.classList.contains('flex-column')) {
                item.classList.add('flex-column', 'on-resize');
            }
        });
    } else {
        total.forEach(function(item) {
            if (item.classList.contains('on-resize')) {
                item.classList.remove('flex-column', 'on-resize');
            }
        })
    }
});

function getUrl(link) {
    link = link.split('/')
    link.length = 4
    return link.join('/')
}

const container = document.getElementById('sidenav-main');
const btns = container.getElementsByClassName("nav-link");

// Loop through the buttons and add the active class to the current/clicked button
for (let i = 0; i < btns.length; i++) {
    if (getUrl(btns[i].href) === getUrl(window.location.href)) {
        btns[i].className += " active";
        document.getElementById('title-first').innerText = btns[i].innerText
        if (btns[i].href === window.location.href) {
         document.getElementById('title-second').innerText = btns[i].innerText
        }
    }
    btns[i].addEventListener("click", function () {
        const current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
}

// when input is focused add focused class for style
function focused(el) {
    if (el.parentElement.classList.contains('input-group')) {
        el.parentElement.classList.add('focused');
    }
}

// when input is focused remove focused class for style
function defocused(el) {
    if (el.parentElement.classList.contains('input-group')) {
        el.parentElement.classList.remove('focused');
    }
}

// helper for adding on all elements multiple attributes
function setAttributes(el, options) {
    Object.keys(options).forEach(function(attr) {
        el.setAttribute(attr, options[attr]);
    })
}

// adding on inputs attributes for calling the focused and defocused functions
if (document.querySelectorAll('.input-group').length !== 0) {
    var allInputs = document.querySelectorAll('input.form-control');
    allInputs.forEach(el => setAttributes(el, {
        "onfocus": "focused(this)",
        "onfocusout": "defocused(this)"
    }));
}
