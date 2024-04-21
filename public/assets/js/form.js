$(document).ready(function () {
    $('form').submit(function (event) {
        let json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                // json = jQuery.parseJSON(result);
                console.log(result);
                // if (json.url) {
                //     window.location.href = json.url;
                // }
                if (json.status === 'error') {
                    // const error = document.getElementById('error');
                    // error.textContent = json.message;
                    console.log(json.status);
                }
            }
        });
    });
});

