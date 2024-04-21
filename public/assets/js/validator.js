const validationRules = {
    login: {
        regex: /^[a-zA-Z0-9_]+$/,
        errorMessageId: 'errorNickname'
    },
    email: {
        regex: /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/,
        errorMessageId: 'errorEmail'
    },
    password: {
        regex: /((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/,
        errorMessageId: 'errorPassword'
    },


};

function validate()  {
    $('input[type="submit"]').on('click', function (event) {

        let isValid = true;

        $('input', $(this).closest('form')).each(function () {
            let input = $(this).val();
            if (input.trim() === '') {
                $(this).addClass('empty');
                isValid = false;
            }

            for (let field in validationRules) {
                if (this.name === field) {
                    if (!validationRules[field].regex.test(input)) {
                        $('#' + validationRules[field].errorMessageId).addClass('error');
                        isValid = false;
                    } else {
                        $('#' + validationRules[field].errorMessageId).removeClass('error');
                    }
                }
            }
        });
        if (!isValid) {
            event.preventDefault();
        }
    });
}

function reset() {
    $('form input').on('input', function () {
        if ($(this).val().trim() !== '') {
            $(this).removeClass('empty');
            let errorMessageId = $(this).attr('name');
            $('#' + errorMessageId).removeClass('error');
        }
    });
}

$(document).ready(function () {
    validate();
    reset();
});