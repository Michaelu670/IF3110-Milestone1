const searchInput = document.querySelector('#q');
const sortVarInput = document.querySelector('#sort');
const orderInput = document.querySelector('#order');
const minPriceInput = document.querySelector('#minPrice');
const maxPriceInput = document.querySelector('#maxPrice');

var curPage = 1;

const getSearchResult = (page = 1) => {
    let tags = "";
    var tagsCheckbox = document.querySelectorAll("input:checked.tag-checkbox");
    tagsCheckbox.forEach(element => {
        tags += ",";
        tags += element.id;
    });

    let minPrice = document.getElementById('minPrice').value.length === 0 ? '' : document.getElementById('minPrice').value;
    let maxPrice = document.getElementById('maxPrice').value.length === 0 ? '' : document.getElementById('maxPrice').value;

    const params = new URLSearchParams({
        q: document.getElementById('q').value,
        sortVar: document.getElementById('sort').value,
        order: document.getElementById('order').value,
        page: page,
        tags: tags,
        minPrice: minPrice,
        maxPrice: maxPrice
    });

    let del = [];
    params.forEach((value, key) => {
        if (value == '') {
            del.push(key);
        }
    });

    del.forEach((key) => {
        params.delete(key);
    });

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4) {
            document.getElementById('search-result').innerHTML = xhr.responseText;
            linkPage();
            curPage = page;
        }
    };
    fullURL = "/public/search/resultproducts?" + params.toString();
    xhr.open("GET", fullURL, true);
    xhr.send();

}

searchInput && searchInput.addEventListener('keyup', () =>
    debounce(getSearchResult(), DEBOUNCE_TIMEOUT)
);
sortVarInput && sortVarInput.addEventListener('change', () =>
    debounce(getSearchResult(), DEBOUNCE_TIMEOUT)
);
orderInput && orderInput.addEventListener('change', () =>
    debounce(getSearchResult(), DEBOUNCE_TIMEOUT)
);
minPriceInput && minPriceInput.addEventListener('keyup', () =>
    debounce(getSearchResult(), DEBOUNCE_TIMEOUT)
);
maxPriceInput && maxPriceInput.addEventListener('keyup', () =>
    debounce(getSearchResult(), DEBOUNCE_TIMEOUT) 
);
const tags = document.querySelectorAll('.tag-checkbox');

tags.forEach((element) => {
    element.addEventListener('change', () =>
    debounce(getSearchResult(element.textContent), DEBOUNCE_TIMEOUT));
});