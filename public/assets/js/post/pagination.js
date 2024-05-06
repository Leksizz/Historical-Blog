import {fetchData} from '../get/get.js';

const page = parseInt(window.location.pathname.split('/')[2], 10);
const category = window.location.pathname.split('/')[1];
const limit = 5;

$(document).ready(async function () {

    const posts = await fetchData('/getPostsByCategory/' + category + '/' + page);

    function renderPost(post) {
        const container = document.getElementById('container');
        const title = document.createElement('a');
        const p = document.createElement('p');

        title.classList.add('h2');
        title.href = "/post/" + post.id;
        title.textContent = post.title;

        const preview = document.createElement('img');
        preview.src = '/storage/' + post.preview;

        const content = document.createElement('p');
        content.innerHTML = post.content;

        const author = document.createElement('strong');
        const hr = document.createElement('hr');

        const iconView = document.createElement('i');
        iconView.classList.add('fa-solid', 'fa-eye');
        const containerViews = document.createElement('div');
        const views = document.createElement('strong');
        views.innerHTML = post.views;
        containerViews.append(iconView, views);

        author.classList.add('author');
        author.textContent = post.author;

        container.append(title, p, preview, content, author, containerViews, hr);
    }

    const pagination = document.getElementById('pagination');

    const countPosts = posts.total;

    const countPage = Math.ceil(countPosts / limit);

    for (let j = 1; j <= countPage; j++) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        if (j === page) {
            li.classList.add('page-item', 'active');
        }

        pagination.appendChild(li);

        const btn = document.createElement('a');
        btn.classList.add('page-link');
        btn.href = '/' + category + '/' + j;
        btn.innerText = j;
        li.appendChild(btn)
    }

    const btnBack = document.createElement('li');
    btnBack.classList.add('page-link');
    const aBack = document.createElement('a');
    btnBack.appendChild(aBack);
    aBack.innerHTML = "Назад";
    aBack.href = '/' + category + '/' + (page - 1);

    const btnStart = document.createElement('li');
    btnStart.classList.add('page-link');
    const aStart = document.createElement('a');
    btnStart.appendChild(aStart);
    const iconStart = document.createElement('i');
    iconStart.classList.add('fa-solid', 'fa-backward-fast');
    aStart.appendChild(iconStart);
    aStart.href = '/' + category + '/' + 1;

    if (page > 1) {
        pagination.insertAdjacentHTML('afterbegin', btnBack.outerHTML);
        pagination.insertAdjacentHTML('afterbegin', btnStart.outerHTML);
    }

    const btnNext = document.createElement('li');
    btnNext.classList.add('page-link');
    const aNext = document.createElement('a');
    btnNext.appendChild(aNext);
    aNext.innerHTML = "Вперёд";
    aNext.href = '/' + category + '/' + (page + 1);

    const btnEnd = document.createElement('li');
    btnEnd.classList.add('page-link');
    const aEnd = document.createElement('a');
    btnEnd.appendChild(aEnd);
    const iconEnd = document.createElement('i');
    iconEnd.classList.add('fa-solid', 'fa-forward-fast');
    aEnd.appendChild(iconEnd);
    aEnd.href = '/' + category + '/' + countPage;

    if (page < countPage) {
        pagination.insertAdjacentHTML('beforeend', btnNext.outerHTML);
        pagination.insertAdjacentHTML('beforeend', btnEnd.outerHTML);
    }

    const responseSize = Object.keys(posts).length - 1;

    for (let i = 0; i < responseSize; i++) {
        renderPost(posts[i]);
    }

});





