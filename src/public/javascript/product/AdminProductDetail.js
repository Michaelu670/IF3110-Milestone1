const dropbox = document.querySelector('#dropbox')
const tagArea = document.querySelector('#tag-area')


function removeFromOption(id){
    tagArea.innerHTML = tagArea.innerHTML.replace('<p id="'+id+'" onclick="removeFromOption(this.id)" class="tag-cell">'+id+'</p>', '')
}

function addOption(tag){
    if(!tagArea.innerHTML.includes(tag)){
        tagArea.innerHTML = tagArea.innerHTML + '<p id="'+tag+'" onclick="removeFromOption(this.id)" class="tag-cell">' + tag + '</p>';
    }
    
}