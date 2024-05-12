const id = window.location.pathname.split('/')[4];
document.getElementById('editUser').action = `/admin/edit/user/${id}`;

