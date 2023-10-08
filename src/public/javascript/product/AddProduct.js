const dropbox = document.querySelector('#dropbox')
const tagArea = document.querySelector('#tag-area')
const productName = document.querySelector('#name')
const productPrice = document.querySelector('#price')
const productTags = document.querySelector('#tag-area')
const productDetail = document.querySelector('#desc')
const productStock = document.querySelector('#stock')
const productMedias = document.querySelector('#media_url')
const productThumbnail = document.querySelector('#thumbnail_url')
const mainForm = document.getElementById('contents')
const tagCells = document.querySelectorAll('#tag-cell')
const productID = document.querySelector('#product_id')

const nameAlert = document.getElementById('name-alert')
const priceAlert = document.getElementById('price-alert')
const thumbnailAlert = document.getElementById('thumbnail-alert')

let nameValid = false
let priceValid = false

function addOption(){
    if(dropbox.value && !tagArea.innerHTML.includes(dropbox.value)){
        tagArea.innerHTML = tagArea.innerHTML + '<p id="'+dropbox.value+'" onclick="this.remove()" class="tag-cell">' +dropbox.value+ '</p>';
    }
}

productName && productName.addEventListener('keyup',
    debounce(() => {
        nameAlert.innerText = '';
        nameAlert.className = 'alert-hide';
        nameValid = true;
    }, DEBOUNCE_TIMEOUT)
);

productPrice && productPrice.addEventListener('keyup',
    debounce(() => {
        priceAlert.innerText = '';
        priceAlert.className = 'alert-hide';
        priceValid = true;
    }, DEBOUNCE_TIMEOUT)
);

mainForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const thumbnail = productThumbnail.files[0];
    // console.log(productID.innerHTML)
    let emptyMedia=false
    let tags = [];
    tagCells.forEach((tag)=>{
        tags.push(tag.id);
    })

    if(productName.value==""){
        e.preventDefault();
        nameAlert.innerText = 'Product name is required';
        nameAlert.className = 'alert-show';
    }
    if(productPrice.value==""){
        e.preventDefault();
        priceAlert.innerText = 'Price is required';
        priceAlert.className = 'alert-show';
    }
    if(productDetail.value==""){
        productDetail.value = "No description";
    }
    if(productStock.value==""){
        productStock.value = productStock.placeholder;
    }
    if(productThumbnail.files[0].length == 0)
    {
        e.preventDefault();
        document.querySelector("#thumbnail-alert").className = "alert-show";
        profilePictureValid = false;
    }else
    {
        document.querySelector("#thumbnail-alert").className= "alert-hide";
        profilePictureValid = true;
    }
    if(productMedias.files.length==0){
        emptyMedia = true;
    }

    productMedias.files = productThumbnail.files;
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST','/public/product/add');
    const formData = new FormData();
    formData.append('name', productName.value);
    formData.append('price', productPrice.value);
    formData.append('tags', tags);
    formData.append('detail', productDetail.value);
    formData.append('stock', productStock.value);
    formData.append('emptyMedias', emptyMedia);
    formData.append('medias', productMedias.files);
    formData.append('thumbnail_url', thumbnail);
    formData.append('csrf_token', CSRF_TOKEN);
    console.log("SENDING DATA")

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE)
        {
            console.log('Response status:', this.status);
            console.log('Response text:', this.responseText);
            if(this.status === 200)
            {
                // document.querySelector('#register-alert').className = 'alert-hide';
                const data = JSON.parse(this.responseText);
                location.replace(data.redirect_url);
            }else
            {
                // document.querySelector('#register-alert').className = 'alert-show';
            }
        }
    };
});