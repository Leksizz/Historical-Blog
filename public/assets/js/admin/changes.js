import {fetchData} from '../get/get.js';

$(document).ready(async function () {
    const changes = await fetchData('/admin/getChanges');
    document.getElementById('userChanges').innerText = changes.user;
    document.getElementById('postChanges').innerText = changes.post;
    document.getElementById('adminChanges').innerText = changes.admin;
});