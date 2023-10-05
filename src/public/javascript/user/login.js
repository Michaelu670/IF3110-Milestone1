const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');
const loginForm = document.querySelector('.login-form');
const usernameAlert = document.querySelector('#username-alert');
const passwordAlert = document.querySelector('#password-alert');

const usernameRegex = /^[a-zA-Z0-9]+$/;
const passwordRegex = /^[a-zA-Z0-9!@#$%^&*]+$/;

let usernameValid = false;
let passwordValid = false;

usernameInput && usernameInput.addEventListener('keyup',
    debounce(() => {
        const username = usernameInput.value;

        if(!usernameRegex.test(username)) {
            usernameAlert.innerText = 'Username must be alphanumeric';
            usernameAlert.className = 'alert-show';
            usernameValid = false;
        } else{
            usernameAlert.innerText = '';
            usernameAlert.className = 'alert-hide';
            usernameValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

passwordInput && passwordInput.addEventListener('keyup',
    debounce(() => {
        const password = passwordInput.value;

        if(!passwordRegex.test(password)) {
            passwordAlert.innerText = 'Password must be alphanumeric or special characters';
            passwordAlert.className = 'alert-show';
            passwordValid = false;
        } else{
            passwordAlert.innerText = '';
            passwordAlert.className = 'alert-hide';
            passwordValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

loginForm && loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = usernameInput.value;
    const password = passwordInput.value;

    if(!username)
    {
        usernameAlert.innerText = 'Username is required';
        usernameAlert.className = 'alert-show';
        usernameValid = false;
    }
    else if(!usernameRegex.test(username)) 
    {
        usernameAlert.innerText = 'Username must be alphanumeric';
        usernameAlert.className = 'alert-show';
        usernameValid = false;
    }
    else
    {
        usernameAlert.innerText = '';
        usernameAlert.className = 'alert-hide';
        usernameValid = true;
    }

    if(!password)
    {
        passwordAlert.innerText = 'Password is required';
        passwordAlert.className = 'alert-show';
        passwordValid = false;
    }
    else if(!passwordRegex.test(password))
    {
        passwordAlert.innerText = 'Password must be alphanumeric or special characters';
        passwordAlert.className = 'alert-show';
        passwordValid = false;
    }
    else
    {
        passwordAlert.innerText = '';
        passwordAlert.className = 'alert-hide';
        passwordValid = true;
    }

    if(!usernameValid || !passwordValid) return;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/public/user/login');

    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    formData.append('csrf_token', CSRF_TOKEN);

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE)
        {
            console.log('Response status:', this.status);
            console.log('Response text:', this.responseText);

            if(this.status === 201)
            {
                document.querySelector('#login-alert').className = 'alert-hide';
                const data = JSON.parse(this.responseText);
                location.replace(data.redirect_url);
            }else
            {
                document.querySelector('#login-alert').className = 'alert-show';
            }
        }
    };
});