$(document).ready(function () {
    $('form').submit(function (event) {
        let json;
        event.preventDefault();
        const formData = new FormData(this);
        formData.append('content', editor.getContents());

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                json = jQuery.parseJSON(result);
                if (json.status === 'error') {
                    const error = document.getElementById('error');
                    error.innerText = json.result;
                }
                if (json.href) {
                    window.location.href = json.href;
                }
            }
        });
    });
});