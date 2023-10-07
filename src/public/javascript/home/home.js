const toggleButton = document.querySelector("#toggle");
const navContainer = document.querySelector("#nav-container");
const logOutButton = document.querySelector("#log-out");
let isToggled = false;

toggleButton &&
    toggleButton.addEventListener("click", () => {
        if (!isToggled) {
            isToggled = true;
            toggleButton.className = "toggle-rotate";
            navContainer.className = "nav-container show";
        } else {
            isToggled = false;
            toggleButton.className = "toggle";
            navContainer.className = "nav-container";
        }
    });

logOutButton &&
    logOutButton.addEventListener("click", async (e) => {
        e.preventDefault();
        const xhr = new XMLHttpRequest();

        xhr.open('POST', '/public/user/logout');

        const formData = new FormData();
        formData.append("csrf_token", CSRF_TOKEN);
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                const data = JSON.parse(this.responseText);
                location.replace(data.redirect_url);
            }
        };
    });

const linkHomePage = () => {
    const activePage = document.querySelectorAll('.active').length > 0 ? Number(document.querySelectorAll('.active')[0].textContent) : 1;
    const page = document.querySelectorAll('.page');

    page.forEach((element) => {
        var targetPage = element.textContent;
        if (targetPage === '>') {
            targetPage = activePage + 1;
        }
        if (targetPage === '<') {
            targetPage = activePage - 1;
        }
        if (targetPage === '...') {
            targetPage = activePage;
        }

        element.addEventListener('click', () =>
        getProduct(targetPage));
    });
}

function getProduct($page = 1){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4) {
            document.getElementById('search-result').innerHTML = xhr.responseText;
            linkHomePage();
        }
    };
    fullURL = "/public/search/resultproducts?page=" + $page;
    xhr.open("GET", fullURL, true);
    xhr.send();
}



























