export const refreshXHR = (URL, element_id, method = "GET") => {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4) {
            document.getElementById(element_id).innerHTML = xhr.responseText;
        }
    };
    xhr.open(method, URL, true);
    xhr.send();
};