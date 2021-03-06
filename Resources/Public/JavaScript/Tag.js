// location.reload();
const url = document.location.href + '?type=1649152563&tx_piwikconsentmanager_pi1[action]=privacyContentElements';

const headers = {
    'Access-Control-Origin': '*',
    'Accept': 'application/json, text/plain, text/html, */*',
    "X-Requested-With": "XMLHttpRequest"
}

fetch(url, {
    method: 'get',
    credentials: 'same-origin',
    headers: headers
}).then(response => {
    response.json().then((data) => {
        console.log(data);
    });
}).catch(err => {
    console.warn('Something went wrong.', err);
});