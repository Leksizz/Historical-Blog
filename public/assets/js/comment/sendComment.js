$(document).ready(async function () {
    const page = window.location.pathname.split('/')[2]
    const addCommentContainer = $(document.getElementById('addCommentContainer'));
    addCommentContainer.append(`
    <hr>
            <h3>Комментарии:</h3>
            <form action="/addComment/${page}" method="POST">
                <textarea name="comment" class="form-control mt-3" placeholder="Добавить комментарий:" maxlength="255" id=""></textarea>
                <input type="submit" class="btn btn-secondary mt-3 mb-3" value="Отправить">
                <div class="text-danger" id="error">
                </div>
            </form>
            <hr>
    `)
});