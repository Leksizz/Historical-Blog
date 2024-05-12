import {fetchData} from '../get/get.js';

$(document).ready(async function () {
    const users = await fetchData('/admin/getUsers');
    const tableBody = $('.table tbody');

    tableBody.empty();
    users.forEach(user => {
        const row = $('<tr>');

        row.append(`<td>${user.id}</td>`);
        row.append(`<td>${user.name}</td>`);
        row.append(`<td>${user.lastname}</td>`);
        row.append(`<td>${user.email}</td>`);
        row.append(`<td>${user.nickname}</td>`);
        row.append(`<td>
                        <div class="buttons-container">
        <a href="/admin/users/edit/${user.id}" type="button" class="btn btn-sm btn-secondary">Редактировать</a>
        <form action="/admin/users/delete/${user.id}" method="post">
            <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
        </form>
    </div>
                    </td>`);

        tableBody.append(row);
    });
});
