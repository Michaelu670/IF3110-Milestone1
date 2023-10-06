const toggleButton = document.querySelector("#toggle");
const navContainer = document.querySelector("#nav-container");
const logOutButton = document.querySelector("#log-out");
const settingButton = document.querySelector("#profilePictureNavbar");
let isToggled = false;

toggleButton &&
    toggleButton.addEventListener("click", () => {
        if (!isToggled) {
            isToggled = true;
            toggleButton.className = "";
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