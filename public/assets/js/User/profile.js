
// const data = {
//   'name': document.getElementById('name'),
// }
//
//     const name = document.getElementById('name');
//     const lastname = document.getElementById('lastname');
//     const login = document.getElementById('login');
//     const email = document.getElementById('email');
//     const userAvatar = document.getElementById('avatar');
//     const userId = document.getElementById('id');
//     const errorChange = document.getElementById('errorChange');
//     const errorDelete = document.getElementById('errorDelete');
//     const errorNoUploadFile = document.getElementById('errorNoUploadFile');
//
//     function changeAvatar(form) {
//     errorChange.hidden = true;
//     errorNoUploadFile.hidden = true;
//     if (!form.elements.avatar.files[0]) {
//     errorNoUploadFile.hidden = false;
// }
//     const formData = new FormData(form);
//     fetch('/changeAvatar', {
//     method: "POST",
//     body: formData
// }).then(response => response.json())
//     .then(result => {
//     if (result.result === 'success') {
//     location.reload();
// } else if (result.result === 'errorChange') {
//     errorChange.hidden = false;
// }
//
// })
// }
//
//     function deleteAvatar(form) {
//     errorDelete.hidden = true;
//     const formData = new FormData(form);
//     fetch('/deleteAvatar', {
//     method: "POST",
//     body: formData
// }).then(response => response.json())
//     .then(result => {
//     if (result.result === 'success') {
//     location.reload();
// } else {
//     errorDelete.hidden = false;
// }
// })
// }
//
    fetch('/profile')
    .then(response => response.json())
    .then(result => {
    if (result.id) {
    name.innerText = result.name;
    lastname.innerText = result.lastname;
    login.innerText = result.login;
    email.innerText = result.email;
    userId.innerText = result.id;
    userAvatar.src = result.img;
} else {
    location.href = '/login';
}
})
//
//     let pageTitle = "Профиль";
//     document.getElementById('pageTitle').innerText = pageTitle;
