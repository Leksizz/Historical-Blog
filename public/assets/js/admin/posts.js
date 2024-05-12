import {fetchData} from '../get/get.js';

$(document).ready(async function () {
    const posts = await fetchData('/admin/getPosts');
    const tableBody = $('.table tbody');

    tableBody.empty();
    posts.forEach(post => {
        const row = $('<tr>');

        row.append(`<td>${post.id}</td>`);
        row.append(`<td>${post.title}</td>`);
        row.append(`<td>${post.category}</td>`);
        row.append(`<td>${post.author}</td>`);
        row.append(`<td>${post.views}</td>`);
        row.append(`<td>
                        <div class="buttons-container">
        <a href="/post/${post.id}" type="button" class="btn btn-sm btn-success">Посмотреть</a>         
        <form action="/admin/posts/delete/${post.id}" method="post">
            <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
        </form>
    </div>
                    </td>`);
        tableBody.append(row);
    });
});
