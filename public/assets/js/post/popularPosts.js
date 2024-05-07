import {fetchData} from '../get/get.js';

$(document).ready(async function () {
    const post = await fetchData('/getPopularPosts');

    document.getElementById('mainPreview').src = '/storage/' + post[0].preview;
    document.getElementById('mainTitle').innerHTML = post[0].title;
    document.getElementById('mainContent').innerHTML = post[0].content;
    document.getElementById('mainLink').href = "/post/" + post[0].id;

    const div = document.getElementById('cardsContainer');

    for (let i = 1; i < Object.keys(post).length; ++i) {

        const col = document.createElement('div');
        col.classList.add('col');

        div.appendChild(col);

        const card = document.createElement('div');
        card.classList.add('card');

        col.appendChild(card);

        const preview = document.createElement('img');
        preview.classList.add('card-img-top');
        preview.src = '/storage/' + post[i].preview;

        const cardBody = document.createElement('div');
        cardBody.classList.add('card-body');

        const title = document.createElement('h5');
        title.classList.add('card-title');
        title.innerHTML = post[i].title

        const content = document.createElement('p');
        content.classList.add('card-text');
        content.innerHTML = post[i].content;

        const link = document.createElement('a');
        link.innerHTML = "Читать";
        link.classList.add("btn", "btn-primary");

        link.href = "/post/" + post[i].id;

        cardBody.append(title, content, link);
        card.append(preview, cardBody);
    }
});

