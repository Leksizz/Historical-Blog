import {fetchData} from '../get/get.js';
$(document).ready(async function () {
    const user = await fetchData('/getUser');
    document.getElementById('nickname').innerHTML = user.nickname;
    document.getElementById('name').innerHTML = user.name;
    document.getElementById('lastname').innerHTML = user.lastname;
    document.getElementById('avatar').src = '/storage/' + user.avatar;
});
