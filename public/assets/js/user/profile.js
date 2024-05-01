async function getUser() {
    const response = await $.ajax({
        url: '/getUser',
        method: 'GET',
        dataType: 'json'
    });
    document.getElementById('nickname').innerHTML = response.session.nickname;
    document.getElementById('name').innerHTML = response.session.name;
    document.getElementById('lastname').innerHTML = response.session.lastname;
    document.getElementById('userAvatar').innerHTML = response.session.img;
}
$(document).ready(function () {
    getUser();
});