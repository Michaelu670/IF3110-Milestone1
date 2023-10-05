

const linkPage = () => {
    const activePage = document.querySelectorAll('.active').length > 0 ? Number(document.querySelectorAll('.active')[0].textContent) : 1;
    const page = document.querySelectorAll('.page');

    page.forEach((element) => {
        var targetPage = element.textContent;
        console.log(targetPage);
        if (targetPage === '>') {
            targetPage = activePage + 1;
        }
        if (targetPage === '<') {
            targetPage = activePage - 1;
        }

        console.log(element.textContent);
        element.addEventListener('click', () =>
        debounce(getSearchResult(element.textContent), DEBOUNCE_TIMEOUT));
    });
}