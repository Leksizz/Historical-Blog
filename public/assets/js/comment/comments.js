const page = window.location.pathname.split('/')[2];

function fetchComments() {
    fetch('/getComments/' + page)
        .then(response => response.text())
        .then(text => {

            if (text.trim().length > 0) {
                return JSON.parse(text);
            } else {
                return undefined;
            }
        })
        .then(data => {
            if (data && Array.isArray(data.result)) {
                displayComments(data.result);
            }
        })
        .catch(error => console.error('Ошибка:', error));
}

function displayComments(comments) {
    const commentsContainer = $(document.getElementById('commentsContainer'));
    comments.forEach(comment => {
        commentsContainer.append(`
            <strong>${comment.author} (${comment.date})</strong>
            <p>${comment.comment}</p>
            <hr>
        `);
    });
}

fetchComments();
