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
tagCells = document.querySelectorAll('p.tag-cell')
const productID = document.querySelector('#product_id')

function addOption(){
    if(dropbox.value && !tagArea.innerHTML.includes(dropbox.value)){
        tagArea.innerHTML = tagArea.innerHTML + '<p id="'+dropbox.value+'" onclick="this.remove()" class="tag-cell">' +dropbox.value+ '</p>';
        tagCells = document.querySelectorAll('p.tag-cell')

    }
}

mainForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    // console.log(productID.innerHTML)
    const thumbnail = productThumbnail.files[0];
    const productMed = productMedias.files;
    let emptyMedia = false;
    let emptyThumbnail = false
    let nameChange = true
    let tags = [];
    let medias = [];

    for (let i = 0; i < tagCells.length; i++) {
        tags.push(tagCells[i].id);
    }


    if(productName.value==""){
        productName.value = productName.placeholder;
    }
    if(productPrice.value==""){
        productPrice.value = productPrice.placeholder;
    }
    if(productDetail.value==""){
        productDetail.value = productDetail.placeholder;
    }
    if(productStock.value==""){
        productStock.value = productStock.placeholder;
    }
    if(productThumbnail.files.length==0){
        emptyThumbnail = true;
        productThumbnail.files[0] = null;
    }
    if(productMedias.files.length==0){
        emptyMedia = true;
    }else{
        for (let i = 0; i < productMed.length; i++) {
            medias.push(productMed[i]);
        }
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST','/public/product/update');
    const formData = new FormData();
    formData.append('productID', productID.innerHTML);
    formData.append('name', productName.value);
    formData.append('price', productPrice.value);
    formData.append('tagLength', tags.length);
    formData.append('detail', productDetail.value);
    formData.append('stock', productStock.value);
    formData.append('emptyMedias', emptyMedia);
    formData.append('emptyThumbnail', emptyThumbnail);
    formData.append('thumbnail_url', thumbnail);

    let count = 0;
    for(var file in medias) {
        formData.append('media_url'+count, medias[count]);
        count++;
    }
    count = 0;
    for(var tag in tags) {
        formData.append('tag'+count, tags[count]);
        count++;
    }
    
    formData.append('csrf_token', CSRF_TOKEN);
    console.log("SENDING DATA")

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE)
        {
            console.log('Response status:', this.status);
            console.log('Response text:', this.responseText);
            if(this.status === 201)
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

