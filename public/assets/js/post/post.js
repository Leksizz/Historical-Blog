import {fetchData} from '../get/get.js';

$(document).ready(async function () {
    const postId = location.pathname.split('/')[2];
    const post = await fetchData('/getPost/' + postId);
    document.getElementById('title').innerHTML = post.title;
    document.getElementById('preview').src = '/storage/' + post.preview;
    document.getElementById('content').innerHTML = post.content;
    document.getElementById('mainImage').src = '/storage/' + post.mainImage;
    document.getElementById('author').innerHTML = post.author;
    const views = document.getElementById('views');
    views.append(document.createElement('strong').innerHTML = post.views);
});