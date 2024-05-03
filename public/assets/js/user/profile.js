async function getUser() {
    const response = await $.ajax({
        url: '/getUser',
        method: 'GET',
        dataType: 'json'
    });
    if (response.status === 'success') {
        document.getElementById('nickname').innerHTML = response.user.nickname;
        document.getElementById('name').innerHTML = response.user.name;
        document.getElementById('lastname').innerHTML = response.user.lastname;
        document.getElementById('avatar').src = '/storage/' + response.user.avatar;
    }
}

$(document).ready(function () {
    getUser();
});