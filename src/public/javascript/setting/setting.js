const usernameInput = document.querySelector('#username');
// const usernameInput2 = document.getElementById('username');
const passwordInput = document.querySelector('#password');
const fullnameInput = document.querySelector('#fullname');
const passwordConfirmInput = document.querySelector('#password-confirm');
// const profileForm = document.getElementsByClassName('profile-form');
const profileForm = document.querySelector('.profile-form');
// const passwordForm = document.querySelector('#password-form');
const usernameAlert = document.querySelector('#username-alert');
const passwordAlert = document.querySelector('#password-alert');
const fullnameAlert = document.querySelector('#fullname-alert');
const passwordConfirmAlert = document.querySelector('#password-confirm-alert');
const profilePictureInput = document.querySelector('#picture_url');
const usernameRegex = /^[a-zA-Z0-9]+$/;
const passwordRegex = /^[a-zA-Z0-9!@#$%^&*]+$/;
const fullnameRegex = /^[a-zA-Z ]+$/;

let usernameValid = false;
let passwordValid = false;
let fullnameValid = false;
let passwordConfirmValid = false;
let profilePictureValid = false;

function openTab(tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;
    
    // if(tabName=='Profile'){
    //     if(document.getElementById("Profile").style.display != "flex"){
    //         usernameInput.value = "";
    //         fullnameInput.value = "";
    //     }
    // }
    // if(tabName=='Pass'){
    //     if(document.getElementById("Pass").style.display != "flex"){
    //         passwordInput.value = "";
    //         passwordConfirmInput.value = "";
    //     }
    // }

    // Get all elements with class="tabcontent" and hide them
    document.getElementById("Profile").style.display = "none";
    // usernameInput.value = "";
    // fullnameInput.value = "";
    // passwordInput.value = "";
    // passwordConfirmInput.value = "";


    document.getElementById("Pass").style.display = "none";

    document.getElementById(tabName).style.display = "flex";
}

document.getElementById("defaultOpen").click();

usernameInput && usernameInput.addEventListener('keyup',
    debounce(() => {
        const username = usernameInput.value;

        const xhr = new XMLHttpRequest();
        xhr.open(
            'GET',
            `/public/user/username?username=${username}&csrf_token=${CSRF_TOKEN}`
        );
        
        xhr.send();
        xhr.onreadystatechange = function () {
            if(this.readyState === XMLHttpRequest.DONE)
            {
                if(this.status === 200)
                {
                    usernameAlert.innerText = 'Username is already taken';
                    usernameAlert.className = 'alert-show';
                    usernameValid = false;
                }else if(!usernameRegex.test(username))
                {
                    usernameAlert.innerText = 'Username must be alphanumeric';
                    usernameAlert.className = 'alert-show';
                    usernameValid = false;
                }else
                {
                    usernameAlert.innerText = '';
                    usernameAlert.className = 'alert-hide';
                    usernameValid = true;
                }
            }
        }
    }, DEBOUNCE_TIMEOUT)
);

fullnameInput && fullnameInput.addEventListener('keyup',
    debounce(() => {
        const fullname = fullnameInput.value;

        if(!fullnameRegex.test(fullname)) {
            fullnameAlert.innerText = 'Fullname must be alphabets';
            fullnameAlert.className = 'alert-show';
            fullnameValid = false;
        } else{
            fullnameAlert.innerText = '';
            fullnameAlert.className = 'alert-hide';
            fullnameValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

passwordInput && passwordInput.addEventListener('keyup',
    debounce(() => {
        const password = passwordInput.value;
        const passwordConfirm = passwordConfirmInput.value;

        if(!passwordRegex.test(password))
        {
            passwordAlert.innerText = 'Password must be alphanumeric or special characters';
            passwordAlert.className = 'alert-show';
            passwordValid = false;
        } else
        {
            passwordAlert.innerText = '';
            passwordAlert.className = 'alert-hide';
            passwordValid = true;
        } 

        if(password != passwordConfirm)
        {
            passwordConfirmAlert.innerText = 'Password does not match';
            passwordConfirmAlert.className = 'alert-show';
            passwordConfirmValid = false;
        }else
        {
            passwordConfirmAlert.innerText = '';
            passwordConfirmAlert.className = 'alert-hide';
            passwordConfirmValid = true;
        }
    }, DEBOUNCE_TIMEOUT)
);

passwordConfirmInput && passwordConfirmInput.addEventListener('keyup',
    debounce(() => {
        const password = passwordInput.value;
        const passwordConfirm = passwordConfirmInput.value;

        if(password != passwordConfirm)
        {
            passwordConfirmAlert.innerText = 'Password does not match';
            passwordConfirmAlert.className = 'alert-show';
            passwordConfirmValid = false;
        }else
        {
            passwordConfirmAlert.innerText = '';
            passwordConfirmAlert.className = 'alert-hide';
            passwordConfirmValid = true;
        }
    }, DEBOUNCE_TIMEOUT)
);

// function pls() {
//     const username = usernameInput.value;
//     const fullname = fullnameInput.value;
//     const profilePicture = profilePictureInput.files[0];

//     if(!usernameValid)
//     {
//         e.preventDefault();
//         usernameAlert.innerText = 'Username is required';
//         usernameAlert.className = 'alert-show';
//     }else if(!usernameValid)
//     {
//         usernameAlert.className = 'alert-show';
//     }else
//     {
//         usernameAlert.className = 'alert-hide';
//     }

//     if(!fullnameValid)
//     {
//         e.preventDefault();
//         fullnameAlert.innerText = 'Fullname is required';
//         fullnameAlert.className = 'alert-show';
//     }else
//     {
//         fullnameAlert.className = 'alert-hide';
//     }

//     if(!profilePicture.length === 0)
//     {
//         e.preventDefault();
//         document.querySelector("#profile-picture-alert").className = "alert-show";
//         profilePictureValid = false;
//     }else
//     {
//         document.querySelector("#profile-picture-alert").className= "alert-hide";
//         profilePictureValid = true;
//     }

//     if (!usernameValid || !fullnameValid || !profilePictureValid)
//     {
//         return;
//     }


//     const xhr = new XMLHttpRequest();
//     xhr.open(
//         'POST',
//         `/public/user/setting`
//     );


//     const formData = new FormData();
//     formData.append('username', username);
//     formData.append('fullname', fullname);
//     formData.append('picture_url', profilePicture);
//     formData.append('csrf_token', CSRF_TOKEN);
    
    
//     xhr.send(formData);
//     xhr.onreadystatechange = function () {
//         if(this.readyState === XMLHttpRequest.DONE)
//         {
//             if(this.status === 201)
//             {
                
//                 const data = JSON.parse(this.responseText);
//                 location.replace(data.redirect_url);
//             }else
//             {
//                 alert('Something went wrong, please try again!');
//             }
//         }
//     };
// }

profileForm && profileForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = usernameInput.value;
    const fullname = fullnameInput.value;
    const profilePicture = profilePictureInput.files[0];

    if(!usernameValid)
    {
        e.preventDefault();
        usernameAlert.innerText = 'Username is required';
        usernameAlert.className = 'alert-show';
    }else if(!usernameValid)
    {
        usernameAlert.className = 'alert-show';
    }else
    {
        usernameAlert.className = 'alert-hide';
    }

    if(!fullnameValid)
    {
        e.preventDefault();
        fullnameAlert.innerText = 'Fullname is required';
        fullnameAlert.className = 'alert-show';
    }else
    {
        fullnameAlert.className = 'alert-hide';
    }

    if(profilePicture.length == 0)
    {
        e.preventDefault();
        document.querySelector("#profile-picture-alert").className = "alert-show";
        profilePictureValid = false;
    }else
    {
        document.querySelector("#profile-picture-alert").className= "alert-hide";
        profilePictureValid = true;
    }

    if (!usernameValid || !fullnameValid || !profilePictureValid)
    {
        return;
    }


    const xhr = new XMLHttpRequest();
    xhr.open(
        'POST',
        `/public/user/setting`
    );


    const formData = new FormData();
    formData.append('username', username);
    formData.append('fullname', fullname);
    formData.append('picture_url', profilePicture);
    formData.append('csrf_token', CSRF_TOKEN);
    
    
    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE)
        {
            console.log('Response status:', this.status);
            console.log('Response text:', this.responseText);
            if(this.status === 201)
            {
                
                const data = JSON.parse(this.responseText);
                location.replace(data.redirect_url);
            }else
            {
                alert('Something went wrong, please try again!');
            }
        }
    };
});