import {fetchData} from '../get/get.js';

$(document).ready(async function () {
    const result = await fetchData('/getUser');
    document.getElementById('nickname').innerHTML = result.nickname;
    document.getElementById('name').innerHTML = result.name;
    document.getElementById('lastname').innerHTML = result.lastname;
    document.getElementById('avatar').src = '/storage/' + result.avatar;
});
