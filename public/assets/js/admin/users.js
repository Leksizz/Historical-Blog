import {fetchData} from '../get/get.js';

$(document).ready(async function () {
    const users = await fetchData('/admin/getUsers');
    const tableBody = $('.table tbody'); // Получаем тело таблицы

    // Очищаем тело таблицы перед добавлением новых данных
    tableBody.empty();

    // Добавляем строки для каждого пользователя
    users.forEach(user => {
        const row = $('<tr>'); // Создаем новую строку

        // Добавляем ячейки в строку
        row.append(`<td>${user.id}</td>`);
        row.append(`<td>${user.name}</td>`);
        row.append(`<td>${user.email}</td>`);
        row.append(`<td>${user.nickname}</td>`);
        row.append(`<td>
                        <button type="button" class="btn btn-sm btn-primary">Редактировать</button>
                        <button type="button" class="btn btn-sm btn-danger">Удалить</button>
                    </td>`);

        // Добавляем строку в тело таблицы
        tableBody.append(row);
    });
});
